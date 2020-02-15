<?php

echo "<pre>";

$a = 1;
$b = 2;

function foo1() {
    global $a, $b;
    echo $a.$b.PHP_EOL;
    echo $GLOBALS['a'].$GLOBALS['b'].PHP_EOL;
} 

foo1();

function foo2() {
    static $a = 0;
    return ++$a;
}

echo foo2().PHP_EOL;
echo foo2().PHP_EOL;

class ClassName {
    public static $a = 1;
    public static function foo() {
        ClassName::$a++;
    }
}

ClassName::foo().PHP_EOL;
echo ClassName::$a.PHP_EOL;
