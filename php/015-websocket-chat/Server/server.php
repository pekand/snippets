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
        
        file_put_contents("server.log", date("Y-m-d h:i:s")." ".$severity." ".$message."\n", FILE_APPEND | LOCK_EX);
    }
}

class ServerState
{
    static $clients = [];
    static $operators = [];
 
    public static function isOperator($uid)
    {
        return isset(self::$operators[$uid]);
    }
    
    public static function addOperator($uid)
    {
        self::$operators[$uid] = [];
        unset(self::$clients[$uid]);
        self::removeClient($uid);
    }
    
    public static function removeOperator($uid)
    {
        unset(self::$operators[$uid]);
        self::addClient($uid);
    }
    
    public static function addClient($uid)
    {
        self::$clients[$uid] = [];
    }
    
    public static function removeClient($uid)
    {
        unset(self::$clients[$uid]);
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

$server->afterClientError(function($server, $client, $code, $message) {
    Log::write("({$client['uid']}) [$code]: $message", "ERROR");
});

$server->clientConnected(function($server, $client) {
    global $clients;
    Log::write("({$client['uid']}) CLIENT CONNECTED");
    ServerState::addClient($client['uid']);
    return true;
});

$server->clientDisconnected(function($server, $client, $reason) {
    Log::write("({$client['uid']}) CLIENT DISCONNECTED: {$reason}");
    
    ServerState::removeOperator($client['uid']);
    ServerState::removeClient($client['uid']);
});

$server->buildPing(function($server, $client) {     
     $server->sendMessage($client, json_encode(['operation'=>'ping']));
});

$server->afterSendMesage(function($server, $client, $message) {
    $data = json_decode($message, true);
    
    $severity = 'INFO';
    if (isset($data['operation']) && ($data['operation'] == 'ping' || $data['operation'] == 'pong')) {
        $severity = 'DEBUG';
    }
        
    Log::write("({$client['uid']}) MESSAGE TO CLIENT: {$message}", $severity);
});

$server->listen(function($server, $client, $request) {   
    
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
    
    Log::write("({$client['uid']}) REQUEST FROM CLIENT (".strlen($request)."): ".$requestFromClient, $severity);
    
    if($data['operation'] == 'ping') { 
        $server->sendMessage($client, json_encode(['operation'=>'pong']));      
    }
    
     if($data['operation'] == 'getUid') { 
        $server->sendMessage($client, json_encode(['operation'=>'uid', 'uid'=>$client['uid']]));      
    }
    
    if($data['operation'] == 'close') { 
        $server->close($client);
    }
    
    if($data['operation'] == 'sendMessage' && isset($data['to']) && isset($data['message'])) { 
        $uid = $data['to'];        
        $client = $server->getClient($uid);          
        if ($client !== null) {
            Log::write("({$client['uid']}) Message to {$uid} : {$data['message']}");
            $server->sendMessage($client, json_encode(['operation'=>'mesage', 'client'=>$client['uid'], 'mesage'=>$data['message'] ]));   
        }
    }
    
    if($data['operation'] == 'sendMessageToOperator' && isset($data['message'])) { 
        foreach (ServerState::getOperators() as $uid => $value) {
            $c = $server->getClient($uid);  
            var_dump($uid);             
            var_dump($c);
            Log::write("({$client['uid']}) Client Send Message To Operator {$uid}: {$data['message']}");
            $server->sendMessage($c , json_encode(['operation'=>'messageFromClient', 'client'=> $client['uid'], 'mesage'=>$data['message']])); 
        }   
    }
    
    if($data['operation'] == 'login') { 
        if($data['token'] == 'password') { 
            Log::write("({$client['uid']}) Operator accepted");
            ServerState::addOperator($client['uid']);            
        } else {
            Log::write("({$client['uid']}) Operator rejected");
        }
    }
    
    if($data['operation'] == 'logout') { 
        if(ServerState::isOperator($client['uid'])) { 
            Log::write("({$client['uid']}) Operator logout");
            ServerState::removeOperator($client['uid']);
        } else {
            $server->sendMessage($client, json_encode(['operation'=>'accessDenied', 'forbidden'=>'logout']));   
        }   
    }
    
    if($data['operation'] == 'broadcast') { 
        if(ServerState::isOperator($client['uid']) && isset($data['message'])) { 
            Log::write("({$client['uid']}) Operator broadcast");
            foreach (ServerState::getClients() as $uid => $value) {
                $c =  $server->getClient($uid);                
                Log::write("({$client['uid']}) Addmin broadcast to {$uid}: {$data['message']}");
                $server->sendMessage($c , json_encode(['operation'=>'operatorBroadcastMessage', 'mesage'=>$data['message']])); 
            }
        } else {
            $server->sendMessage($client, json_encode(['operation'=>'accessDenied', 'forbidden'=>'broadcast']));   
        }     
    }
    
    if($data['operation'] == 'getClients') { 
        if(ServerState::isOperator($client['uid'])) {
            $clients = [];
            foreach (ServerState::getClients() as $uid => $value) { 
                $clients[] = $uid;
            }
            $server->sendMessage($client, json_encode(['operation'=>'clients', 'clients'=>$clients]));   
        }  else {
            $server->sendMessage($client, json_encode(['operation'=>'accessDenied', 'forbidden'=>'getClients']));   
        }
    }
});

Log::write("WEBSOCKET SERVER FINISHED");
