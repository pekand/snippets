<?php

interface Interface1 {
}

class Class1 {
}

class Class2 extends Class1 {
	
	public ?int $inull = null; // allow null as value and inplicite set to null
	
    public int $id; // not default value is set, after use get error, must by explicitly set to deault value
    public string $name;
    
    public bool $b = false;
	public int $i = 0;
	public float $f = 0;
	public array $a = [];
	
	public object $o;
	
	public Interface1 $interface1;
	public Class1 $class1;
	
	public self $self; // type of Class2
	public parent $parent; // type of Class1
	
	public iterable $iterable = []; // implements Traversable  interface  
 
    public function __construct() {
        
    }
    
    public function method1(int $id, string $name): int {
       $this->id = $id;
       $this->name = $name;
       
       return 1;
    }
    
    public function method2(): ?Class1 { // allow return null or object type of Class1
       return null;
    }
}

$c = new Class2();
