<?php

namespace SocketServer;

class SocketPool {   
    
	public function listen($clients = null) {
        foreach ($clients as $client) {
            $client->connect();
        }
        
        while(true) {   
            foreach ($clients as $client) {
                $client->listenBody();
            }
            usleep(50000);
        }
    }
}
