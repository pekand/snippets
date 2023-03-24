<?php

readonly class Object1
{
    public string $param1;

    public function __construct(string $param1)
    {
        $this->param1 = $param1;
    }
}

$o = new Object1('value1');

// Fatal error: Uncaught Error: Cannot modify readonly property Object1::$param1
$o->param1 = 'value2';