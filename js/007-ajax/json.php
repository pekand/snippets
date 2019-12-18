<?php

$files_content = [];
if(count($_FILES) > 0) {
	foreach ($_FILES as $name => $file) {
		$files_content[$name] = $file;		
		$files_content[$name]['content'] = file_get_contents($file['tmp_name']);
	}
}

$data = [
	'get' => $_GET,
	'post' => $_POST,
	'body' => json_decode(file_get_contents('php://input'), true),
	'server' => $_SERVER,
	'files' => $files_content,
];

header('Content-type: application/json');
echo json_encode($data);
