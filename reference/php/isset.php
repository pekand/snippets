<?php

echo "<pre>";

// isset === is declared and is not null
if (!isset($var)) {
    echo "is not set\n";
}

if (!isset($var, $var1, $var2)) {
    echo "is not set\n";
}

$var = null;
if (!isset($var)) {
    echo "is not set\n";
}

$var = "val";
unset($var);
if (!isset($var)) {
    echo "is not set\n";
}

$var = [];
if (!isset($var['key'])) {
    echo "is not set\n";
}

// check if multiple inner keys are set 
$var = ['key'=>[]];
if (!isset($var['key']['key']['key'])) {
    echo "is not set\n";
}

// unset array key
$var = ['key'=>[]];
unset ($var['key']);
if (!isset($var['key'])) {
    echo "is not set\n";
}

// unset global variable from function
function foo() 
{
    global $foo;
    unset($foo); // can't unset global variable
    
    unset($GLOBALS['foo']); // unset global variable
}
foo();

// unset object property
Class obj {
	public $param = 1;	
}
$o = new obj();
unset($o->param);
if (!isset($o->param)) {
    echo "is not set\n";
}
