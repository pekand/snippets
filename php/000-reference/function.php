<?php

echo "<pre>";

function fun1($p) {
    return;
}

function fun2($p) {
    return $p;  
}

// conition for declare function
$con = true;
if ($con) {
  function fun3() {
    echo "message\n";
  }
}
fun3();


// inline function 
function fun4() {
  function fun5() {
    echo "message\n";
  }  
  fun5();
}
fun4();