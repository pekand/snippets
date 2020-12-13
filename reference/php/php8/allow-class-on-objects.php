<?php

echo "<pre><h1>Allow ::class on objects</h1>";

class ClassName
{
    
}
//////////////////

$obj = new ClassName();
echo $obj::class;

//////////////////

$obj2 = null;
echo $obj2::class; // Fatal error
