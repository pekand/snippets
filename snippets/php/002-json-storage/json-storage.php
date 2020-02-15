<?php

class JsonStorage 
{
    public $fileName = null;
    public $data = null;
    
    function __construct($fileName)
    {        
        $this->fileName = $fileName;
        $this->load($fileName);
    }
    
    public function load($filename = null) {

        $filename = $filename ?? $this->fileName;
        
        if(!file_exists($this->fileName)) {
            return null;
        }
        
        $this->data = null;
        
        $data = json_decode(file_get_contents($this->fileName), false);
        
        return $this;
    }
    
    function save($filename = null) {
        
        $filename = $filename ?? $this->fileName;
        
        $data = [];
        file_put_contents($this->fileName, json_encode($data), LOCK_EX);
        
        return $this;
    }
    
    function item($index) {

        if(isset($data[$index])) {
            return $data[$index];
        }

        return null;
    }
    
    public function __set($name , $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }
}

$storage = new JsonStorage("data.json");
$data = $storage->load();
var_dump($storage->data);
$storage->data = ["a","b"];
$storage->save();

var_dump($storage->data);


$j->name = "aaa";
$j->surname = "bbb";

$j->users->item(1)->name = 
users=>[
    0
]