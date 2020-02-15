<?php

$files_content = [];
if(count($_FILES) > 0) {
	foreach ($_FILES as $name => $file) {
		$files_content[$name] = $file;	
		$files_content[$name]['sizeKb'] = $files_content[$name]['size']/1024;	
		$files_content[$name]['sizeMb'] = $files_content[$name]['sizeKb']/1024;	
		$files_content[$name]['content'] = "";	
		if(file_exists($file['tmp_name'])) {
			$files_content[$name]['content'] = substr(base64_encode(file_get_contents($file['tmp_name'])), 0, 1024);
		}
	}
}

$body = ""; 
$bodyDecoded = json_decode(file_get_contents('php://input'), true);
if (json_last_error() === JSON_ERROR_NONE) {
    $body = $bodyDecoded;
}

$data = [
	'method' => $_SERVER['REQUEST_METHOD'],
	'get' => $_GET,
	'post' => $_POST,
	'body' => $body,
	'server' => $_SERVER,
	'files' => $files_content,
];

header('Content-type: application/json');
echo json_encode($data);
