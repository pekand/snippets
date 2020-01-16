<?php

// add (wrap) new functionality arroun existing functionality in base class

interface BaseClassInterface
{
    public function operation1(): string;

    public function operation2(): string;
}

class BaseClass implements BaseClassInterface // basic functionality
{
    public function operation1(): string
    {
        return "text1";
    }

    public function operation2(): string
    {
        return "text2";
    }
}

abstract class BaseDecorator implements BaseClassInterface
{
    protected $base;

    public function __construct(BaseClass $base) // get base class
    {
        $this->base = $base;
    }
}

class DecorateOperations extends BaseDecorator // wrap operations from base class
{
    public function operation1(): string  // wrap sam functionality arround basic functionality
    {
        return '['.$this->base->operation1().']';
    }

    public function operation2(): string
    {
        return '('.$this->base->operation2().')'; // wrap sam functionality arround basic functionality
    }
}

$base = new BaseClass();
$decoratedBase = new DecorateOperations($base);
echo $decoratedBase->operation1();
echo $decoratedBase->operation2();