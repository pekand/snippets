<?php

$context = stream_context_create([
	'http' => [
		'proxy' => 'tcp://255.255.255.255:3218',
		'request_fulluri' => true,
	]
]);

print file_get_contents("https://www.google.com/", false, $context);

