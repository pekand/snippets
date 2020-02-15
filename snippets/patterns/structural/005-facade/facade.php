<?php

// wrap complex logic in one or multyple system to one simple class for specific purpose
// forexample video decoder encoder to one class, facade use predefined video setting for compresion

interface ComplexSystem1Interface {
    public function operation1();
    public function operation2();
}

interface ComplexSystem2Interface {
    public function operation1();
    public function operation2();
}

class ComplexSystem1 implements ComplexSystem1Interface{
    public function operation1() {
    	
    }

    public function operation2() {
    	
    }
}

class ComplexSystem2 implements ComplexSystem2Interface{
    public function operation1() {
    	
    }

    public function operation2() {
    	
    }
}

class SystemFacade {
    private $system1; // encapsulate xomplex systems
    private $system2;

    public function __construct(ComplexSystem1Interface $system1, ComplexSystem2Interface $system2)
    {
        $this->system1 = $system1;
        $this->system2 = $system2;
    }

    public function operation1()
    {
        $this->system1->operation1(); // do cxomplex logic with systems
        $this->system2->operation2();
        $this->system1->operation1();
    }

    public function operation2()
    {
        $this->system1->operation2(); // do cxomplex logic with systems
        $this->system2->operation1();
        $this->system1->operation2();
    }
}



$facade = new SystemFacade(new ComplexSystem1, new ComplexSystem2);
$facade->operation1();
$facade->operation2();
