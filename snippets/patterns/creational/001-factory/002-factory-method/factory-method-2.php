<?php

// overide dependency metod in perent class

interface Product
{
    public function operation(): string;
}

class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct1}\n";
    }
}

class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct2}\n";
    }
}

abstract class Creator
{
    abstract public function factoryMethod(): Product; // dependecy implemented by child class

    public function someOperation(): string
    {
        $product = $this->factoryMethod();
        return "Creator: The same creator's code has just worked with " . $product->operation() . "\n";
    }
}

class ConcreteCreator1 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1;
    }
}

class ConcreteCreator2 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2;
    }
}

function clientCode(Creator $creator)
{
    echo "Client: I'm not aware of the creator's class, but it still works." . $creator->someOperation()."\n";
}

clientCode(new ConcreteCreator1);

clientCode(new ConcreteCreator2);
