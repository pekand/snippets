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

$client3 = new WebsocketClient();
$client4 = new WebsocketClient();
$operator2 = new WebsocketClient();

$state = [];

/* CLIENT1 */

$client1->afterConnect(function ($client) {
    echo "C1 After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
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
    
    if($data['operation'] == 'operatorConnected') { 
        echo "C1 operator is connected\n";
    }
    
    if($data['operation'] == 'allOperatorsDisconected') { 
        echo "C1 no operator is connected notification\n";
    }
    
    if($data['operation'] == 'message') { 
        echo "C1 mesage from (".$data['from']."): ".$data['message']."\n";
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
    }
    
    if($data['operation'] == 'operatorBroadcastMessage') { 
        echo "C2 operator (".$data['operator']."): broadcast message: ".$data['message']."\n";
    }
    
    if($data['operation'] == 'message') { 
        echo "C2 mesage from (".$data['from']."): ".$data['message']."\n";
    }
    
});

/* OPERATOR1 */

$operator1->afterConnect(function ($client) {
    echo "OP After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
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
    }
    
    if($data['operation'] == 'loginFailed') { 
        echo "OP1 Unsuccessful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'clients') { 
        echo "OP1 Recived client list\n";
        foreach ($data['clients'] as $clientUid) {
             echo "OP1 Recived client: $clientUid\n";
        }      
    }
    
    if($data['operation'] == 'clientDisconected') { 
        echo "OP1 client disconected: ".$data['clientUid']."\n";
    }
    
    if($data['operation'] == 'messageFromClient') { 
        echo "OP1 Recived mesasge from client (".$data['from'].") message: ".$data['message']."\n";
    }
    
    if($data['operation'] == 'message') { 
        echo "OP1 mesage from (".$data['from']."): ".$data['message']."\n";
        /*$client->sendMessage(json_encode(['operation'=>'close']));*/
    }
});

/* CLIENT3 */

$client3->afterConnect(function ($client) {
    echo "C3 After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
});

$client3->addListener(function ($client, $request) {
    global $state;
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "C3: Server return clientUid: ".$data['uid']."\n"; 
       
       $state['client3']['uid'] = $data['uid'];
    }
    
    if($data['operation'] == 'chatUid') { 
       echo "C3: Server return chatUid: ".$data['chatUid']."\n";
       $state['client3']['chatUid'] = $data['chatUid'];
    } 
});

/* CLIENT4 */

$client4->afterConnect(function ($client) {
    echo "C4 After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
});

$client4->addListener(function ($client, $request) {
    global $state;
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "C4: Server return clientUid: ".$data['uid']."\n"; 
       $state['client4']['uid'] = $data['uid'];
    }
    
    if($data['operation'] == 'chatUid') { 
       echo "C4: Server return chatUid: ".$data['chatUid']."\n";
       $state['client4']['chatUid'] = $data['chatUid'];
    } 
    
    if($data['operation'] == 'message') { 
        echo "C2 mesage from (".$data['from']."): ".$data['message']."\n";
    }
});

$operator2->afterConnect(function ($client) {
    echo "OP2 After connect\n";
    $client->sendMessage(json_encode(['operation'=>'getUid']));
});

$operator2->addListener(function ($client, $request) {
    global $state;
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $client->sendMessage(json_encode(['operation'=>'pong']));      
    }
    
    if($data['operation'] == 'uid') { 
       echo "OP2: Server return clientUid: ".$data['uid']."\n"; 
       $state['operator2']['uid'] = $data['uid'];
    }
    
    if($data['operation'] == 'loginSuccess') { 
        echo "OP2 Successful attempt to login as operator\n";   
    }
    
    if($data['operation'] == 'loginFailed') { 
        echo "OP2 Unsuccessful attempt to login as operator\n";
    }
    
    if($data['operation'] == 'allOpenChats') { 
        echo "OP2 Recived chat list\n";
        foreach ($data['chats'] as $chatUid) {
             echo "OP2 Recived chat: $chatUid\n";
        }       
    }
    
    if($data['operation'] == 'clientDisconected') { 
        echo "OP2 client disconected: ".$data['clientUid']."\n";
    }
});

$pool = new WebSocketPool();

/* ACTIONS */
$pool->addAction(1000000, function(){
    echo "Action: Client1 send message to self and client2 \n";
    
    global $state;
    global $client1;
    
    $client1->sendMessage(json_encode(['operation'=>'ping']));

    //$client->sendMessage(json_encode(['operation'=>'shutdown']));
  
   $client1->sendMessage(json_encode([
    'operation'=>'sendMessage',
    'to'=>$state['client1']['uid'],
    'message'=>"Mesage from client1 to client1"
   ]));      
   
   $client1->sendMessage(json_encode([
    'operation'=>'sendMessage', 
    'to'=> $state['client2']['uid'],
    'message'=>"Mesage from client1 to client2"
    ])); 
});

$pool->addAction(1500000, function(){
    echo "Action: Client1 invalid login as operator \n";
    
    global $state;
    global $client1;
    
    $client1->sendMessage(json_encode(['operation'=>'login','token'=>'wrong_pasword']));
    $client1->sendMessage(json_encode(['operation'=>'logout']));
    $client1->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
    $client1->sendMessage(json_encode(['operation'=>'logout']));
    $client1->sendMessage(json_encode(['operation'=>'isOperatorLogged']));
    //$client->sendMessage(json_encode(['operation'=>'shutdown']));
  
});

$pool->addAction(1700000, function(){
    echo "Action: Client1 login and logout as operator \n";
    
    global $state;
    global $client1;
    
    $client1->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
    $client1->sendMessage(json_encode(['operation'=>'logout']));
});

$pool->addAction(1900000, function(){
    echo "Action: Client1 check if operator is still logged \n";
    
    global $state;
    global $client1;
    
    $client1->sendMessage(json_encode(['operation'=>'isOperatorLogged']));
});

$pool->addAction(2000000, function(){
    echo "Action: Client2 send mesage to all operators\n";
    
    global $state;
    global $client2;
    
    
    $client2->sendMessage(json_encode([
      'operation'=>'sendMessageToOperator',
      'message'=>"message from client2 to all operators",
    ]));
    
});

$pool->addAction(3000000, function(){
    echo "Action: operator1 login\n";
    
    global $state;
    global $operator1;

    $operator1->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
});

$pool->addAction(3500000, function(){
    echo "Action: operator1 get opened clients\n";
    
    global $state;
    global $operator1;

    $operator1->sendMessage(json_encode(['operation'=>'getClients']));
});

$pool->addAction(4000000, function(){
    echo "Action: Operator1 broadcast message to all clients\n";
    
    global $state;
    global $operator1;

    $operator1->sendMessage(json_encode(['operation'=>'broadcast', "message"=>"Mesage from operator1 to all clients"]));
});

$pool->addAction(4500000, function(){
    echo "Action: operator1 send message to client1 \n";
    
    global $state;
    global $operator1;
       
    $operator1->sendMessage(json_encode([
        'operation'=>'sendMessage', 
        'to'=> $state['client1']['uid'],
        'message'=>"Mesage from operator1 to client1"
    ]));
});

$pool->addAction(5000000, function(){
    echo "Action: Client2 close connection\n";
    
    global $state;
    global $client2;
    
    
    $client2->sendMessage(json_encode(['operation'=>'close'])); // TODO
    
});

$pool->addAction(5500000, function(){
    echo "Action: Closed client2 send messge to client1\n";
    
    global $state;
    global $client2;
    
    
    $client2->sendMessage(json_encode([
        'operation'=>'sendMessage', 
        'to'=> $state['client1']['uid'],
        'message'=>"Mesage from client2 to client1"
    ]));
    
});

$pool->addAction(6000000, function(){
    echo "Action: Client3 open new chat\n";
    
    global $state;
    global $client3;
    
    
    $client3->sendMessage(json_encode(['operation'=>'openChat', 'chatUid'=>'']));
    
});


$pool->addAction(7000000, function(){
    echo "Action: Client4 open new chat\n";
    
    global $state;
    global $client4;

    $client4->sendMessage(json_encode(['operation'=>'openChat', 'chatUid'=>'']));
    
});

$pool->addAction(8000000, function(){
    echo "Action: Operator2 login\n";
    
    global $state;
    global $operator2;

    $operator2->sendMessage(json_encode(['operation'=>'login','token'=>'password']));
});

$pool->addAction(8500000, function(){
    echo "Action: Operator2 get open chats\n";
    
    global $state;
    global $operator2;

    $operator2->sendMessage(json_encode(['operation'=>'getAllOpenChats']));
});

$pool->addAction(9000000, function(){    
    echo "Action: CLose all operators\n";
    
    global $state;
    global $client1;
    global $client2;
    global $client3;
    global $operator1;
    global $operator2;

    $operator1->sendMessage(json_encode(['operation'=>'close']));
    $operator2->sendMessage(json_encode(['operation'=>'close']));
    
});

$pool->addAction(9500000, function(){    
    echo "Action: CLose all clients\n";
    
    global $state;
    global $client1;
    global $client3;

    $client1->sendMessage(json_encode(['operation'=>'close']));
    $client3->sendMessage(json_encode(['operation'=>'close']));
    
});

  
$pool->listen([
    $client1, $client2, $operator1,
    $client4, $client3, $operator2
]);
