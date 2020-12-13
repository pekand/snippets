<?php

echo "<pre><h1>Allow trailing comma in parameter list</h1>";
function test(
    $param1,
    $param2,
    $param3, // trailing comma 
){
    echo $param1.$param2.$param3;
}

test(1,2,3);
