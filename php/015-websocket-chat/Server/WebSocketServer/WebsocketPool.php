<?php

namespace WebSocketServer;

use SocketServer\SocketPool;

class WebSocketPool {   
            
	public function listen($clients) {
		$pool = new SocketPool();
        $socketClients = [];
        foreach ($clients as $client) {
            $socketClients[] = $client->getSocketClient();
        }
        
        $pool->listen($socketClients);
    }
}
