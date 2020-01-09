<?php

namespace SocketServer;

class SocketServer {   
    
    private $socket = null;
    
    private $clients = [];
       
    protected $options = [
        'ip'=> '0.0.0.0', 
        'port' => 8080,
        'waitInterval' => 50000, // event loop wait cicle (in ms)
        'keepLiveInterval' => 5, // ping client (in s)
        'killInterval' => 10 // if client not respond to ping or send eny message get killed after keepLiveInterval + killInterval (in s)
    ];
       
    public function __construct($options = []) {
        
        $this->options = array_merge($this->options, $options);
        
        if(!extension_loaded("sockets")) {
            die("php sockets extension is required and not loaded!!");
        }
        
        if(!extension_loaded("openssl")) {
            die("php openssl extension is required and not loaded!!");
        }
    }
    
    public function uid() {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }
    
    public function afterServerError($afterServerErrorEvent = null) {
        $this->afterServerErrorEvent = $afterServerErrorEvent;
        return $this;
    }
    
    public function bindSocket() {      
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if(!@socket_bind($socket, $this->options['ip'], $this->options['port'])){
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            
            if (isset($this->afterServerErrorEvent) && is_callable($this->afterServerErrorEvent)) {
                call_user_func_array($this->afterServerErrorEvent, [$errorcode, $errormsg]);
            }
        } else {
            if(!socket_listen($socket)) {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
            
                if (isset($this->afterServerErrorEvent) && is_callable($this->afterServerErrorEvent)) {
                    call_user_func_array($this->afterServerErrorEvent, [$errorcode, $errormsg]);
                }
                                
            } else {
                $this->socket = $socket;
                socket_set_nonblock($this->socket);
            }
        }

        return $this;
    }
    
    public function close(&$client) {
       socket_close($client['ref']);
       unset($this->clients[$client['uid']]);
    }
    
    public function afterClientError($afterClientErrorEvent = null) {
        $this->afterClientErrorEvent = $afterClientErrorEvent;
        return $this;
    }
    
    public function sendData(&$client, $data) {
        $result = @socket_write($client['ref'], $data, strlen($data));
        
        if ($result === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            if (isset($this->afterClientErrorEvent) && is_callable($this->afterClientErrorEvent)) {
                call_user_func_array($this->afterClientErrorEvent, [&$client, $errorcode, $errormsg]);
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

    public function buildPing($buildPingEvent) { 
        $this->buildPingEvent = $buildPingEvent;
        return $this;
    }
    
    public function listenToSocket($readFromClientEvent = null) {
        
        if (!$this->socket){
            return;
        }
        
        while(true)
        {
            if(($newClient = socket_accept($this->socket)) !== false)
            {
                if(is_resource($newClient)) {
                    
                    $uid = $this->uid();
                    
                    $clientData = [
                        'uid' => $uid,
                        'ref' => $newClient,
                        'lastActivityTime' => microtime(true),
                        'ping' => false,
                    ];
                    
                    $data = "";
                    while ($buf = @socket_read($newClient, 1024)) {                        
                        $data .= $buf;
                    }

                    if (isset($this->acceptClientEvent) && is_callable($this->acceptClientEvent)) {
                        $acceptNewClient = call_user_func_array($this->acceptClientEvent, [&$clientData, &$data]);
                    }

                    if ($acceptNewClient) {
                        $this->clients[$uid] = $clientData;
                        socket_set_nonblock($newClient);
                    } else {
                        socket_close($newClient);
                    }
                }
            }

            if (count($this->clients)) {
                foreach ($this->clients as $key => &$client) {

                    if (!is_array($client)) {
                        continue;
                    }
                    
                    $data = "";
                    while ($buf = @socket_read($client['ref'], 1024)) {
                        $data .= $buf;
                    }

                    if ($data === "") {
                        if (isset($this->buildPingEvent) && is_callable($this->buildPingEvent)) {
                            if($client['ping'] == false &&  microtime(true) - $client['lastActivityTime'] > $this->options['keepLiveInterval']) { // check if client still listening
                                call_user_func_array($this->buildPingEvent, [&$client]);
                                $client['ping'] = true;
                            }
                        }
                        
                        if(microtime(true) - $client['lastActivityTime'] > $this->options['keepLiveInterval'] + $this->options['killInterval']) { // check if client still listening
                            if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                call_user_func_array($this->clientDisconnectedEvent, [&$client]);
                            }
                            
                            $this->close($client);
                        }

                        continue;
                    }

                    $client['lastActivityTime'] = microtime(true);
                    $client['ping'] = false;
                    
                    if (is_callable($readFromClientEvent)) {
                        call_user_func_array($readFromClientEvent, [&$client, &$data]);
                    }
                }
            }
            
            usleep($this->options['waitInterval']);
        }
    }
}
