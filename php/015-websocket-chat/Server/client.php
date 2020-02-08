<?php

set_time_limit(0);

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

use WebSocketServer\WebsocketClient;

$client = new WebsocketClient();



$client->addListener(function ($client, $request) {
	//$client->sendMessage(json_encode(['operation'=>'getUid']));

	$data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
        var_dump($data['uid']);
        //die();
    }
});


$client->connect(function ($client) {
	$client->sendMessage(json_encode(['operation'=>'getUid']));
});

$client->listen();