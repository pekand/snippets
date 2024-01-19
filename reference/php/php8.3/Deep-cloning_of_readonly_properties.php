<?php



class PHP {
    public string $version = '8.2';
}

readonly class Foo {
    public function __construct(
        public PHP $php,        
        public PHP $php2
    ) {}

    public function __clone(): void {
        $this->php = clone $this->php;  // can modify read only property in clone method in clone method

        // $this->php = clone $this->php; // after fisrt modification is readonly property unmodificable and tis line cause fatal error


        $this->php2 = $this->test(); // (or methods called in clone method)
    }

    public function test() {
        return clone $this->php2;  
    }
}

$instance = new Foo(new PHP(), new PHP());
$cloned = clone $instance;

$cloned->php->version = '8.3';

// readonly properties may now be modified once within the magic __clone method to enable deep-cloning of readonly properties. 

