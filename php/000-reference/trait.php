<?php


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