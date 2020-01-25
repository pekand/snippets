<?php

$a = [1,2,3];
$b = [1,2,3];

$f1 = function($i) use ($a,$b) { 
	return $a[$i]+$b[$i]; 
};

echo $f1(1).PHP_EOL;

// call self 
$val =  (function(){
    return "value";
})();

echo $val.PHP_EOL;

// short, one line expresion (no block allowed only one expression) (php7.4)
$f2 = fn($i) => $i * $i;

echo $f2(3).PHP_EOL;

// return type hint
$f3 = fn($i):int => $i * $i;

echo $f3(3).PHP_EOL;

// use and return reference to object
$f4 = fn& (&$x) => $x;
$obj = &$f4($a);
$a[0] = 5;

var_dump($a);
var_dump($obj);


// no use is needed for fn but $v1 is copied by value not reference
$v1 = 1;
$f5 = fn() => ++$v1; // $v1 is copy of global $v1, global $v1 is not changed
$v2 = $f5();

var_dump($v1);
var_dump($v2);

/*
int(1)
int(2)
*/