<?php

// separate private data do subclass and alter access to parameters (for example only get value form parameter after constuctor is created

class ItemData {
    private $param1 = "";
    private $param2 = "";

    public function __construct($param1, $param2) { // set is possible only by the constructor
    	$this->param1 = $param1;
        $this->param2 = $param2;
    }

    public function getParam1(): string { // only get
        return $this->param1;
    }
       
    public function getParam2(): string {
        return $this->param2;
    }
}

class Item {
    private $data = null;

    public function __construct($param1, $param2) {
        $this->data = new ItemData($param1, $param2); // private data can by set only in constructor
    }

    public function operation(): string {
        return $this->data->getParam1();
    }
    
}

$item = new Item("param1", "param2");
