<?php

use BcMath\Number;

$num1 = new Number('0.12345');
$num2 = new Number('2');
$result = $num1 + $num2;

echo $result; // '2.12345'
var_dump($num1 > $num2); // false