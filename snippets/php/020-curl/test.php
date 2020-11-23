<?php

include "curl.php";

$con = new Connection([
    'timeout' => 10,
    'skipSSL' => false,
    'certificate' => 'certificate.crt',
    'bsaicAuth' => true,
    'username' => 'username',
    'password' => 'password',
]);

header('Content-Type: application/json');

echo json_encode([
    'data' => $con->get("https://snippets.loc/snippets/php/020-curl/data.json"),
    'get' => $con->get("https://snippets.loc/snippets/php/020-curl/request.php", ['a'=>'b']),
    'post' => $con->post("https://snippets.loc/snippets/php/020-curl/request.php", ['a'=>'b']),
    'post_json' => $con->post("https://snippets.loc/snippets/php/020-curl/request.php", [], ['a'=>'b']),
    'put' => $con->put("https://snippets.loc/snippets/php/020-curl/request.php", ['a'=>'b']),
    'patch' => $con->patch("https://snippets.loc/snippets/php/020-curl/request.php", ['a'=>'b']),
    'delete' => $con->delete("https://snippets.loc/snippets/php/020-curl/request.php", ['a'=>'b']),
    'auth' => $con->get("https://snippets.loc/snippets/php/020-curl/auth.php"),
]);
