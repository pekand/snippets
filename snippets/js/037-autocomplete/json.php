<?php

function generateRandomString($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    ;
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$data = [];

$limit = $_GET['limit'] ? $_GET['limit']+0 : rand(10, 20);
for ($i=0;$i<$limit;$i++){
    $data[] = [
        'id' => rand(1,100),
        'name' => generateRandomString(20, 'abc'),
    ];
}

echo json_encode($data);