<?php

namespace vendor\product;

use vendor\product;

/////////////////////////////////////

echo "<pre>";

/////////////////////////////////////

include 'assets\file.php';
include_once 'assets\file.php';
require 'assets\file.php';
require_once 'assets\file.php';

/////////////////////////////////////

echo "message".PHP_EOL;
print "message".PHP_EOL;

/////////////////////////////////////

$v1 = '';
echo (isset($v1)?1:0).PHP_EOL;
echo (empty($v1)?1:0).PHP_EOL;
echo eval("return 1+1;").PHP_EOL;
unset($v1);

/////////////////////////////////////

$a = array(1,2);
list($a, $b) = $a;

/////////////////////////////////////

$g = 0;

function foo1($param) {
    global $g;

    return 1;
}

$fn1 = fn($x, $y) => $x + $y;

function foo2(callable $callback) {
}

/////////////////////////////////////

switch (0) {
    case 0:
        echo "";
        break;
    default:
        echo "";
        break;
}

switch (0):
    case 0:
        echo "";
        break;
    default:
        echo "";
        break;
endswitch;

/////////////////////////////////////

$b1 = true;
$b2 = true;

if (true) {

} else {

}

if (true):
    echo "";
elseif (true):
    echo "";
else:
    echo "";
endif;

if ($b1 and $b2) {
    echo "";
}

if ($b1 or $b2) {
    echo "";
}

if ($b1 xor $b2) {
    echo "";
}

/////////////////////////////////////

goto label;
echo 'skip';
label:
echo 'show';

/////////////////////////////////////

while (false) {
    break;
}

while (false):
    continue;
endwhile;

do {
} while(false);

/////////////////////////////////////

for ($i=0; $i < 10 ; $i++) { 
}

for ($i=0; $i < 10 ; $i++): 
endfor;

foreach([] as $key => $value) {
}

foreach([] as $key => $value):
endforeach;

/////////////////////////////////////

interface Interface1 {

}

interface Interface2 {

}

abstract class ClassParent {
    private $attrib1;
    protected $attrib2;
    abstract protected function fun();
}

trait Trait1 {
    public $proprty = 0;
    public function foo1() {
    }
}

trait Trait2 {
    public function foo1() {
    }
}

final class Class1 extends ClassParent implements Interface1, Interface2{
    use Trait1, Trait2 {
        Trait1::foo1 as private; // change visibility
        Trait1::foo1 insteadof Trait2; // use instesd
        Trait2::foo1 as foo3; // rename function
    }

    const CONSTANT = 1;

    public $attrib3;
    var $attrib4;

    public static $s = 1;

    final public function fun() {
        return "";
    }

    public static function fun2() {
        Class1::$s++;
    }

    function __clone() {
    }
}

/////////////////////////////////////

$o1 = new Class1();
$o2 = clone $o1;

if($o1 instanceof Class1) {
}

/////////////////////////////////////

try {
    throw new \Exception("");
} catch (\Exception $e) {
    echo $e->getMessage();
} finally {
    echo "";
}

/////////////////////////////////////

declare(ticks=1) { 
}

declare(ticks=1):
enddeclare;

/////////////////////////////////////

function generator($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield $i;
    }
}

$generator = generator(5);
foreach ($generator as $value) {
    echo "$value\n";
}

function generator2($c) {
    yield from generator1(3);
}

/////////////////////////////////////

__halt_compiler();

exit();
die();
