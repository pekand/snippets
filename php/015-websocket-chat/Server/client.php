<?php

set_time_limit(0);

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

use WebSocketServer\WebsocketClient;

$client1 = new WebsocketClient();
$client2 = new WebsocketClient();

$client1->connect(function ($client) {
	$client->sendMessage(json_encode(['operation'=>'getUid']));
	$client->sendMessage(json_encode(['operation'=>'ping']));
	//$client->sendMessage(json_encode(['operation'=>'shutdown']));
	//$client->sendMessage(json_encode(['operation'=>'close'])); 
	$client->sendMessage(json_encode(['operation'=>'login','token'=>'wrong_pasword']));
	$client->sendMessage(json_encode(['operation'=>'logout'])); // not logged
	$client->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
	$client->sendMessage(json_encode(['operation'=>'logout']));

});

$client2->connect(function ($client) {
	$client->sendMessage(json_encode(['operation'=>'getUid']));
});

$client1->addListener(function ($client, $request) {
	$data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "Server return clientUid: ".$data['uid']."\n"; 
       
       $clientUid = $data['uid'];
       
       $client->sendMessage(json_encode([
       	'operation'=>'sendMessage',
       	'to'=>$clientUid,
       ]));      
        
       
    }
    
    if($data['operation'] == 'pong') { 
        echo "Server response to pong\n";
    }

    if($data['operation'] == 'loginSuccess') { 
        echo "Successful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'logoutSuccess') { 
        echo "Successful attempt to logout as operator\n";
    }
    
    if($data['operation'] == 'loginFailed') { 
        echo "Unsuccessful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'accessDenied') { 
        echo "Accessdenied to opperation: ".$data['forbidden']."\n";
    }
});

$client2->addListener(function ($client, $request) {
	$data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "Server return clientUid: ".$data['uid']."\n"; 
       
       $clientUid = $data['uid'];
       
       $client->sendMessage(json_encode([
       	'operation'=>'sendMessage',
       	'to'=>$clientUid,
       ]));      
        
       
    }
});




$client1->listen();