<?php

$v1 = [1,2,3,4];
$v2 = 2;

var_dump($v1, $v2);

print_r($v1);

$out = print_r($v1, true);
echo $out;

var_export($v1);

$out = var_export($v1, true);
echo $out;