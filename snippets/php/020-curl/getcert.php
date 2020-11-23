<?php

$url = "https://snippets.loc";

$orignal_parse = parse_url($url, PHP_URL_HOST);

$get = stream_context_create(array("ssl" => array(
    "capture_peer_cert" => true,
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true,
)));

$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
$cert = stream_context_get_params($read);
$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

print_r($certinfo);

openssl_x509_export($cert["options"]["ssl"]["peer_certificate"],$cert);

print_r($cert);

file_put_contents("certificate.crt", $cert);
