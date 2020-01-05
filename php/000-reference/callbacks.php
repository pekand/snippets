<?php

echo "<pre>";

function foo(callable $callback) {
    $callback("param");
}

$g = "global param";

// callbeck function
$f = function ($a) use ($g) {
	echo $a.PHP_EOL;
	echo $g.PHP_EOL;
};
foo($f);

// callable class
class Class1 {
  public function __invoke($a) {
    echo $a.PHP_EOL;
  }
}
$c = new Class1();
foo($c);

// callbeck with function name as string
function foo2($a) {
	echo $a.PHP_EOL;
};
foo('foo2');

// callable static method
class Class2 {
  public static function method($a) {
    echo $a.PHP_EOL;
  }
}
class Class3 extends Class2{  
}
foo("Class3::method");
foo(["Class3", "method"]);

// callable object method
class Class4 {
  public function method($a) {
    echo $a.PHP_EOL;
  }
}
class Class5 extends Class4{  
}
$o = new Class5();
foo([$o, "method"]);
