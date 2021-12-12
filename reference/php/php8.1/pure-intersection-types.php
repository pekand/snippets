<?php 

interface Interface1 {
}

class myIterator implements Iterator, Countable, Interface1 {
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );  

    public function __construct() {
        $this->position = 0;
    }

    public function rewind() { // Iterator interface https://www.php.net/manual/en/class.iterator.php
        var_dump(__METHOD__);
        $this->position = 0;
    }

    public function current() {
        var_dump(__METHOD__);
        return $this->array[$this->position];
    }

    public function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    public function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    public function valid() {
        var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }

    public function count()  // Countable interface https://www.php.net/manual/en/class.countable.php
    {
        return count($this->array);
    }
}



function count_and_iterate(Iterator&Countable&Interface1 $value) { // check more then one type
    foreach ($value as $val) {
        var_dump($val);
    }

    count($value);
}


count_and_iterate(new myIterator());
