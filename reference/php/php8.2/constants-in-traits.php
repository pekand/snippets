<?php

trait Trait1
{
    public const CONSTANT = 1;
}

class Object1
{
    use Trait1;
}

var_dump(Object1::CONSTANT); // 1

//Fatal error: Uncaught Error: Cannot access trait constant Trait1::CONSTANT directly
var_dump(Trait1::CONSTANT);