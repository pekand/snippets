<?php   

class WebsocketClient
{
    protected $address = null;
    protected $port = null;
    
    private $sock = null;
    
    public function __construct($address = '0.0.0.0', $port = 8080) {
        $this->address = $address;
        $this->port = $port;
    }
    
    public function getHeader() {
            $header = "GET / HTTP/1.1
Connection: Upgrade
Pragma: no-cache
Cache-Control: no-cache
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36
Upgrade: websocket
Sec-WebSocket-Version: 13
Accept-Encoding: gzip, deflate
Accept-Language: en-US,en;q=0.9,sk;q=0.8,und;q=0.7,la;q=0.6,fr;q=0.5
Sec-WebSocket-Key: vQBa+DW32bHjI3m5+Omfxg==
Sec-WebSocket-Extensions: permessage-deflate; client_max_window_bits";

        return $header;
    }
    
    public function connect() {
        $this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        
        if(!@socket_connect($this->sock, '127.0.0.1', 8080)) {
             echo "ERROR: UNABLE CONNECT TO SERVER\n";
             $this->sock = null;
             return;
        }

        $headers = $this->getHeader();
        
        echo "SEND HEADERS: $headers\n";
        @socket_write($this->sock, $headers, strlen($headers));
            
        if (false === ($buf = @socket_read($this->sock, 2048, MSG_WAITALL))) {
            echo "READ ERROR: " . socket_strerror(socket_last_error($this->sock)) . "\n";
        }  
            
        echo "RESPONSE TO HEADERS FROM SERVER : '$buf'.\n";
        echo "---\n";
    }
    
    public function close() {
        if ($this->sock == null) {
            return;
        }
        
        @socket_close($this->sock);
    }
    
    //convert byte array string to binnary representation array "A" -> "01000001"
    protected  function str2bin($s) { 
        $res = "";
        for($i = 0;  $i < strlen($s); $i++) {
            $o = ord($s[$i]);
            for($j = 7;  $j >= 0; $j--) {
                $res .= ($o & (1 << $j)) ? '1' : '0';
            }
        }
        return $res;
    }
    
    //convert int to binnary string representation  65 -> "01000001"
    protected function toBin($d, $pad) { 
        return str_pad(decbin($d), $pad, "0", STR_PAD_LEFT);
    }
    
    // convert binnary representation as string to byte array string "01000001" -> "A"
    function bin2str($s) {  
        $r = "";
        $c = 0;
        $cnt = 1;
        for ($i = 0; $i < strlen($s); $i++) {
            
            $c = ($c + ($s[$i] == "1" ? 1 : 0));
            
            if ($cnt == 8) {
                $r .= chr($c);          
                $c = 0;
                $cnt = 0;
            }
            
            $c = $c << 1;   

            $cnt++;
        }
        return $r;
    }
    
    protected function createConnectHeader($data) {
        preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $data, $matches);
        
        $key = "";
        if (isset($matches[1])) {
            $key = base64_encode(pack(
                'H*',
                sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
            ));
        }
        
        $headers = "HTTP/1.1 101 Switching Protocols\r\n";
        $headers .= "Upgrade: websocket\r\n";
        $headers .= "Connection: Upgrade\r\n";
        $headers .= "Sec-WebSocket-Version: 13\r\n";
        $headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
        
        return $headers;
    }
    
    protected function message($m) { // todo

        $len = strlen($m);
        $lenext = "";
        if ($len >= 2**16) {
            $len = 127;
            $lenext = $this->toBin(strlen($m), 8*8);
        } else if ($len > 125) {
            $len = 126;
            $lenext = strlen($m);
            $lenext = $this->toBin(strlen($m), 8*2);
        }

        $maskingkey = openssl_random_pseudo_bytes(4);

        $maskedData = "";
        for ($i = 0; $i<strlen($m); $i++) {
            $maskedData .= $m[$i] ^ $maskingkey[$i % 4];
        }

        $opcode = 1; 

        $frame = [
            'fin' => '1',
            'rsv1' => '0',
            'rsv2' => '0',
            'rsv3' => '0',
            'opcode'=> $this->toBin($opcode, 4),
            'mask' => '1',
            'len' => $this->toBin($len, 7),
            'lenext' => $lenext,
        ];

        $b = "";
        foreach ($frame as $v) {
            $b .= $v;
        }

        $maskingkey = openssl_random_pseudo_bytes(4);

        $messageMasked = "";
        for ($i = 0; $i<strlen($m); $i++)
            $messageMasked .= $m[$i] ^ $maskingkey[$i % 4];

        return $this->bin2str($b).$maskingkey.$messageMasked;
    }
    
    protected function proccessResponse($lastFrame, &$data) // TODO last frame remove from client
    {
        // proccess additional data
        if ($lastFrame != null && 
            $lastFrame['lenext'] > 0 && 
            $lastFrame['lenext'] < strlen($lastFrame['payloaddata'])
        ) {
            $frame = $lastFrame;

            $frame['payloaddata'] = "";

            $remainingLength = $frame['lenext'] - strlen($frame['payloaddata']);
            $data = substr($data, 0, $remainingLength);
            $data = substr($data, $remainingLength);

            if ($frame['mask']) {
                for ($i = 0; $i<strlen($data); $i++)
                    $frame['payloaddata'] .= $data[$i] ^ $frame['maskingkey'][$i % 4];
            } else {
                $frame['payloaddata'] .= $data;
            }

            if($frame['lenext'] == strlen($frame['payloaddata'])) {
                $frame['full'] == true;
            }

            return $frame;
        }


        $frame = [];

        $b1 = $this->str2bin($data[0]);
        $frame['fin'] = $b1[0] == '1';
        $frame['rsv1'] = $b1[1] == '1';
        $frame['rsv2'] = $b1[2] == '1';
        $frame['rsv3'] = $b1[3] == '1';
        $frame['opcode'] = bindec(substr($b1, 4, 4));

        $b2 = $this->str2bin($data[1]);
        $frame['mask'] = $b2[0] == '1';
        $frame['len'] = $frame['mask'] ? ord($data[1]) & 127 : ord($data[1]);

        $frame['lenext'] = 0;
        if ($frame['len']===126) {
            $frame['lenext'] = bindec(
                $this->str2bin($data[2]).
                $this->str2bin($data[3])
            );
        } elseif ($frame['len']===127) {
            $frame['lenext'] = bindec(
                $this->str2bin($data[2]).
                $this->str2bin($data[3]).
                $this->str2bin($data[4]).
                $this->str2bin($data[5]).
                $this->str2bin($data[6]).
                $this->str2bin($data[7]).
                $this->str2bin($data[8]).
                $this->str2bin($data[9])
            );
        }

        if ($frame['len']===126) {
            $frame['maskingkey'] = substr($data, 4, 4);
        } elseif ($frame['len']===127) {
            $frame['maskingkey'] = substr($data, 10, 4);
        } else {
            $frame['maskingkey'] = substr($data, 2, 4);
        }

        $frame['payloaddata'] = "";
        if ($frame['mask']) {
            if ($frame['len']===126){
                $coded_data = substr($data, 8, $frame['lenext']);
                $buf = substr($data, $frame['lenext']);
            } elseif ($frame['len']===127) {
                $coded_data = substr($data, 14, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } else {
                $coded_data = substr($data, 6, $frame['len']);
                $data = substr($data, $frame['len']);
            }

            for ($i = 0; $i<strlen($coded_data); $i++) {
                $frame['payloaddata'] .= $coded_data[$i] ^ $frame['maskingkey'][$i % 4];
            }
        }
        else
        {
            if ($frame['len']===126) {
                $frame['payloaddata'] = substr($data, 4, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } elseif ($frame['len']===127) {
                $frame['payloaddata'] = substr($data, 10, $frame['lenext']);
                $data = substr($data, $frame['lenext']);
            } else {
                $frame['payloaddata'] = substr($data, 2, $frame['len']);
                $data = substr($data, $frame['len']);
            }
        }

        $frame['full'] = false;
        if($frame['len'] < 126 && $frame['len'] == strlen($frame['payloaddata'])) {
            $frame['full'] = true;
        } else if(($frame['len'] == 126 || $frame['len'] == 127) && $frame['lenext'] == strlen($frame['payloaddata'])) {
            $frame['full'] = true;
        }

        $client['lastframe'] = $frame;

        return $frame;
    }
    
    public $lastFrame = null;
    
    public function sendMessage($msg) {
        if ($this->sock == null) {
            return;
        }

        $frame = $this->message($msg);
        @socket_write($this->sock, $frame, strlen($frame));
        
        $buf = null;
        $data = "";

        if (false === ($buf = @socket_read($this->sock, 2048))) {
            echo "READ ERROR: " . socket_strerror(socket_last_error($this->sock)) . "\n";
        }  

        $data .= $buf;

        $this->lastFrame = $this->proccessResponse($this->lastFrame, $data);
                    
        $response = "";
        if ($this->lastFrame != null && $this->lastFrame['full']) {
            $response = $this->lastFrame['payloaddata'];
            $this->lastFrame = null;
            return $response;
        }
        
        return null;
    }
    
    public function listen() {
        if ($this->sock == null) {
            return;
        }
        
        while(true) {
            
            if (false === ($buf = @socket_read($this->sock, 2048, MSG_WAITALL))) {
                echo "READ ERROR: " . socket_strerror(socket_last_error($this->sock)) . "\n";
                break;
            } 
            
            if(strlen($buf)>0) {
                $this->lastFrame = $this->proccessResponse($this->lastFrame, $buf);
            
                $response = "";
                if ($this->lastFrame != null && $this->lastFrame['full']) {
                    $response = $this->lastFrame['payloaddata'];
                    $this->lastFrame = null;
                }
                
                echo "REQUEST FROM SERVER: '$response'.\n";
            }

            usleep(50000);
        }
    }
}
    
    
    
$client = new WebsocketClient();
$client->connect();

$lenght125 = "";
for($i=0;$i<125-2;$i++) {
    $lenght125 .= "B";
}
$lenght125 = "A".$lenght125."C";    

$lenght126 = "";
for($i=0;$i<126-2;$i++) {
    $lenght126 .= "B";
}
$lenght126 = "A".$lenght126."C";

$lenght127 = "";
for($i=0;$i<127-2;$i++) {
    $lenght127 .= "B";
}
$lenght127 = "A".$lenght127."C";

$lenght256 = "";
for($i=0;$i<256-2;$i++) {
    $lenght256 .= "B";
}
$lenght256 = "A".$lenght256."C";

$lenghtBIG = "";
for($i=0;$i<2**16-3;$i++) {
    $lenghtBIG .= "B";
}
$lenghtBIG = "A".$lenghtBIG."C";

$lenghtHUGE = "";
for($i=0;$i<2**16-2;$i++) {
    $lenghtHUGE .= "B";
}
$lenghtHUGE = "A".$lenghtHUGE."C";


$lenghtExtraHUGE = "";
for($i=0;$i<2**17-2;$i++) {
    $lenghtExtraHUGE .= "B";
}
$lenghtExtraHUGE = "A".$lenghtExtraHUGE."C";

$messages = array(
    $lenght125,
    $lenght126,
    $lenght127,
    $lenght256,
    $lenghtBIG,
    $lenghtHUGE,
    $lenghtExtraHUGE
);

foreach($messages as $msg) { 
    echo "MESSAGE TO SERVER (".strlen($msg).")".(strlen($msg) > 1000 ? substr($msg, 0, 100)."...".substr($msg, -100) : $msg)."\n";
    $response = $client->sendMessage($msg);    
    echo "RESPONSE FROM SERVER (".strlen($response).")".(strlen($response) > 1000 ? substr($response, 0, 100)."...".substr($response, -100) : $response)."\n";
}
        
$client->listen();
$client->close();
