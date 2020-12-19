<?php

echo "<pre>";

function cube($n)
{
    return ($n * $n * $n);
}

$a = [1, 2, 3];
echo json_encode(array_map('cube', $a)); // -> [1,8,27]

////////////

function sum($a, $b)
{
    return $a+$b;
}

$a = ['a'=>1, 'b'=>2, 'c'=>3];
$b = ['d'=>4, 'e'=>5, 'f'=>6];
echo json_encode(array_map('sum', $a, $b)); // -> [5,7,9]
