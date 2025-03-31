using System;
using System.Net;
using System.Net.Sockets;
using System.Text;

class SimpleDnsServer
{
    static void Main()
    {
        //UdpClient udpServer = new UdpClient(53); // Bind to port 53

        IPEndPoint localEndpoint = new IPEndPoint(IPAddress.Parse("127.0.0.2"), 53);
        UdpClient udpServer = new UdpClient(localEndpoint);

        Console.WriteLine("DNS server started...");

        while (true)
        {
            try
            {
                IPEndPoint clientEndpoint = new IPEndPoint(IPAddress.Any, 0);
                byte[] requestBytes = udpServer.Receive(ref clientEndpoint);

                byte[] responseBytes = HandleDnsQuery(requestBytes);

                udpServer.Send(responseBytes, responseBytes.Length, clientEndpoint);
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.ToString());
            }
        }
    }

    static byte[] HandleDnsQuery(byte[] requestBytes)
    {
        // Extract the domain name from the request
        string domainName = GetDomainName(requestBytes);

        // Check if the request is for "google.com"
        if (domainName == "google.com")
        {
            return CreateResponse(requestBytes, "142.250.72.14"); // Hardcoded IP
        }
        else
        {
            // Fallback to another DNS server
            //return ForwardToDnsServer(requestBytes, "8.8.8.8", 53);

            return  ForwardToDnsServer2(requestBytes, "https://dns.google/dns-query");
        }
    }

    static string GetDomainName(byte[] requestBytes)
    {
        int position = 12; // Start of the question section
        StringBuilder domainName = new StringBuilder();

        while (requestBytes[position] != 0) // 0 marks the end of the domain name
        {
            int length = requestBytes[position];
            position++;

            for (int i = 0; i < length; i++)
            {
                domainName.Append((char)requestBytes[position]);
                position++;
            }

            if (requestBytes[position] != 0)
            {
                domainName.Append('.');
            }
        }

        return domainName.ToString();
    }

    static byte[] CreateResponse(byte[] requestBytes, string ipAddress)
    {
        byte[] response = new byte[512];

        // Copy transaction ID
        Array.Copy(requestBytes, 0, response, 0, 2);

        // Flags: Response with no error (0x8180)
        response[2] = 0x81;
        response[3] = 0x80;

        // Questions
        response[4] = requestBytes[4];
        response[5] = requestBytes[5];

        // One answer
        response[6] = 0x00;
        response[7] = 0x01;

        // Authority RRs and Additional RRs (none)
        response[8] = 0x00;
        response[9] = 0x00;
        response[10] = 0x00;
        response[11] = 0x00;

        // Copy question section (domain name + type/class)
        int questionLength = requestBytes.Length - 12;
        Array.Copy(requestBytes, 12, response, 12, questionLength);

        // Answer section: Name (pointer to domain in question)
        int answerStart = 12 + questionLength;
        response[answerStart] = 0xC0; // Pointer
        response[answerStart + 1] = 0x0C;

        // Type (A record)
        response[answerStart + 2] = 0x00;
        response[answerStart + 3] = 0x01;

        // Class (IN)
        response[answerStart + 4] = 0x00;
        response[answerStart + 5] = 0x01;

        // TTL (32-bit)
        response[answerStart + 6] = 0x00;
        response[answerStart + 7] = 0x00;
        response[answerStart + 8] = 0x00;
        response[answerStart + 9] = 0x3C; // 60 seconds

        // Data length (4 bytes for IPv4)
        response[answerStart + 10] = 0x00;
        response[answerStart + 11] = 0x04;

        // IP address
        string[] ipParts = ipAddress.Split('.');
        response[answerStart + 12] = byte.Parse(ipParts[0]);
        response[answerStart + 13] = byte.Parse(ipParts[1]);
        response[answerStart + 14] = byte.Parse(ipParts[2]);
        response[answerStart + 15] = byte.Parse(ipParts[3]);

        return response;
    }

    static byte[] ForwardToDnsServer(byte[] requestBytes, string dnsServer, int port)
    {
        UdpClient forwarder = new UdpClient();
        forwarder.Connect(dnsServer, port);

        forwarder.Send(requestBytes, requestBytes.Length);

        IPEndPoint dnsServerEndpoint = new IPEndPoint(IPAddress.Any, 0);
        byte[] responseBytes = forwarder.Receive(ref dnsServerEndpoint);

        forwarder.Close();
        return responseBytes;
    }

    static byte[] ForwardToDnsServer2(byte[] requestBytes, string dohServerUrl)
    {
        using (HttpClient httpClient = new HttpClient())
        {
            try
            {
                // Set headers for DNS over HTTPS
                HttpRequestMessage request = new HttpRequestMessage(HttpMethod.Post, dohServerUrl);
                request.Content = new ByteArrayContent(requestBytes);
                request.Content.Headers.ContentType = new System.Net.Http.Headers.MediaTypeHeaderValue("application/dns-message");

                // Send the request and get the response
                HttpResponseMessage response = httpClient.Send(request);

                // Ensure the request was successful
                response.EnsureSuccessStatusCode();

                // Read the response as a byte array (DNS response)
                return response.Content.ReadAsByteArrayAsync().Result;
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Error forwarding to DoH server: {ex.Message}");
                return null; // Return null in case of failure
            }
        }
    }
}