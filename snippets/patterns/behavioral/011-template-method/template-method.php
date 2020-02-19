<?php

/*
    Create template class for some action. Allow override some functionality by inherited class.
    Common logic is in abstract class. Variable logic is provided by other class overriding methods in parent class.
    Template is executed by template method in parent class

    Real life example is document filter witch process data from files. Allow change file type in process. File is opened and by child class and data are provided to parent class.
*/

abstract class AbstractClass
{

    final public function templateMethod(): void // template which allow override some functionality with child class
    {
        $this->baseOperation1(); // common functionality
        $this->requiredOperations1(); // abstract methon -> derived class must provide this functionality
        $this->baseOperation2(); // common functionality
        $this->hook1(); // empty method -> allow add same functionality 
        $this->requiredOperation2(); // abstract methon -> derived class must provide this functionality
        $this->baseOperation3(); // common functionality
        $this->hook2(); // empty method -> allow add same functionality 
    }


    protected function baseOperation1(): void // common logic
    {
        echo "AbstractClass: baseOperation1\n";
    }

    protected function baseOperation2(): void // common logic
    {
        echo "AbstractClass: baseOperation2\n";
    }

    protected function baseOperation3(): void // common logic
    {
        echo "AbstractClass: baseOperation3\n";
    }


    abstract protected function requiredOperations1(): void; // required logic

    abstract protected function requiredOperation2(): void; // required logic

    protected function hook1(): void { } // optional logic

    protected function hook2(): void { } // optional logic
}


class ConcreteClass1 extends AbstractClass
{
    protected function requiredOperations1(): void  // all method are protected -> callable only for abastract class
    {
        echo "ConcreteClass1: Operation1\n";
    }

    protected function requiredOperation2(): void
    {
        echo "ConcreteClass1: Operation2\n";
    }
}


class ConcreteClass2 extends AbstractClass 
{
    protected function requiredOperations1(): void // all method are protected -> callable only for abastract class
    {
        echo "ConcreteClass2: Operation1\n";
    }

    protected function requiredOperation2(): void
    {
        echo "ConcreteClass2: Operation2\n";
    }

    protected function hook1(): void
    {
        echo "ConcreteClass2: Hook1\n";
    }
}


$obj1 = new ConcreteClass1();
$obj1->templateMethod();


$obj2 = new ConcreteClass2();
$obj2->templateMethod();
