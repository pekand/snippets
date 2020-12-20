<?php

echo "<pre>";

class Class1 {
}

$o = new Class1();

if($o instanceof Class1) {
}

$className = 'Class1';
if($o instanceof $className) {
}

class Class2 {
	public function __clone() {
        return clone $this;
    }
}    
$o2 = clone $o;

class Class3 {
	protected $p1 = "";
}
class Class4 extends Class3{  // class can extend only from one class
	private $p2 = "";
	public $p3 = "";
}

// abstract
abstract class Class5 {
    abstract protected function fun();

}
abstract class Class6 extends Class5 {
    public function fun() {
        return "ConcreteClass1";
    }
}

// final method
class Class7 {
    final protected function fun() { // prevent override in child
    }
}
class Class8 extends Class7 {    
}

final class Class9 { // prevent extension
    
}
