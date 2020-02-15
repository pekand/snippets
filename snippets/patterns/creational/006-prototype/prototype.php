<?php

// avoid recreating havy resources with clonning object instead of creating new object

class Resources { // represent shared resource between cloned objects
    private $data = null;
    
    function __construct() {
        $this->data = 'resources';
    }
    
    function getData() { 
        return $this->data;
    }
}

class SubObject { // represent object witch is not shared resource
    private $param = null;
    
    function __construct($param) {
        $this->param = $param;
    }
    
    function setParam($param) {
        $this->param = $param;
    }
    
    function getParam() {
        return $this->param;
    }
}

abstract class ObjectPrototype { // base class for prototype with shared resouces
    protected $resources = null; // shared resource

    abstract function __clone(); // mark class for use as prototype
    
    function __construct() {    
        echo "heavy performance operation".PHP_EOL; // heavy operation is performed only once
        $this->resources = new Resources();
    }
    
    function operation1() { // operation using resources
        echo "use ".$this->resources->getData().PHP_EOL;
    }
}

class Object1Prototype extends ObjectPrototype { 
    private $name = null;
    protected $subObject = null; // example of not shared object between cloned objects
    
    function __construct() {    
        $this->subObject = new SubObject("param");
        parent::__construct();
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function getName() { 
        return $this->name;
    }
    
    function operation2($param) { // operation using not shared object
        $this->subObject->setParam($param);
    }
        
    public function __clone() {
        $this->name = null; // clean attributes for not sharing between cloned objects
        $this->subObject = clone $this->subObject; // deep copy of not shared object
    }
}

$object1 = new Object1Prototype(); // resources are created
$object1->setName('object1');

$object2 = clone $object1;
$object2->setName('object2');

$object1->operation1(); // use share resources  (each object share resource  subobject)
$object2->operation1(); // use share resources

$object1->operation2("param1"); // use not shared resources (each object has own copy of subobject)
$object2->operation2("param2"); // use not shared resources


print_r($object1);
print_r($object2);

