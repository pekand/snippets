<?php

session_start();

header('Content-Type: application/json');


$parsedInput = [];
if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH') {
parse_str(file_get_contents( 'php://input' ), $parsedInput);
}


echo json_encode([
    'headers' => getallheaders(),
    'server' => $_SERVER,
    'get' => $_GET,
    'post' => $_POST,
    'put' => $_SERVER['REQUEST_METHOD'] == 'PUT' ? $parsedInput : [],
    'patch' => $_SERVER['REQUEST_METHOD'] == 'PATCH' ? $parsedInput : [],
    'delete' => $_SERVER['REQUEST_METHOD'] == 'DELETE' ? $_GET : [],
    'request' => $_REQUEST,
    'cookie' => @$_COOKIE,
    'session' => session_status() == PHP_SESSION_ACTIVE ? @$_SESSION : [],
    'files' => $_FILES,
    'input' => file_get_contents( 'php://input' ),
    'json' => @json_decode(file_get_contents( 'php://input' ), true),
]);


