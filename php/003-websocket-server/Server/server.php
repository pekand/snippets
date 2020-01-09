<?php

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});


use WebSocketServer\WebSocketServer;

echo "WEBSOCKET SERVER\n";
echo "WAITING...\n";

$server = new WebSocketServer([
    'ip' => '0.0.0.0',
    'port' => 8080
]);

$server->afterServerError(function($code, $message) {
     echo "SERVER ERROR [$code]: $message\n";
});

$server->afterClientError(function($server, $client, $code, $message) {
     echo "({$client['uid']}) ERROR [$code]: $message\n";
});

$server->clientConnected(function($server, $client) {
     echo "({$client['uid']}) CLIENT CONNECTED\n";
     return true;
});

$server->clientDisconnected(function($server, $client) {
     echo "({$client['uid']}) CLIENT DISCONNECTED\n";
});

$server->listen(function($server, $client, $request) {   
    if(strlen($request)<1000) {
        echo "({$client['uid']}) REQUEST FROM CLIENT (".strlen($request)."): $request\n";
    } else {
        echo "({$client['uid']}) REQUEST FROM CLIENT (".strlen($request)."): ".substr($request, 0, 100)."...".substr($request, -100)."\n";
    }
        
    if ($request == "NOW") {
        $contentBody = 'T' . time();
        $server->sendMessage($client, $contentBody);
    } else if ($request == "PING") {
        $server->sendMessage($client, "PONG");    
    } else if ($request == "CLOSE") {
        $server->close($client);    
    } else if($request != "PONG") {
        $response = "ok recived: ".strlen($request)." chars";
        echo "({$client['uid']}) RESPONSE FROM SERVER: $response\n";

        $server->sendMessage($client, $response);    
    }
});

echo "FINISHED\n";
