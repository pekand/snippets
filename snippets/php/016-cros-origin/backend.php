<?php


$allowdedOrgins = [
    'https://snippets.loc',
];


if(!in_array($_SERVER['HTTP_ORIGIN'], $allowdedOrgins)) {
    header('HTTP/1.0 403 Forbidden');
    die(0);
}

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']); 
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");         
header("Access-Control-Allow-Headers: Origin, Accept, Accept-Language, Content-Language, Content-Type, If-Modified-Since, Cache-Control, X-Auth-Token, X-CSRF-TOKEN, Authorization, Accesstoken");
header("Access-Control-Max-Age: 86400");

if ($_SERVER['REQUEST_METHOD'] === 'OPTION') {   
    header('Content-type: text/plain; charset=utf-8');     
    header('Content-Length: 0');
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $headers =[];
    foreach (apache_request_headers() as $header => $value) {
        $headers[$header] = $value;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    header('Content-type: application/json');
    echo json_encode([
        'origin' => $_SERVER['HTTP_ORIGIN'],
        'headers' => $headers,
        'body' => $data,
        'server' => $_SERVER,
        'get' => $_GET,
        'post' => $_POST,
    ]);
}
