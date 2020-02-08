<?php


namespace WebSocketServer;

use SocketServer\SocketClient;
use WebSocketServer\WebSocketServerBase;

class WebsocketClient extends WebSocketServerBase {   
    
    private $client = null;
    private $lastFrame = null;
    private $listeners = [];
       
    protected $options = [
        'ip'=> '0.0.0.0', 
        'port' => 8080,
    ];
    
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
       
    public function __construct($options = []) {
        
        $this->options = array_merge($this->options, $options);
        $this->client = new SocketClient();
    }
    
    public function connect($afterConnect = null) {    
        $headerToServer =  $this->getHeader();
        
        $this->client->connect(function($client) use ($headerToServer) {
            $client->sendData($headerToServer);
        },
        function($client, $headerFromServer) use ($afterConnect) {
            if (isset($afterConnect) && is_callable($afterConnect)) {
                call_user_func_array($afterConnect, [$this]);
            }       
        });

        return $this;
    }
    
    public function sendMessage($message){                 
        return $this->client->sendData($this->mesage($message, 1, true));
    }

    public function addListener($listener) {
         $this->listeners[] = $listener;
         
    }
    
    public function listen() {
        $this->client->listen(function($data) {
           
            $frames = [];
            
            try {
                $frames = $this->proccessRequest(null, $data);
            } catch (\Exception $e) {                    
                if (isset($this->afterClientError) && is_callable($this->afterClientError)) {
                    call_user_func_array($this->afterClientError, [$this, $clientUid, null, $e->getMessage()]);
                }
            }
                    
            foreach ($frames as $frame) {
                
                if (!$frame['full']) {
                    $this->lastFrame = $frame;
                    break;                    
                }
                
                $this->lastFrame = null;

                foreach ($this->listeners as $listener) {
                    if (isset($listener) && is_callable($listener)) {
                        $request = $frame['payloaddata'];
                        call_user_func_array($listener, [$this, $request]);
                    }
                }   
            }
            
        });       
        return $this;
    }
}
