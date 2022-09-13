<?php

include "vendor/autoload.php";

use GuzzleHttp\Client;    

$client = new Client([
	'base_uri' => 'http://stage-kafka1.nike.sk:8081',
	'timeout' => 10.0,
	'cookie' => true,        	
	'verify' => false, 
	'proxy' => ''
]);


$out = $client->get('/schemas/ids/260', [])->getBody()->getContents();

echo $out;
