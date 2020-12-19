<?php

echo "<pre>";

$a1 = [1,2,3];

echo count($a1).PHP_EOL;

// default mode
echo count($a1, COUNT_NORMAL).PHP_EOL; // -> 3

$a2 = [1,2,3, [4,5,6], [7,8,9]];

// recursive count
echo count($a2, COUNT_RECURSIVE).PHP_EOL; // -> 11 (count array as one item)

// implement Countable interface

class CountableClass implements \Countable
{
    private $a = [1,2,3];

    public function count() : int
    {
        return count($this->a);
    }
}

$o = new CountableClass();

if($o instanceof \Countable) {
    echo count($o).PHP_EOL;
}
