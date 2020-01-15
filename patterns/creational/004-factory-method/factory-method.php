<?php

// provide class for storage object constructors
// storag class can be replaced with another storage class with overrided or extended functionality

class Object1 { // stored object in factory
    private $name = 'Title1';
    
    function getName() {
        return $this->name;
    }
}

class Object2 { // stored object in factory
    private $name = 'Title2';

    function getName() {
        return $this->name;
    }
}

class Object3 { // stored object in factory
    private $name = 'Title3';

    function getName() {
        return $this->name;
    }
}

/* factory method */

abstract class AbstractFactoryMethod {
    abstract function makeProduct1($param);
}

class BasicFactoryMethod extends AbstractFactoryMethod { // storage for object constructors
    private $context = "Brand1";  
    
    function makeProduct1($param) {
        $product1 = NULL;   
        
        switch ($param) { // "normal" logic 
            case "object1":
                $product1 = new Object1;
            break;
            case "object2":
                $product1 = new Object2;
            break;
            default: // if $param is unknown fallback to default object (or can be null, or some different logic)
                $product1 = new Object1;        
        }     
            
        return $product1;
    }
    
    function getContext() { 
        return $this->context;
    }
}

class ExtendedFactoryMethod extends AbstractFactoryMethod { // override storage for object constructors and add own objects
    private $context = "Brand2";
    
    function makeProduct1($param) {
        $product1 = NULL;
        switch ($param) { // redefined object for custom logic different from "normal" (this is purpose of pattern)
            case "object1":
                $product1 = new Object2; 
            break;      
            case "object2":
                $product1 = new Object1;
            break;
            case "object3":
                $product1 = new Object3;
            break;
            default:
                $product1 = new Object2;   
        }
          
        return $product1;
    }
    
    function getContext() { 
        return $this->context;
    }
}

$factoryMethodInstance = new BasicFactoryMethod; // basic functionality
doSomethink($factoryMethodInstance);

$factoryMethodInstance = new ExtendedFactoryMethod; // modified functionality
doSomethink($factoryMethodInstance);

function doSomethink(AbstractFactoryMethod $factoryMethodInstance) {
    $product1 = $factoryMethodInstance->makeProduct1("object1");
    echo 'Context: '.$factoryMethodInstance->getContext().' Title: '.$product1->getName(). PHP_EOL;

    $product1 = $factoryMethodInstance->makeProduct1("object2");
    echo 'Context: '.$factoryMethodInstance->getContext().' Title: '.$product1->getName().PHP_EOL;

    $product1 = $factoryMethodInstance->makeProduct1("object3");
    echo 'Context: '.$factoryMethodInstance->getContext().' Title: '.$product1->getName().PHP_EOL;
}
