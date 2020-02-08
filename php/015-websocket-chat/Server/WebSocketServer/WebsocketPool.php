<?php

namespace WebSocketServer;

use SocketServer\SocketPool;

class WebSocketPool {   
    private $socketPool = null;
    
    public function __construct() {
    	$this->socketPool = new SocketPool();
    }
         
    public function addAction($delay, $action) {
    	$this->socketPool->addAction($delay, $action);
    }   
    
	public function listen($clients) {
		
        $socketClients = [];
        foreach ($clients as $client) {
            $socketClients[] = $client->getSocketClient();
        }
        
        $this->socketPool->listen($socketClients);
    }
}
