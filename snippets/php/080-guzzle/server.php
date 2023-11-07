<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$json = file_get_contents('php://input');
$data = json_decode($json, true);
if (json_last_error() !== JSON_ERROR_NONE) {
   $data = [];
} 

$uri = rtrim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET' && $uri == '/info/server') {
	var_dump($_SERVER);
}

if($method == 'GET' && $uri == '/info/get') {
	var_dump($_GET);
}

if($method == 'GET' && $uri == '/test/response400') {
	http_response_code(400);
	header('Content-Type: application/json');
	$responseArray = ['error' => 'Bad request. Please check your parameters.'];
	echo json_encode($responseArray);
	exit();
}


if($method == 'POST' && $uri == '/test/response400') {
	http_response_code(400);
	header('Content-Type: application/json');
	$responseArray = [
		'error' => 'Bad request. Please check your parameters.',
		'data' => $data,
	];
	echo json_encode($responseArray);
	exit();
}


if($method == 'POST' && $uri == '/test/response500') {
	http_response_code(500);
	header('Content-Type: application/json');
	$responseArray = [
		'error' => 'Bad request. Please check your parameters.',
		'data' => $data,
	];
	echo json_encode($responseArray);
	exit();
}
