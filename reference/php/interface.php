<?php

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