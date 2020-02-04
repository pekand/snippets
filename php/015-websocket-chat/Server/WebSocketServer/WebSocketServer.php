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
    
    public function buildPing($buildPing){ 
        $this->buildPing = $buildPing;
        return $this;
    }
    
    public function afterSendMesage($afterSendMesage) { 
        $this->afterSendMesage = $afterSendMesage;
        return $this;
    }
    
    public function sendMessage(&$client, $message){ 
        if ($client == null) {
            return;
        }
        
        if (isset($this->afterSendMesage) && is_callable($this->afterSendMesage)) {
            call_user_func_array($this->afterSendMesage, [&$server, &$client, $message]);
        }
                
        return $this->socketServer->sendData($client, $this->mesage($message));
    }
    
    public function getClient($uid) {      
       return $this->socketServer->getClient($uid);
    }
        
    public function closeClient(&$client) {

        if (isset($this->frames[$client['uid']])) {
            unset($this->frames[$client['uid']]);
        }
       
       $this->socketServer->closeClient($client);
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
            ->clientDisconnected(function(&$client, $reason) { // client disconected
                $server = $this;
                if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                    call_user_func_array($this->clientDisconectEvent, [&$server, &$client, $reason]);
                }
                
                $this->socketServer->sendData($client, $this->mesage("", 8));
                $this->closeClient($client);
            })
            ->buildPing(function(&$client) {
                
                $server = $this;
                if (isset($this->buildPing) && is_callable($this->buildPing)) {
                    $message =  call_user_func_array($this->buildPing, [&$server, &$client]);
                }
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
                        
                        if (!$frame['full']) {
                            continue;
                        }

                        if ($frame['opcode'] == 8) { // denotes a connection close 
                            $server = $this;
                            if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                                call_user_func_array($this->clientDisconectEvent, [&$server, &$client, 'CLIENT_CLOSE_CONNECTION']);
                            }
                            
                            $this->closeClient($client);
                            return;
                        }
                        
                        if ($frame['opcode'] == 9) { // denotes a ping
                            $this->socketServer->sendData($client, $this->mesage("", 10));
                            return;
                        }
                    
                        if (isset($this->getFrameEvent) && is_callable($this->getFrameEvent)) {
                            $request = $frame['payloaddata'];
                            call_user_func_array($this->getFrameEvent, [&$server, &$client, $request]);
                            $this->frames[$client['uid']] = null;
                        }
                    }
                }
            );
    }
}