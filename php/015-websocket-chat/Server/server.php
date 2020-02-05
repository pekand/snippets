<?php

set_time_limit(0);

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

use WebSocketServer\WebSocketServer;

Log::setAllowdSeverity(['INFO', 'ERROR']);

Log::write("WEBSOCKET SERVER START");

class Log
{
    private static $allowedSeverity = ['INFO', 'ERROR', 'WARNING', 'DEBUG'];
    
    public static function setAllowdSeverity($allowedSeverity) {
        self::$allowedSeverity = $allowedSeverity;
    }
    
    public static function write($message, $severity = 'INFO') {
        if (!in_array($severity, self::$allowedSeverity)) {
             return;
        }
        
        file_put_contents("log/server-".date("Y-m-d").".log", date("Y-m-d h:i:s")." ".$severity." ".$message."\n", FILE_APPEND | LOCK_EX);
    }
}

// business logic
class ServerState
{
    static $clients = [];
    static $operators = [];
 
    public static function isOperator($clientUid)
    {
        return isset(self::$operators[$clientUid]);
    }
    
    public static function addOperator($clientUid)
    {
        self::$operators[$clientUid] = [];
        self::removeClient($clientUid);
    }
    
    public static function removeOperator($clientUid)
    {
        unset(self::$operators[$clientUid]);
        self::addClient($clientUid);
    }
    
    public static function addClient($clientUid)
    {
        self::$clients[$clientUid] = [];
    }
    
    public static function removeClient($clientUid)
    {
        unset(self::$clients[$clientUid]);
    }
    
    public static function getClients()
    {
       return self::$clients;
    }
    
    public static function getOperators()
    {
       return self::$operators;
    }
}

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

$server->clientConnected(function($server, $clientUid) {
    global $clients;
    Log::write("({$clientUid}) CLIENT CONNECTED");
    ServerState::addClient($clientUid);
    
    foreach (ServerState::getOperators() as $operatorUid => $value) { 
        Log::write("({$clientUid}) New client notification to operator {$operatorUid}");
        $server->sendMessage($operatorUid , json_encode(['operation'=>'newClient', 'client'=> $clientUid])); 
    } 
        
    return true;
});

$server->clientDisconnected(function($server, $clientUid, $reason) {
    Log::write("({$clientUid}) CLIENT DISCONNECTED: {$reason}");
    
    ServerState::removeOperator($clientUid);
    ServerState::removeClient($clientUid);
    
    foreach (ServerState::getOperators() as $operatorUid => $value) { 
        Log::write("({$clientUid}) Client disconected notification to operator {$operatorUid}");
        $server->sendMessage($operatorUid , json_encode(['operation'=>'clientDisconected', 'client'=> $clientUid])); 
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

$server->listen(function($server, $clientUid, $request) {   
    
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
    
    if($data['operation'] == 'ping') { 
        $server->sendMessage($clientUid, json_encode(['operation'=>'pong']));      
    }
    
     if($data['operation'] == 'getUid') { 
        $server->sendMessage($clientUid, json_encode(['operation'=>'uid', 'uid'=>$clientUid]));      
    }
    
    if($data['operation'] == 'close') { 
        $server->closeClient($clientUid);
    }
    
    if($data['operation'] == 'sendMessage' && isset($data['to']) && isset($data['message'])) { 
        $toUid = $data['to'];
        if($server->isClient($toUid)){        
            Log::write("({$clientUid}) Message to {$toUid} : {$data['message']}");
            $server->sendMessage($toUid, json_encode(['operation'=>'message', 'from'=>$clientUid, 'message'=>$data['message'] ]));   
        }
    }
    
    if($data['operation'] == 'sendMessageToOperator' && isset($data['message'])) { 
        foreach (ServerState::getOperators() as $operatorUid => $value) { 
            Log::write("({$clientUid}) Client Send Message To Operator {$operatorUid}: {$data['message']}");
            $server->sendMessage($operatorUid , json_encode(['operation'=>'messageFromClient', 'from'=> $clientUid, 'message'=>$data['message']])); 
        }   
    }
    
    if($data['operation'] == 'login') { 
        if($data['token'] == 'password') { 
            Log::write("({$clientUid}) Operator accepted");
            ServerState::addOperator($clientUid);  
            
            foreach (ServerState::getOperators() as $operatorUid => $value) { 
                Log::write("({$clientUid}) Operator login notification {$operatorUid}");
                $server->sendMessage($operatorUid , json_encode(['operation'=>'operatorLogin', 'operator'=> $clientUid])); 
            }        
        } else {
            Log::write("({$clientUid}) Operator rejected");
        }
    }
    
    if($data['operation'] == 'logout') { 
        if(ServerState::isOperator($clientUid)) { 
            Log::write("({$clientUid}) Operator logout");
            ServerState::removeOperator($clientUid);
            
            foreach (ServerState::getOperators() as $operatorUid => $value) { 
                Log::write("({$clientUid}) Operator logout {$operatorUid}");
                $server->sendMessage($operatorUid , json_encode(['operation'=>'operatorLogout', 'operator'=> $clientUid])); 
            } 
    
        } else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'logout']));   
        }   
    }
    
    if($data['operation'] == 'broadcast') { 
        if(ServerState::isOperator($clientUid) && isset($data['message'])) { 
            Log::write("({$clientUid}) Operator broadcast");
            foreach (ServerState::getClients() as $uid => $value) {                
                Log::write("({$clientUid}) Addmin broadcast to {$uid}: {$data['message']}");
                $server->sendMessage($uid, json_encode(['operation'=>'operatorBroadcastMessage', 'message'=>$data['message']])); 
            }
        } else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'broadcast']));   
        }     
    }
    
    if($data['operation'] == 'getClients') { 
        if(ServerState::isOperator($clientUid)) {
            $clients = [];
            foreach (ServerState::getClients() as $uid => $value) { 
                $clients[] = $uid;
            }
            $server->sendMessage($clientUid, json_encode(['operation'=>'clients', 'clients'=>$clients]));   
        }  else {
            $server->sendMessage($clientUid, json_encode(['operation'=>'accessDenied', 'forbidden'=>'getClients']));   
        }
    }
});

Log::write("WEBSOCKET SERVER FINISHED");
