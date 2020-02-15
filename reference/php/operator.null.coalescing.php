<?php

$v1 = 1;
$v2 = 1;
$value = $v1 ?? $v2;

/* 
equals to:
if (isset($v1) && $v1 !== null) {
	$value = $v1;
} else {
	$value = $v2;
}
*/

$value2 ??= $value1; 

/* php7.4  
equals to: 
$value2 = $value2 ?? $value1;
*/