<?php

namespace SocketServer;

class SocketServer {   
    
    private $socket = null;
    
    private $clients = [];
       
    protected $options = [
        'ip'=> '0.0.0.0', 
        'port' => 8080,
        'waitInterval' => 50000, // event loop wait cicle (in ms)
        'clientInactivityInterval' => 30, // check with ping if client live after this interval (in s)
        'maxClientInactivityInterval' => 60, // if client not respond to ping or send eny message get killed after clientInactivityInterval + maxClientInactivityInterval (in s)
        'maxClientHeaderLength' => 1000, // 0 is unlimite
        'maxClientRequestLength' => 100, // 0 is unlimite
        'maxClientLiveTime' => 0, // 0 is unlimite
        'maxClientRequestCount' => 10000, // 0 is unlimite
        'maxClientRequestPerMinuteCount' => 1000, // 0 is unlimite
        'maxClientsCount' => 1000, // 0 is unlimite
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
    
    public function getClient($uid) {
       if (isset($this->clients[$uid])) {
         return $this->clients[$uid];
       }
       
       return null;
    }
    
    public function closeClient(&$client) {
        
        if (isset($client['ref']) && $client['ref'] !== null){
            socket_close($client['ref']);
            $client['ref'] = null;
        }
        
        if (isset($this->clients[$client['uid']])) {
            unset($this->clients[$client['uid']]);
        }
    }
    
    public function afterClientError($afterClientErrorEvent = null) {
        $this->afterClientErrorEvent = $afterClientErrorEvent;
        return $this;
    }
    
    public function sendData(&$client, $data) {
        
        if (!$client['live']) {
            return false;
        }
        
        $result = @socket_write($client['ref'], $data, strlen($data));
        
        if ($result === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            if ($errorcode == 10053) { // client disconected
                $client['live'] = false;
                if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                     call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_UNEXPECTEDLY_CLOSED_SOCKET']);
                }
                
                $this->closeClient($client);         
            } else {
                if (isset($this->afterClientErrorEvent) && is_callable($this->afterClientErrorEvent)) {
                    call_user_func_array($this->afterClientErrorEvent, [&$client, $errorcode, $errormsg]);
                }
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
            if(($ref = socket_accept($this->socket)) !== false)
            {
                if(is_resource($ref)) {
                    
                    $uid = $this->uid();
                    
                    $client = [
                        'uid' => $uid,
                        'ref' => $ref,
                        'created' => microtime(true),
                        'live' => true,
                        'requestCount' => 0,
                        
                        'maxClientLiveTime' => $this->options['maxClientLiveTime'],
                        'maxClientHeaderLength' => $this->options['maxClientHeaderLength'] == 0 ? false :  $this->options['maxClientHeaderLength'],
                        'maxClientRequestLength' => $this->options['maxClientRequestLength'] == 0 ? false :  $this->options['maxClientRequestLength'],
                        'maxClientRequestCount' => $this->options['maxClientRequestCount'] == 0 ? false :  $this->options['maxClientRequestCount'],
                        'maxClientRequestPerMinuteCount' => $this->options['maxClientRequestPerMinuteCount'] == 0 ? false :  $this->options['maxClientRequestPerMinuteCount'],
                        
                        'requestPerMinuteInterval' => microtime(true),
                        'requestPerMinuteCount' => 0,
 
                        'lastActivityTime' => microtime(true),
                        'ping' => false,
                    ];
                    
                    $data = "";
                    while ($buf = @socket_read($client['ref'], 1024)) {                        
                        $data .= $buf;
                        
                        if($client['maxClientHeaderLength'] !== false && $client['maxClientHeaderLength'] < strlen($data)) {                              
                            break;
                        }
                    }
                    
                    if($client['maxClientHeaderLength'] !== false && $client['maxClientHeaderLength'] < strlen($data)) {
                        if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                             call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_HEADER_IS_TOO_BIG']);
                        }
                        
                        $this->closeClient($client);
                        break;
                    } else {
                        $acceptedNewClient = true;
                        if (isset($this->acceptClientEvent) && is_callable($this->acceptClientEvent)) {
                            $acceptedNewClient = call_user_func_array($this->acceptClientEvent, [&$client, &$data]);
                        }

                        if ($acceptedNewClient) {
                            $this->clients[$uid] = $client;
                            socket_set_nonblock($client['ref']);
                            
                            if ($this->options['maxClientsCount'] != 0 && count($this->clients) > $this->options['maxClientsCount']) {
                                if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                     call_user_func_array($this->clientDisconnectedEvent, [&$client, 'SERVER_IS_FULL']);
                                }
                                
                                $this->closeClient($client);
                            }
                            
                        } else {
                            $this->closeClient($client);
                        }
                    }
                }
            }

            if (count($this->clients)) {
                foreach ($this->clients as $key => &$client) {

                    if (!is_array($client) || $client['ref'] === null) {
                        continue;
                    }
                    
                    $data = "";
                    while ($buf = @socket_read($client['ref'], 1024)) {
                        $data .= $buf;
                        
                        if($client['maxClientRequestLength'] !== false) {
                            if ($client['maxClientRequestLength'] < strlen($data)) {
                                if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                     call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_REQUEST_IS_TOO_BIG']);
                                }
                                
                                $this->closeClient($client);
                                continue 2;
                            } 
                        }
                    }

                    if ($data === "") {
                        if (isset($this->buildPingEvent) && is_callable($this->buildPingEvent)) {
                            if($client['ping'] == false &&  microtime(true) - $client['lastActivityTime'] > $this->options['clientInactivityInterval']) { // check if client still listening
                                call_user_func_array($this->buildPingEvent, [&$client]);
                                $client['ping'] = true;
                            }
                        }
                        
                        if(microtime(true) - $client['lastActivityTime'] > $this->options['clientInactivityInterval'] + $this->options['maxClientInactivityInterval']) { // check if client still listening
                            if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_NOT_RESPONDING_TO_PING']);
                            }
                            
                            $this->closeClient($client);
                        }
                        
                        
                        if($client['maxClientLiveTime'] > 0 && microtime(true) - $client['created'] > $client['maxClientLiveTime']) {
                            if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                 call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_LIVE_TO_LONG']);
                            }
                            
                            $this->closeClient($client);
                        }

                        continue;
                    }

                    $client['lastActivityTime'] = microtime(true);
                    $client['ping'] = false;  

                    if($client['maxClientRequestCount'] !== false) {
                        if ($client['maxClientRequestCount'] <= 0) {
                            if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                 call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_HAS_TOO_MANY_REQUESTS']);
                            }
                            
                            $this->closeClient($client);
                            continue;
                        }  else {
                            $client['maxClientRequestCount']--;
                        }
                    }
                    
                    if($client['maxClientRequestPerMinuteCount'] !== false) {
                        if ($client['maxClientRequestPerMinuteCount'] <= $client['requestPerMinuteCount']) {
                            if (isset($this->clientDisconnectedEvent) && is_callable($this->clientDisconnectedEvent)) {
                                 call_user_func_array($this->clientDisconnectedEvent, [&$client, 'CLIENT_HAS_TOO_MANY_REQUESTS_PER_MINUTE']);
                            }
                            
                            $this->closeClient($client);
                            continue;
                        }
                        
                        if(microtime(true) - $client['requestPerMinuteInterval'] >= 60) {
                            $client['requestPerMinuteInterval'] = microtime(true);
                             $client['requestPerMinuteCount'] = 0;
                        }
                        
                        $client['requestPerMinuteCount']++;
                    }

                    $client['requestCount']++;
 
                    if (is_callable($readFromClientEvent)) {
                        call_user_func_array($readFromClientEvent, [&$client, &$data]);
                    }
                }
            }
            echo date("Y-m-d h:i:s")." WAIT \n";
            usleep($this->options['waitInterval']);
        }
    }
}
