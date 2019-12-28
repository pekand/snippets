<?php

class SocketServer  { 
    protected $address = null;
    protected $port = null;
    
    protected $socket = null;
    
    private $clients = [];
    
    private $waitInterval = 50000;
    private $keepLiveInterval = 5;
    
    public function __construct($address = '0.0.0.0', $port = 8080) {
        
        if(!extension_loaded("sockets")) {
            die("php sockets module is required and not loaded!!");
        }
        
        if(!extension_loaded("openssl")) {
            die("php openssl extension is required and not loaded!!");
        }
        
        $this->address = $address;
        $this->port = $port;
    }
    
    public function close($client) {
       socket_close($client['ref']);
       unset($this->clients[$client['uid']]);
    }
    
    public function bindSocket() {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if(!@socket_bind($this->socket, $this->address, $this->port)){
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            die("Couldn't create socket: [$errorcode] $errormsg");
        };
        socket_listen($this->socket);
        socket_set_nonblock($this->socket);

        return $this;
    }
    
    public function sendData($client, $data) {
        return socket_write($client, $data, strlen($data));
    }
    
    public function uid() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
    
    public function listenToSocket($acceptClientEvent = null, $readFromClientEvent = null, $clientDisconectEvent = null) {
        while(true)
        {
            if(($client = socket_accept($this->socket)) !== false)
            {
                if(is_resource($client)) {
                    
                    $uid = $this->uid();
                    
                    $clientData = [
                        'uid' => $uid,
                        'ref' => $client,
                        'buf' => "",
                        'lastframe' => null,
                        'lastActivityTime' => microtime(true),
                    ];
                    
                    $data = "";
                    while ($buf = @socket_read($client, 1024)) {
                        $data .= $buf;
                    }

                    if (is_callable($acceptClientEvent)) {
                        call_user_func_array($acceptClientEvent, [&$clientData, &$data]);
                    }

                    $this->clients[$uid] = $clientData;
                    
                    socket_set_nonblock($client);
                }
            }
            
            if (count($this->clients)) {
                foreach ($this->clients AS $key => $client) {

                    $data = "";
                    while ($buf = @socket_read($client['ref'], 1024)) {
                        $data .= $buf;
                    }

                    if ($data === "") {
                        if (isset($client['lastActivityTime']) && microtime(true) - $client['lastActivityTime'] > $this->keepLiveInterval) {
                            if (false === @$this->sendData($client['ref'], $this->mesage('ping'))) { //todo
                                
                                if (is_callable($clientDisconectEvent)) {
                                    call_user_func_array($clientDisconectEvent, [&$clientData]);
                                }
                                
                                $this->close($client);
                            }
                            
                            $this->clients[$key]['lastActivityTime'] = microtime(true);
                        }
                    
                        continue;
                    }

                    $this->clients[$key]['lastActivityTime'] = microtime(true);
                    
                    if (is_callable($readFromClientEvent)) {
                        call_user_func_array($readFromClientEvent, [&$client, &$data]);
                    }
                }
            }
            
            usleep($this->waitInterval);
        }
    }
}

class WebSocketServerBase extends SocketServer {
    public function __construct($address, $port) {
        parent::__construct($address, $port);
    }
    
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
    
    protected function mesage($m) { // todo
        return chr(129) . chr(strlen($m)) . $m;
    }
    
    protected function createConnectHeader($data) {
        preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $data, $matches);
        $key = base64_encode(pack(
            'H*',
            sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
        ));
        $headers = "HTTP/1.1 101 Switching Protocols\r\n";
        $headers .= "Upgrade: websocket\r\n";
        $headers .= "Connection: Upgrade\r\n";
        $headers .= "Sec-WebSocket-Version: 13\r\n";
        $headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
        
        return $headers;
    }
}
 
class WebSocketServer extends WebSocketServerBase {
    
    public function __construct($address, $port) {
        parent::__construct($address, $port);
    }
       
    // rfc6455 The WebSocket Protocol 
    // https://tools.ietf.org/html/rfc6455
    private function proccessRequest(&$client) // TODO last frame remove from client
    {
        $buf = &$client['buf'];
        
        // proccess additional data
        if ($client['lastframe'] != null && 
            $client['lastframe']['lenext'] > 0 && 
            $client['lastframe']['lenext'] < strlen($client['lastframe']['payloaddata'])
        ) {
            $frame = $client['lastframe'];

            $frame['payloaddata'] = "";
            
            $remainingLength = $client['lastframe']['lenext'] - strlen($client['lastframe']['payloaddata']);
            $data = substr($buf, 0, $remainingLength);
            $buf = substr($buf, $remainingLength);
            
            if ($frame['mask']) {
                for ($i = 0; $i<strlen($buf); $i++)
                    $frame['payloaddata'] .= $data[$i] ^ $frame['maskingkey'][$i % 4];
            } else {
                $frame['payloaddata'] .= $data;
            }

            if($lastFrame['lenext'] == strlen($frame['payloaddata'])) {
                $frame['full'] == true;
                
                return $frame;
            }

            return null;
        }


        $frame = [];

        $b1 = $this->str2bin($buf[0]);
        $frame['fin'] = $b1[0] == '1';
        $frame['rsv1'] = $b1[1] == '1';
        $frame['rsv2'] = $b1[2] == '1';
        $frame['rsv3'] = $b1[3] == '1';
        $frame['opcode'] = bindec(substr($b1, 4, 4));

        $b2 = $this->str2bin($buf[1]);
        $frame['mask'] = $b2[0] == '1';
        $frame['len'] = $frame['mask'] ? ord($buf[1]) & 127 : ord($bytes[1]);

        $frame['lenext'] = 0;
        if ($frame['len']===126) {
            $frame['lenext'] = bindec(
                $this->str2bin($buf[2]).
                $this->str2bin($buf[3])
            );
        } elseif ($frame['len']===127) {
            $frame['lenext'] = bindec(
                $this->str2bin($buf[2]).
                $this->str2bin($buf[3]).
                $this->str2bin($buf[4]).
                $this->str2bin($buf[5]).
                $this->str2bin($buf[6]).
                $this->str2bin($buf[7]).
                $this->str2bin($buf[8]).
                $this->str2bin($buf[9])
            );
        }

        if ($frame['len']===126) {
            $frame['maskingkey'] = substr($buf, 4, 4);
        } elseif ($frame['len']===127) {
            $frame['maskingkey'] = substr($buf, 10, 4);
        } else {
            $frame['maskingkey'] = substr($buf, 2, 4);
        }

        $frame['payloaddata'] = "";
        if ($frame['mask']) {
            if ($frame['len']===126){
                $coded_data = substr($buf, 8, $frame['lenext']);
                $buf = substr($buf, $frame['lenext']);
            } elseif ($frame['len']===127) {
                $coded_data = substr($buf, 14, $frame['lenext']);
                $buf = substr($buf, $frame['lenext']);
            } else {
                $coded_data = substr($buf, 6, $frame['len']);
                $buf = substr($buf, $frame['len']);
            }

            for ($i = 0; $i<strlen($coded_data); $i++)
                $frame['payloaddata'] .= $coded_data[$i] ^ $frame['maskingkey'][$i % 4];
        }
        else
        {
            if ($frame['len']===126) {
                $frame['payloaddata'] = substr($buf, 4, $frame['lenext']);
                $buf = substr($buf, $frame['lenext']);
            } elseif ($frame['len']===127) {
                $frame['payloaddata'] = substr($buf, 10, $frame['lenext']);
                $buf = substr($buf, $frame['lenext']);
            } else {
                $frame['payloaddata'] = substr($buf, 2, $frame['len']);
                $buf = substr($buf, $frame['len']);
            }
        }

        $frame['full'] = false;
        if($frame['len'] < 126 && $frame['len'] == strlen($frame['payloaddata'])) {
            $frame['full'] = true;
        } else if(($frame['len'] == 126 || $frame['len'] == 127) && $frame['lenext'] == strlen($frame['payloaddata'])) {
            $frame['full'] = true;
        }

        $client['lastframe'] = $frame;
        
        if ($frame['full']) {
            return $frame;
        }
        
        return null;
    }
    
    public function sendMessage($client, $message){ 
        return $this->sendData($client['ref'], $this->mesage($message));
    }
    
    public function clientConnected($clientConnectedEvent){ 
        $this->clientConnectedEvent = $clientConnectedEvent;
    }
    
    public function clientDisconnected($clientDisconectEvent){ 
        $this->clientDisconectEvent = $clientDisconectEvent;
    }
    
    public function listen($getFrameEvent) {
        $this->getFrameEvent = $getFrameEvent;
        
        $this->bindSocket()->listenToSocket(
            function (&$client, &$data) {
                $headers = $this->createConnectHeader($data);
                
                $this->sendData($client['ref'], $headers);
                
                $server = $this;
                if (isset($this->clientConnectedEvent) && is_callable($this->clientConnectedEvent)) {
                    call_user_func_array($this->clientConnectedEvent, [&$server, &$client]);
                }
            },
            function (&$client, &$data) {
                
                $client['buf'] .= $data;
                
                $frame = $this->proccessRequest($client); // todo until data exists in buffer
                
                if ($frame == null) {
                    return;
                }
                
                $server = $this;
                if (isset($this->getFrameEvent) && is_callable($this->getFrameEvent)) {
                    $request = $frame['payloaddata'];
                    call_user_func_array($this->getFrameEvent, [&$server, &$client, $request]);
                }
            },
            function(&$client) {
                $server = $this;
                if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                    call_user_func_array($this->clientDisconectEvent, [&$server, &$client]);
                }
            }
        );
    }
}

echo "WEBSOCKET SERVER\n";
echo "WAITING...\n";

$server = new WebSocketServer('0.0.0.0', 8080);

$server->clientConnected(function($server, $client) {
     echo "({$client['ref']}) CLIENT CONNECTED\n";
});

$server->clientDisconnected(function($server, $client) { // TODO process message from server after close tab in browser
     echo "({$client['ref']}) CLIENT DISCONNECTED\n";
});

$server->listen(function(&$server, &$client, $request) {   
    echo "({$client['uid']}) request: $request\n";
    
    var_dump($client['lastframe']);
    var_dump($client['buf']);
    
    if ($request == "now") {
        $contentBody = 'T' . time();
        $server->sendMessage($client, $contentBody);
    } else if ($request == "ping") {
        $server->sendMessage($client, "pong");    
    } else if ($request == "close") {
        $server->close($client);    
    } else {
        $server->sendMessage($client, $request);    
    }
});

echo "FINISHED\n";