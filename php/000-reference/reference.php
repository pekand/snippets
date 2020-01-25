<?php

// reference as variable
$a1 = [1,2,3];
$x = &$a1;
$x[0] = 5;
var_dump($x);
var_dump($a1);

/*
array(3) { 
  [0]=>    
  int(5)   
  [1]=>    
  int(2)   
  [2]=>    
  int(3)   
}          
array(3) { 
  [0]=>    
  int(5)   
  [1]=>    
  int(2)   
  [2]=>    
  int(3)   
}          
*/

// reference as parameter of function
$a2 = [1,2,3];
function f1(&$arr)
{
    $arr[0] = 1;
}

f1($a2);
var_dump($a2);

/*
array(3) { 
  [0]=>    
  int(1)   
  [1]=>    
  int(2)   
  [2]=>    
  int(3)   
}          
*/

// return reference from function
$a3 = [1,2,3];
function &f2(&$arr)
{
	$arr[0] = 5;
    return $arr;
}

$a4 = &f2($a3);
$a4[1] = 5;

var_dump($a3);
var_dump($a4);

/*
array(3) {
  [0]=>
  int(5)
  [1]=>
  int(5)
  [2]=>
  int(3)
}
array(3) {
  [0]=>
  int(5)
  [1]=>
  int(5)
  [2]=>
  int(3)
}
*/

// reference in use in arrow function
$a4 = [1,2,3];
$f3 = function() use (&$a4){
    $a4[0] = 7;
};
$f3();
var_dump($a4);

/*
array(3) { 
  [0]=>    
  int(7)   
  [1]=>    
  int(2)   
  [2]=>    
  int(3)   
}          
*/

// unset reference destroi reference not content
$a5 = [1,2,3];
$a6 = &$a5;
unset($a6); 

var_dump($a5);
var_dump(isset($a6));

/* 
array(3) { 
  [0]=>    
  int(1)   
  [1]=>    
  int(2)   
  [2]=>    
  int(3)   
}          
bool(false) 
*/

// reference in array
$x = 1;
$a = [&$x];
$a[0]=5;
var_dump($x); // 5