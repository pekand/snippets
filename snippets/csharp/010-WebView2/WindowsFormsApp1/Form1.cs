using Microsoft.Web.WebView2.Core;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            InitializeWebView2();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        

        private async void InitializeWebView2()
        {

            var webView = new Microsoft.Web.WebView2.WinForms.WebView2();
            webView.Dock = DockStyle.Fill;
            this.Controls.Add(webView);

            

            // Initialize WebView2 control
            await webView.EnsureCoreWebView2Async(null);

            webView.CoreWebView2.WebMessageReceived += WebView_WebMessageReceived;


            // Set up to listen for JavaScript console messages
            await webView.CoreWebView2.CallDevToolsProtocolMethodAsync(
                "Runtime.enable", "{}");

            await webView.CoreWebView2.CallDevToolsProtocolMethodAsync(
                "Log.enable", "{}");

            // Handle messages from JavaScript
            webView.CoreWebView2.WebMessageReceived += WebView_WebMessageReceived;

            // Load inline HTML with JavaScript
            string htmlContent = @"
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>WebView2 Interaction</title>
                </head>
                <body>

<button onclick='console.log(""test"")'>Console.log</button>


                    <h1>WebView2 JavaScript Interaction</h1>
<div><input type='text'></div>
                    <button onclick='callCSharp()'>Call C# Function test</button>
                    <script>
                        function callCSharp() {
                            // Send message to C# from JavaScript
                            window.chrome.webview.postMessage('Hello from JavaScript!');
                        }
                    </script>

<div id=""time"">00:00:00</div>

    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            // Update the time in the div
            document.getElementById('time').textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Call updateTime every second
        setInterval(updateTime, 1000);
        
        // Call once to show initial time immediately
        updateTime();
    </script>

 <div id=""randomString"">Random string will appear here</div>


    <script>
        function generateRandomString(length = 10) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById('randomString').textContent = result;
        }
    </script>

<script>
                        console.log('This is a log message');
                        console.error('This is an error message');
                    </script>

                </body>
                </html>";

            // Navigate to the inline HTML content
            webView.NavigateToString(htmlContent);

            webView.ExecuteScriptAsync("generateRandomString();");


            string script1 = @"
                (function() {
                    const originalLog = console.log;
                    const originalError = console.error;

                    // Override console.log
                    console.log = function(...args) {
                        window.chrome.webview.postMessage({type: 'log', message: args.join(' ')});
                        originalLog.apply(console, args);
                    };

                    // Override console.error
                    console.error = function(...args) {
                        window.chrome.webview.postMessage({type: 'error', message: args.join(' ')});
                        originalError.apply(console, args);
                    };
                })();
            ";

            // Inject the script to override console.log and console.error
            await webView.CoreWebView2.ExecuteScriptAsync(script1);

            webView.CoreWebView2.NavigationCompleted += (sender, args) =>
            {
                // Execute JavaScript to update time in the div
                string script2 = @"
                    setInterval(function() {
                        generateRandomString();
                    }, 1000);";

                // Execute JavaScript in the WebView2 content
                webView.CoreWebView2.ExecuteScriptAsync(script2);
            };

        }


        // Handle console messages from JavaScript
        private void WebView_WebMessageReceived(object sender, CoreWebView2WebMessageReceivedEventArgs e)
        {
            string json = e.WebMessageAsJson;
            using (JsonDocument doc = JsonDocument.Parse(json))
            {
                JsonElement root = doc.RootElement;

                // Access individual properties
                string type = root.GetProperty("type").GetString();
                string message = root.GetProperty("message").GetString();

                Console.WriteLine($"type: {type}");
                Console.WriteLine($"Email: {message}");
            }
            MessageBox.Show($"Console message from JavaScript: {json}");
        }

        private void webView21_Click(object sender, EventArgs e)
        {

        }
    }
}
