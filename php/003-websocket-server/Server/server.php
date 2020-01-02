<?php

class SocketServer {   
    
    private $socket = null;
    
    private $clients = [];
       
    protected $options = [ 
        'ip'=> '0.0.0.0', 
        'port' => 8080,
        'waitInterval' => 50000, // event loop wait cicle (in ms)
        'keepLiveInterval' => 5 // ping client (in s)
    ];
    
    private $pingMessage = "";
    
    public function __construct($options = []) {
        
        $this->options = array_merge($this->options, $options);
        
        if(!extension_loaded("sockets")) {
            die("php sockets module is required and not loaded!!");
        }
        
        if(!extension_loaded("openssl")) {
            die("php openssl extension is required and not loaded!!");
        }
    }
    
    public function uid() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
    
    public function afterSocketServerError($afterSocketServerErrorEvent = null) {
        $this->afterSocketServerErrorEvent = $afterSocketServerErrorEvent;
        return $this;
    }
    
    public function bindSocket() {        
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if(!@socket_bind($socket, $this->options['ip'], $this->options['port'])){
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            
            if (isset($this->afterSocketServerErrorEvent) && is_callable($this->afterSocketServerErrorEvent)) {
                call_user_func_array($this->afterSocketServerErrorEvent, [$errorcode, $errormsg]);
            }
        } else {
            if(!socket_listen($socket)) {
                if (isset($this->afterSocketServerErrorEvent) && is_callable($this->afterSocketServerErrorEvent)) {
                    call_user_func_array($this->afterSocketServerErrorEvent, [$errorcode, $errormsg]);
                }
                                
            } else {
                $this->socket = $socket;
                socket_set_nonblock($this->socket);
            }
        }

        return $this;
    }
    
    public function close($client) {
       socket_close($client['ref']);
       unset($this->clients[$client['uid']]);
    }
    
    public function setPingMesasge($message) { 
        $this->pingMessage = $message;
    }
    
    public function getPingMesasge() { 
        return $this->pingMessage;
    }
    
    public function ping($client) {
        if (false === @$this->sendData($client, $this->pingMessage)) {          
            return false;
        }
        
        return true;
    }
    
    public function afterSocketError($afterSocketErrorEvent = null) {
        $this->afterSocketErrorEvent = $afterSocketErrorEvent;
        return $this;
    }
    
    public function sendData($client, $data) {
        $result = @socket_write($client['ref'], $data, strlen($data));
        
        if ($result === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            if (isset($this->afterSocketErrorEvent) && is_callable($this->afterSocketErrorEvent)) {
                call_user_func_array($this->afterSocketErrorEvent, [&$client, $errorcode, $errormsg]);
            }
            
            return false;
        }
        
        return true;
    }

    public function acceptClient($acceptClientEvent = null) {
        $this->acceptClientEvent = $acceptClientEvent;
        return $this;
    }
    
    public function clientDisconnected($clientDisconnectedEvent = null) {
        $this->clientDisconnectedEvent = $clientDisconnectedEvent;
        return $this;
    }

    public function listenToSocket($readFromClientEvent = null) {
        
        if (!$this->socket){
            return;
        }
        
        while(true)
        {
            if(($client = socket_accept($this->socket)) !== false)
            {
                if(is_resource($client)) {
                    
                    $uid = $this->uid();
                    
                    $clientData = [
                        'uid' => $uid,
                        'ref' => $client,
                        'lastActivityTime' => microtime(true),
                    ];
                    
                    $data = "";
                    while ($buf = @socket_read($client, 1024)) {                        
                        $data .= $buf;
                    }

                    if (isset($this->acceptClientEvent) && is_callable($this->acceptClientEvent)) {
                        call_user_func_array($this->acceptClientEvent, [&$clientData, &$data]);
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
                        if (isset($client['lastActivityTime']) && microtime(true) - $client['lastActivityTime'] > $this->options['keepLiveInterval']) {
                            
                            if (!$this->ping($client)) {
                                if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                    call_user_func_array($this->clientDisconnectedEvent, [&$clientData]);
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
            
            usleep($this->options['waitInterval']);
        }
    }
}

class WebSocketServerBase {
    public function __construct($options) {
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
    
    protected function mesage($m) { // todo
        
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
            'mask' => '0',
            'len' => $this->toBin($len, 7),
            'lenext' => $lenext,
        ];
        
        $b = "";
        foreach ($frame as $v) {
            $b .= $v;
        }

        return $this->bin2str($b).$m;
    }

    // rfc6455 The WebSocket Protocol 
    // https://tools.ietf.org/html/rfc6455
    protected function proccessRequest($lastFrame, &$data) // TODO last frame remove from client
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
                $data = substr($data, $frame['lenext']);
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
}
 
class WebSocketServer extends WebSocketServerBase {
    
    private $frames = [];
    
    private $socketServer = null; 
    
    public function __construct($options) {
        $this->socketServer = new SocketServer($options);
        $this->socketServer->setPingMesasge($this->mesage('ping'));
    }

    public function afterError($afterError){ 
        $this->afterError = $afterError;
        return $this;
    }
    
    public function afterServerError($afterServerError){ 
        $this->afterServerError = $afterServerError;
        return $this;
    }
    
    public function clientConnected($clientConnectedEvent){ 
        $this->clientConnectedEvent = $clientConnectedEvent;
        return $this;
    }
    
    public function clientDisconnected($clientDisconectEvent){ 
        $this->clientDisconectEvent = $clientDisconectEvent;
        return $this;
    }
    
    public function sendMessage($client, $message){ 
        return $this->socketServer->sendData($client, $this->mesage($message));
    }
    
    public function listen($getFrameEvent) {
        $this->getFrameEvent = $getFrameEvent;
        
        $this->socketServer
            ->afterSocketServerError($this->afterServerError) // server cause error
            ->afterSocketError(function(&$client, $code, $mesage) { // client cause error
                $server = $this;
                if (isset($this->afterError) && is_callable($this->afterError)) {
                    call_user_func_array($this->afterError, [&$server, &$client, $code, $mesage]);
                }
            })
            ->acceptClient(function (&$client, &$data) { // client connected
                $headers = $this->createConnectHeader($data);
                
                $this->socketServer->sendData($client, $headers);
                
                $this->frames[$client['uid']] = null;
                
                $server = $this;
                if (isset($this->clientConnectedEvent) && is_callable($this->clientConnectedEvent)) {
                    call_user_func_array($this->clientConnectedEvent, [&$server, &$client]);
                }
            })
            ->clientDisconnected(function(&$client) { // client disconected
                $server = $this;
                if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                    call_user_func_array($this->clientDisconectEvent, [&$server, &$client]);
                }
            })
            ->bindSocket()
            ->listenToSocket(
                function (&$client, &$data) { // client send request
                
                    $lastFrame = $this->frames[$client['uid']];
                    
                    while(strlen($data) > 0) {
                        $frame = $this->proccessRequest($lastFrame, $data);
                        $this->frames[$client['uid']] = $frame;
                        
                        if ($frame == null) {
                            return;
                        }

                        $server = $this;
                        if ($frame['full'] && isset($this->getFrameEvent) && is_callable($this->getFrameEvent)) {
                            $request = $frame['payloaddata'];
                            call_user_func_array($this->getFrameEvent, [&$server, &$client, $request]);
                            $this->frames[$client['uid']] = null;
                        }
                    }
                }
            );
    }
}

echo "WEBSOCKET SERVER\n";
echo "WAITING...\n";

$server = new WebSocketServer([
    'ip' => '0.0.0.0',
    'port' => 8080
]);

$server->afterError(function($server, $client, $code, $message) {
     echo "({$client['uid']}) ERROR ($code): $message\n";
     
     if ($code = 10053) { // client disconected
       
     }
});

$server->afterServerError(function($code, $message) {
     echo "SERVER ERROR ($code): $message\n";
});

$server->clientConnected(function($server, $client) {
     echo "({$client['uid']}) CLIENT CONNECTED\n";
});

$server->clientDisconnected(function($server, $client) { // TODO process message from server after close tab in browser
     echo "({$client['uid']}) CLIENT DISCONNECTED\n";
});

$server->listen(function(&$server, &$client, $request) {   

    if(strlen($request)<1000) {
        echo "({$client['uid']}) REQUEST FROM CLIENT (".strlen($request)."): $request\n";
    } else {
        echo "({$client['uid']}) REQUEST FROM CLIENT (".strlen($request)."): ".substr($request, 0, 100)."...".substr($request, -100)."\n";
    }
        
    if ($request == "now") {
        $contentBody = 'T' . time();
        $server->sendMessage($client, $contentBody);
    } else if ($request == "ping") {
        $server->sendMessage($client, "pong");    
    } else if ($request == "close") {
        $server->close($client);    
    } else {
        $response = "ok recived: ".strlen($request)." chars";
        echo "({$client['uid']}) RESPONSE FROM SERVER: $response\n";

        $server->sendMessage($client, $response);    
    }
});

echo "FINISHED\n";
