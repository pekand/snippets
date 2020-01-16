<?php

/* encapsulate constuctor of object to class. Constructor of object in code can be changed by changing object witch construct inside method*/

/* products */

abstract class AbstractProduct1 {
    abstract function getName();
}

abstract class AbstractProduct2 {
    abstract function getName();
}

class Brand1Product1 extends AbstractProduct1 {
    private $name = "Brand1 Product1";
    
    function getName() {
        return $this->name;
    }
}

class Brand2Product1 extends AbstractProduct1 {
    private $name = "Brand2 Product1";
    
    function getName() {
        return $this->name;
    }
}

class Brand1Product2 extends AbstractProduct2 {
    private $name = "Brand1 Product2";
    
    function getName() {
        return $this->name;
    }
}

class Brand2Product2 extends AbstractProduct2 {
    private $name = "Brand2 Product2";
    
    function getName() {
        return $this->name;
    }
}

/* factories for product objects creating (encapsulated constructors) */

abstract class AbstractProduct1Factory {
    abstract function makeProduct1(); // list of object constructed with this factory
    abstract function makeProduct2();
}

class Brand1Factory extends AbstractProduct1Factory {
    function makeProduct1() {
        return new Brand1Product1; // encapsulated constructor
    }
    
    function makeProduct2() {
        return new Brand1Product2; // encapsulated constructor
    }
}

class Brand2Factory extends AbstractProduct1Factory {
    function makeProduct1() {
        return new Brand2Product1; // encapsulated constructor
    }
    
    function makeProduct2() {
        return new Brand1Product2; // encapsulated constructor
    }
}

/* use factory */

function processProduct1(AbstractProduct1Factory $factory) // object constructor can be changed by parameter
{
    $product1 = $factory->makeProduct1(); // create object with factory
    echo 'product name: '.$product1->getName().PHP_EOL;      
    
    $product2 = $factory->makeProduct2(); // create object with factory
    echo 'product name: '.$product2->getName().PHP_EOL;      
}

processProduct1(new Brand1Factory); // constructors are in factory
processProduct1(new Brand2Factory); // can change brand of products by provide of other factory
