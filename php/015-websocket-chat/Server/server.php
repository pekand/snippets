<?php

set_time_limit(0);

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

use WebSocketServer\WebSocketServer;
use Logic\Log;
use Logic\ChatsStorage;
use Logic\ServerLogic;

Log::setAllowdSeverity(['INFO', 'ERROR', 'DEBUG']);
Log::write("WEBSOCKET SERVER START");

$server = new WebSocketServer([
    'ip' => '0.0.0.0',
    'port' => 8080
]);

$server->afterServerError(function($code, $message) {
     Log::write("SERVER ERROR [$code]: $message", "ERROR");
});

$server->afterClientError(function($server, $clientUid, $code, $message) {
    Log::write("({$clientUid}) [$code]: $message", "ERROR");
});

$server->afterShutdown(function($server) {
    Log::write("SERVER SHUTDOWN");
});

$server->clientConnected(function($server, $clientUid) {
    Log::write("({$clientUid}) CLIENT CONNECTED");
    ServerLogic::addClient($clientUid);      
    return true;
});

$server->clientDisconnected(function($server, $clientUid, $reason) {
    Log::write("({$clientUid}) CLIENT DISCONNECTED: {$reason}");
    
    ServerLogic::removeOperator($clientUid);
    ServerLogic::removeClient($clientUid);
    
    $chatStorage = ServerLogic::getChatStorage();
    
    /*if(ServerLogic::isOperator($clientUid)){
        $chatStorage->removeOperatorFromAllChats($clientUid);
    } else {
        $chatStorage->removeClientFromAllChats($clientUid);
    }*/
    
    foreach (ServerLogic::getOperators() as $uid => $value) { 
        Log::write("({$clientUid}) Client disconected notification to operator {$uid}");
        $server->sendMessage($uid , json_encode(['operation'=>'clientDisconected', 'client'=> $clientUid])); 
    }
    
    if(count(ServerLogic::getOperators()) == 0) {
        foreach (ServerLogic::getClients() as $uid => $value) { 
            Log::write("({$clientUid}) All operators disconected notification to client {$uid}");
            $server->sendMessage($uid , json_encode(['operation'=>'allOperatorsDisconected'])); 
        }
    }
});

$server->buildPing(function($server, $clientUid) {     
     $server->sendMessage($clientUid, json_encode(['operation'=>'ping']));
});

$server->beforeSendMessage(function($server, $clientUid, $message) {
    $data = json_decode($message, true);
    
    $severity = 'INFO';
    if (isset($data['operation']) && ($data['operation'] == 'ping' || $data['operation'] == 'pong')) {
        $severity = 'DEBUG';
    }
        
    Log::write("({$clientUid}) MESSAGE TO CLIENT: {$message}", $severity);
});

// display header
$server->addListener(function($server, $clientUid, $request) {   
    
    $requestFromClient = $request;
    if(strlen($requestFromClient)>1000) {
        $requestFromClient = substr($request, 0, 100)."...";
    }     
         
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    $severity = 'INFO';
    if ($data['operation'] == 'ping' || $data['operation'] == 'pong') {
        $severity = 'DEBUG';
    }
    
    Log::write("({$clientUid}) REQUEST FROM CLIENT (".strlen($request)."): ".$requestFromClient, $severity);
});

/* TOOLS */
$server->addListener(function($server, $clientUid, $request) {  
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'ping') { 
        $server->sendMessage($clientUid, json_encode(['operation'=>'pong']));      
    }

    if($data['operation'] == 'getUid') { 
        $server->sendMessage($clientUid, json_encode(['operation'=>'uid', 'uid'=>$clientUid]));      
    }

});

/* ACCESS */
$server->addListener(function($server, $clientUid, $request) {    
    
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'shutdown') { 
        $server->shutdown();
    }
    
    if($data['operation'] == 'close') { 
        Log::write("({$clientUid}) Client call close operation on self");
        $server->closeClient($clientUid);
        
        foreach (ServerLogic::getOperators() as $uid => $value) { 
            Log::write("({$clientUid}) Client disconected notification to operator {$uid}");
            $server->sendMessage($uid , json_encode(['operation'=>'clientDisconected', 'clientUid'=> $clientUid])); 
        }
        
        if(count(ServerLogic::getOperators()) == 0) {
            foreach (ServerLogic::getClients() as $uid => $value) { 
                Log::write("({$clientUid}) All operators disconected notification to client {$uid}");
                $server->sendMessage($uid , json_encode(['operation'=>'allOperatorsDisconected'])); 
            }
        }
    }
    
    if($data['operation'] == 'login') { 
        if($data['token'] == 'password') { 
            Log::write("({$clientUid}) Operator accepted");
            ServerLogic::addOperator($clientUid);  
            
            $server->sendMessage($clientUid, json_encode(['operation'=>'loginSuccess'])); 
              
            foreach (ServerLogic::getOperators() as $operatorUid => $value) { 
                Log::write("({$clientUid}) Operator login notification {$operatorUid}");
                $server->sendMessage($operatorUid , json_encode(['operation'=>'operatorLogin', 'operator'=> $clientUid])); 
            }        
        } else {
            Log::write("({$clientUid}) Operator rejected");
            $server->sendMessage($clientUid, json_encode(['operation'=>'loginFailed']));   
        }
    }
    
    if($data['operation'] == 'logout') { 
        if(ServerLogic::isOperator($clientUid)) { 
            Log::write("({$clientUid}) Operator logout operator");
            ServerLogic::removeOperator($clientUid);
            
            $server->sendMessage($clientUid, json_encode(['operation'=>'logoutSuccess'])); 
            
            foreach (ServerLogic::getOperators() as $operatorUid => $value) { 
                Log::write("({$clientUid}) Operator logout {$operatorUid}");
                $server->sendMessage($operatorUid , json_encode(['operation'=>'operatorLogout', 'operator'=> $clientUid])); 
            } 
    
        } else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'logout']));   
        }   
    }
    
    if($data['operation'] == 'isOperatorLogged') { 
        Log::write("({$clientUid}) Check if operator is logged");
        if(count(ServerLogic::getOperators()) == 0) {
            $server->sendMessage($clientUid , json_encode(['operation'=>'operatorConnected'])); 
        } else {
            $server->sendMessage($clientUid , json_encode(['operation'=>'allOperatorsDisconected']));
        }
    }
});


/* MESSAGES */
$server->addListener(function($server, $clientUid, $request) {        
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'sendMessage' && isset($data['to']) && isset($data['message'])) { 
        $toUid = $data['to'];
        if($server->isClient($toUid)){        
            Log::write("({$clientUid}) Message to {$toUid} : {$data['message']}");
            $server->sendMessage($toUid, json_encode(['operation'=>'message', 'from'=>$clientUid, 'message'=>$data['message'] ]));   
        }
    }
    
    if($data['operation'] == 'sendMessageToOperator' && isset($data['message'])) { 
        foreach (ServerLogic::getOperators() as $operatorUid => $value) { 
            Log::write("({$clientUid}) Client Send Message To Operator {$operatorUid}: {$data['message']}");
            $server->sendMessage($operatorUid , json_encode(['operation'=>'messageFromClient', 'from'=> $clientUid, 'message'=>$data['message']])); 
        }   
    }
    
    if($data['operation'] == 'getClients') { 
        if(ServerLogic::isOperator($clientUid)) {
            $clients = [];
            foreach (ServerLogic::getClients() as $uid => $value) { 
                $clients[] = $uid;
            }
            $server->sendMessage($clientUid, json_encode(['operation'=>'clients', 'clients'=>$clients]));   
        }  else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'getClients']));   
        }
    }
    
    if($data['operation'] == 'broadcast') { 
        if(ServerLogic::isOperator($clientUid) && isset($data['message'])) { 
            Log::write("({$clientUid}) Operator broadcast");
            foreach (ServerLogic::getClients() as $uid => $value) {                
                Log::write("({$clientUid}) Addmin broadcast to {$uid}: {$data['message']}");
                $server->sendMessage($uid, json_encode(['operation'=>'operatorBroadcastMessage', 'operator'=>$clientUid, 'message'=>$data['message']])); 
            }
        } else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'broadcast']));   
        }     
    }
});


/* CHATS */
$server->addListener(function($server, $clientUid, $request) {   
    $data = json_decode($request, true);
    if (!isset($data['operation'])) {
        return;
    }
    
    if($data['operation'] == 'openChat' && isset($data['chatUid'])) { 
        $chatStorage = ServerLogic::getChatStorage();
        $chatUid = $chatStorage->openChat($data['chatUid'], $clientUid);
        $chatStorage->addClientToChat($chatUid, $clientUid);
        
        $server->sendMessage($clientUid, json_encode(
                [
                    'operation'=>'chatUid', 
                    'chatUid'=> $chatUid,
                ]
            )
        );    
        
        foreach (ServerLogic::getOperators() as $operatorUid => $value) { 
            Log::write("({$clientUid}) Client open chat {$chatUid}");
            $server->sendMessage($operatorUid , json_encode(['operation'=>'newChat', 'chatUid'=>$chatUid])); 
        }  
    }
    
    
    if($data['operation'] == 'getAllOpenChats') { 
        if(ServerLogic::isOperator($clientUid)) {
            $chatStorage = ServerLogic::getChatStorage();
            $chatStorage->addOperatorToAllChats($clientUid);
            $server->sendMessage($clientUid, json_encode(['operation'=>'allOpenChats', 'chats'=>$chatStorage->getChats()]));               
        }  else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'getChats']));   
        }
    }
    
    
    if($data['operation'] == 'getChatHistory' && isset($data['chatUid'])) { 
        
        $chatStorage = ServerLogic::getChatStorage();
        $chatHsitory = $chatStorage->getChatHistory($data['chatUid']);
        
        $server->sendMessage($clientUid, json_encode(
                [
                    'operation'=>'chatHistory', 
                    'chatUid'=> $data['chatUid'],
                    'chatHistory' => $chatHsitory,
                ]
            )
        );      
    }
    
    if($data['operation'] == 'addClientMessageToChat' && isset($data['chatUid']) && isset($data['message'])) { 
        $chatStorage = ServerLogic::getChatStorage();        
        $chatStorage->addClientMessage($data['chatUid'], $clientUid, $data['message']);
        $chatStorage->saveChat($data['chatUid']);     
        
        $chat = $chatStorage->getChat($data['chatUid']);
          
        foreach (array_merge($chat['participants']['operators'], $chat['participants']['clients']) as $participantUid) {
            if($participantUid == $clientUid) {
                continue;
            }
            
            $server->sendMessage($participantUid, json_encode([
                'operation'=>'clientAddMessageToChat', 
                'chatUid'=>$data['chatUid'], 
                'operator'=> $clientUid,
                'message'=>$data['message'],
            ]));   
        }   
    }
    
    if($data['operation'] == 'addOperatorMessageToChat' && isset($data['chatUid']) && isset($data['message'])) { 
        $chatStorage = ServerLogic::getChatStorage();  
        $chatStorage->addOperatorMessage($data['chatUid'], $clientUid, $data['message']);
        $chatStorage->saveChat($data['chatUid']); 
        
        $chat = $chatStorage->getChat($data['chatUid']);
        foreach (array_merge($chat['participants']['operators'], $chat['participants']['clients']) as $participantUid) {
            if($participantUid == $clientUid) {
                continue;
            }
            
            $server->sendMessage($participantUid, json_encode([
                'operation'=>'operatorAddMessageToChat', 
                'chatUid'=>$data['chatUid'], 
                'operator'=> $clientUid,
                'message'=>$data['message'],
            ]));   
        }
    }
    
});

$server->listen();

Log::write("WEBSOCKET SERVER FINISHED");
