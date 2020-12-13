<?php

class Number {

    private int|float $number = 0;

    public function __construct($number) {
        $this->number = $number;
    }

    public function __toString()
    {
       return $this->number;
    }

}

$n = new Number(1.3);

echo $n;
