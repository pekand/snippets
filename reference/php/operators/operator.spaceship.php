<?php


//Spaceship operator
// compare values in object
2<==>1 == 1;
1<=>2 == -1;
1<==>1 == 0;

/*
equal to:
$val = 0;
if($a>$b){
	$val = 1;
} else if($a<$b) {
	$val = -1;
}
*/

$list = [3,2,1];
usort($list, function($a, $b) { 
	return $a <=> $b;
});
var_dump($list);

/*
array (size=3)
  0 => int 1
  1 => int 2
  2 => int 3
*/