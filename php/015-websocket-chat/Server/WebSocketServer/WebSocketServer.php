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
    
    public function beforeSendMessage($beforeSendMessage) { 
        $this->beforeSendMessage = $beforeSendMessage;
        return $this;
    }
    
    public function sendMessage($clientUid, $message){ 
        if (isset($this->beforeSendMessage) && is_callable($this->beforeSendMessage)) {
            call_user_func_array($this->beforeSendMessage, [$this, $clientUid, $message]);
        }
                
        return $this->socketServer->sendData($clientUid, $this->mesage($message));
    }
    
    public function getClient($clientUid) {      
       return $this->socketServer->getClient($clientUid);
    }
    
    public function isClient($clientUid) {      
       return $this->socketServer->isClient($clientUid);
    }
        
    public function closeClient($clientUid) {

        if (isset($this->frames[$clientUid])) {
            unset($this->frames[$clientUid]);
        }
       
       $this->socketServer->closeClient($clientUid);
    }
    
    public function listen($getFrameEvent) {
        $this->getFrameEvent = $getFrameEvent;
        
        $this->socketServer
        ->afterServerError($this->afterServerError) // server cause error
        ->afterClientError(function($clientUid, $code, $mesage) { // client cause error
            $server = $this;
            if (isset($this->afterClientError) && is_callable($this->afterClientError)) {
                call_user_func_array($this->afterClientError, [$server, $clientUid, $code, $mesage]);
            }
        })
        ->acceptClient(function ($clientUid, $data) { // client connected
            $headers = $this->createConnectHeader($data);
            
            $this->socketServer->sendData($clientUid, $headers);
            
            $this->frames[$clientUid] = null;
            
            $server = $this;
            if (isset($this->clientConnectedEvent) && is_callable($this->clientConnectedEvent)) {
               return call_user_func_array($this->clientConnectedEvent, [$server, $clientUid]);
            }
            
            return true;
        })
        ->clientDisconnected(function($clientUid, $reason) { // client disconected
            $server = $this;
            if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                call_user_func_array($this->clientDisconectEvent, [$server, $clientUid, $reason]);
            }
            
            $this->socketServer->sendData($clientUid, $this->mesage("", 8));
            $this->closeClient($clientUid);
        })
        ->buildPing(function($clientUid) {
            
            $server = $this;
            if (isset($this->buildPing) && is_callable($this->buildPing)) {
                $message =  call_user_func_array($this->buildPing, [$server, $clientUid]);
            }
        })
        ->bindSocket()
        ->listenToSocket(
            function ($clientUid, $data) { // client send request
                $lastFrame  = null;
                if (isset($this->frames[$clientUid]) && $this->frames[$clientUid] != null) { // ceck for unfinished frame
                    $lastFrame = $this->frames[$clientUid]; 
                    $this->frames[$clientUid] = null;
                }
                
                try {
                    $frames = $this->proccessRequest($lastFrame, $data);
                } catch (\Exception $e) {                    
                    if (isset($this->afterClientError) && is_callable($this->afterClientError)) {
                        call_user_func_array($this->afterClientError, [$this, $clientUid, null, $e->getMessage()]);
                    }
                }
                    
                foreach ($frames as $frame) {                    
                    $this->frames[$clientUid] = $frame;
                    if ($frame == null) {
                        return;
                    }

                    $server = $this;
                    
                    if (!$frame['full']) {
                        $this->frames[$clientUid] = $frame;
                        break;                    
                    }

                    if ($frame['opcode'] == 8) { // denotes a connection close 
                        $server = $this;
                        if (isset($this->clientDisconectEvent) && is_callable($this->clientDisconectEvent)) {
                            call_user_func_array($this->clientDisconectEvent, [$server, $clientUid, 'CLIENT_CLOSE_CONNECTION']);
                        }
                        
                        $this->closeClient($clientUid);
                        return;
                    }
                    
                    if ($frame['opcode'] == 9) { // denotes a ping
                        $this->socketServer->sendData($clientUid, $this->mesage("", 10));
                        return;
                    }
                
                    if (isset($this->getFrameEvent) && is_callable($this->getFrameEvent)) {
                        $request = $frame['payloaddata'];
                        call_user_func_array($this->getFrameEvent, [$server, $clientUid, $request]);
                        $this->frames[$clientUid] = null;
                    }
                }
            }
        );
    }
}
