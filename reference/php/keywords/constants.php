<?php

namespace App;

echo "<pre>";

echo PHP_EOL."define".PHP_EOL;

// define constant
define('CONSTANT', 'value1');
echo CONSTANT.PHP_EOL;

// get value of constant
echo constant("CONSTANT").PHP_EOL; // get value

// check if constant exists
if(defined('CONSTANT')) {
	echo "constant is defined".PHP_EOL;
}

define('CONSTANTCASE', 'value2', true); // return NULL if constant dont exists
echo constantcase.PHP_EOL;

// array of constants
define('CONSTARRAY', [
    'v1',
    'v2',
]);
echo CONSTARRAY[1].PHP_EOL;

echo PHP_EOL."Class const".PHP_EOL;

// constants in class
class Foo {
    const CONSTANT = 1;
    const CONSTANT1 = self::CONSTANT * 2;

    function showConstant() {
        echo self::CONSTANT;
    }
}
echo Foo::CONSTANT1.PHP_EOL;

echo PHP_EOL."Magic constants".PHP_EOL;

echo __NAMESPACE__.PHP_EOL;

trait TraitName {
    public function fun() { 
    	echo __TRAIT__.PHP_EOL;
    }
}

class ClassName {
	use TraitName;
	
	function __construct() {
		echo __CLASS__.PHP_EOL;
		echo __FUNCTION__.PHP_EOL;
		echo __METHOD__.PHP_EOL;
		$this->fun();
	}
}

new ClassName();

echo __DIR__.PHP_EOL;
echo __FILE__.":".__LINE__.PHP_EOL;	
