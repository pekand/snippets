<?php

# https://www.php.net/manual/en/language.types.array.php#language.types.array.unpacking

$arrayA = ['a' => 1];
$arrayB = ['b' => 2];

$result = ['a' => 0, ...$arrayA, ...$arrayB];

var_dump($result); // ['a' => 1, 'b' => 2]
