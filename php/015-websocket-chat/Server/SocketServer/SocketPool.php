<?php

namespace SocketServer;

class SocketPool {   
    private $actions = [];
    private $ticks = 0;
    
    public function addAction($delay, $action) {
    	$this->actions[] = [
    		'delay' => $delay,
    		'executed' => false,
    		'callback' => $action,
    	];
    }
    
	public function listen($clients = null) {
        foreach ($clients as $client) {
            $client->connect();
        }
        
        while(true) {   
            foreach ($clients as $client) {
                $client->listenBody();
            }
            
            foreach ($this->actions as &$action) {
                if(!$action['executed'] && $action['delay'] <= $this->ticks) {
                	$action['executed'] = true;
                	if (is_callable($action['callback'])) {
                        call_user_func_array($action['callback'], []);
                    }                	
                }
            }
            
            usleep(10000);
            $this->ticks += 10000;
        }
    }
}
