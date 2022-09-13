<?php

$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://stage-kafka1.nike.sk:8081/schemas/ids/260");

//curl_setopt($ch, CURLOPT_PROXY, "http://192.168.168.1:8080");
//curl_setopt($ch, CURLOPT_PROXY, "");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);
	var_dump($output);
curl_close($ch);     

