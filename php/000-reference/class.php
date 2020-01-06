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

// interface
interface Interface1 {
    public function foo1();    
}

interface Interface2 {
    public function foo2();    
}

interface Interface3 extends Interface1, Interface2 {
    public function foo3();    
}

interface Interface4 {
    public function foo4();    
}

class Class10 {

}

class Class11 extends Class10 implements Interface3, Interface4{
    public function foo1(){
    }

    public function foo2(){
    }

    public function foo3(){
    }

    public function foo4(){
    }
}

// traits

trait Trait1 {
    public $proprty = 0;
    public function foo1() {
    }
}

trait Trait2 {
    public function foo2() {
    }
}

class Class12 {
    use Trait1, Trait2; // respect current namespace (not same as use in file header) same as CurrentNamespace\Trait1

    public function foo3() {

    }
}

// traits conflicts

trait Trait3 {
    public function foo1() {
        echo "Trait3::foo1".PHP_EOL;
    }
}

trait Trait4 {
    public function foo1() {
        echo "Trait4::foo1".PHP_EOL;;
    }
}

class Class13 {
    use Trait3, Trait4 {
        Trait4::foo1 as private; // change visibility
        Trait4::foo1 insteadof Trait3; // use instesd
        Trait3::foo1 as foo3; // rename function
    }
    
    public function foo2() {
        $this->foo1();
        $this->foo3();
    }
}

$c = new Class13();
$c->foo2();



// composed traits

trait Trait5 {
    public function foo1() {
    }
}

trait Trait6 {
    public function foo2() {
    }
}

trait Trait7 {
    use Trait5, Trait6;
}

class Class14 {
    use Trait7;

}

// abstract traits

trait Trait8 {
    abstract  public function foo1() ;
}

class Class15 {
    use Trait8;
    public function foo1() {
    }
}

// static traits

trait TraitCounter {
    public static $counter = 0;
    public static function count(){
        return ++self::$counter;
    }
}


class Class16 {
    use TraitCounter;
}

class Class17 {
    use TraitCounter;
}

echo Class16::count(); // return 1
echo Class17::count(); // return 1; each static property is duplicated per other class
/* 
trait
insteadof

*/
