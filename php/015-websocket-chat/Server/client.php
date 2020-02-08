<?php

set_time_limit(0);

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

use WebSocketServer\WebsocketClient;
use WebSocketServer\WebSocketPool;

$client1 = new WebsocketClient();
$client2 = new WebsocketClient();
$operator1 = new WebsocketClient();

$state = [];

$client1Uid = null;
$client2Uid = null;
$operator1Uid = null;

/* CLIENT1 */
$client1->afterConnect(function ($client) {
    echo "C1 After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
    $client->sendMessage(json_encode(['operation'=>'ping']));
    //$client->sendMessage(json_encode(['operation'=>'shutdown']));
    //$client->sendMessage(json_encode(['operation'=>'close'])); 
    $client->sendMessage(json_encode(['operation'=>'login','token'=>'wrong_pasword']));
    $client->sendMessage(json_encode(['operation'=>'logout']));
    $client->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
    $client->sendMessage(json_encode(['operation'=>'logout']));
});

$client1->addListener(function ($client, $request) {    
    global $state;
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "C1 Server return clientUid: ".$data['uid']."\n"; 

       $state['client1']['uid'] = $data['uid'];
       
       $client->sendMessage(json_encode([
        'operation'=>'sendMessage',
        'to'=>$state['client1']['uid'],
       ]));      
    }
    
    if($data['operation'] == 'pong') { 
        echo "C1 Server response to pong\n";
    }

    if($data['operation'] == 'loginSuccess') { 
        echo "C1 Successful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'logoutSuccess') { 
        echo "C1 Successful attempt to logout as operator\n";
    }
    
    if($data['operation'] == 'loginFailed') { 
        echo "C1 Unsuccessful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'accessDenied') { 
        echo "C1 Accessdenied to opperation: ".$data['forbidden']."\n";
    }
    
    if($data['operation'] == 'operatorBroadcastMessage') { 
        echo "C1 operator (".$data['operator']."): broadcast message: ".$data['message']."\n";
    }
    
    if($data['operation'] == 'message') { 
        echo "C1 mesage from (".$data['from']."): ".$data['message']."\n";
        $client->sendMessage(json_encode(['operation'=>'sendMessage', "to"=> $state['client2']['uid'],"message"=>"Mesage from client1 to client2"])); 
    }

});

/* CLIENT 2*/

$client2->afterConnect(function ($client) {
    echo "C2 After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
});

$client2->addListener(function ($client, $request) {
    global $state;
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "C2: Server return clientUid: ".$data['uid']."\n"; 
       
       $state['client2']['uid'] = $data['uid'];
       
       $client->sendMessage(json_encode([
        'operation'=>'sendMessageToOperator',
        'message'=>"message from client2 to all operators",
       ]));
    }
    
    if($data['operation'] == 'operatorBroadcastMessage') { 
        echo "C2 operator (".$data['operator']."): broadcast message: ".$data['message']."\n";
    }
    
    if($data['operation'] == 'message') { 
        echo "C2 mesage from (".$data['from']."): ".$data['message']."\n";
        $client->sendMessage(json_encode(['operation'=>'sendMessage', "to"=> $state['operator1']['uid'],"message"=>"Mesage from client2 to operator1"]));  
    }
    
});

/* OPERATOR 2 */
$operator1->afterConnect(function ($client) {
    echo "OP After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
    $client->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
});

$operator1->addListener(function ($client, $request) {
    global $state;
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
        echo "OP1 Server return clientUid: ".$data['uid']."\n";   
        $state['operator1']['uid'] = $data['uid'];
    }
    
    if($data['operation'] == 'loginSuccess') { 
        echo "OP1 Successful attempt to login as operator\n";
        
        $client->sendMessage(json_encode(['operation'=>'getClients']));        
    }
    
    if($data['operation'] == 'loginFailed') { 
        echo "OP1 Unsuccessful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'clients') { 
        echo "OP1 Recived client list\n";
        foreach ($data['clients'] as $clientUid) {
             echo "OP1 Recived client: $clientUid\n";
        }
        
        $client->sendMessage(json_encode(['operation'=>'broadcast', "message"=>"Mesage from operator1 to all clients"]));        
        $client->sendMessage(json_encode(['operation'=>'sendMessage', "to"=> $state['client1']['uid'],"message"=>"Mesage from operator1 to client1"]));        
    }
    
    if($data['operation'] == 'messageFromClient') { 
        echo "OP1 Recived mesasge from client (".$data['from'].") message: ".$data['message']."\n";
    }
    
    if($data['operation'] == 'message') { 
        echo "OP1 mesage from (".$data['from']."): ".$data['message']."\n";
    }

});


$pool = new WebSocketPool();
$pool->listen([$client1, $client2, $operator1]);
