<?php
namespace WebSocketServer;

use WebSocketServer\WebSocketServerBase;
use SocketServer\SocketServer;

class WebSocketServer extends WebSocketServerBase {
    
    private $frames = [];
    
    private $socketServer = null; 
    
    public function __construct($options) {
        $this->socketServer = new SocketServer($options);
    }

    public function afterClientError($afterClientError){ 
        $this->afterClientError = $afterClientError;
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
    
    public function sendMessage(&$client, $message){ 
        return $this->socketServer->sendData($client, $this->mesage($message));
    }
    
    public function close(&$client) {
       $this->socketServer->close($client);
    }
    
    public function listen($getFrameEvent) {
        $this->getFrameEvent = $getFrameEvent;
        
        $this->socketServer
            ->afterServerError($this->afterServerError) // server cause error
            ->afterClientError(function(&$client, $code, $mesage) { // client cause error
                $server = $this;

                
     
                if (isset($this->afterClientError) && is_callable($this->afterClientError)) {
                    call_user_func_array($this->afterClientError, [&$server, &$client, $code, $mesage]);
                }
                
                if ($code == 10053) { // client disconected
                    $server = $this;
                    if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                        call_user_func_array($this->clientDisconectEvent, [&$server, &$client]);
                    }
                    
                    $this->socketServer->close($client);
                }
                
            })
            ->acceptClient(function (&$client, &$data) { // client connected
                $headers = $this->createConnectHeader($data);
                
                $this->socketServer->sendData($client, $headers);
                
                $this->frames[$client['uid']] = null;
                
                $server = $this;
                if (isset($this->clientConnectedEvent) && is_callable($this->clientConnectedEvent)) {
                   return call_user_func_array($this->clientConnectedEvent, [&$server, &$client]);
                }
                
                return true;
            })
            ->clientDisconnected(function(&$client) { // client disconected
                $server = $this;
                if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                    call_user_func_array($this->clientDisconectEvent, [&$server, &$client]);
                }
            })
            ->buildPing(function(&$client) {
                return $this->socketServer->sendData($client, $this->mesage("PING", 1));
            })
            ->bindSocket()
            ->listenToSocket(
                function (&$client, &$data) { // client send request

                    while(strlen($data) > 0) {                       
                        $lastFrame = $this->frames[$client['uid']];
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