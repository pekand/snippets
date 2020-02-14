<?php

class storage {
    private $file = "";
    
    public $data = [];
    
    private $mirror = [];
    
    function __construct($file) {
        $this->file = $file;
    }
    
    public function open() {
        
        if(!file_exists($this->file)) {   
            return;
        }
        
        $file = fopen($this->file, "r");
        
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data = json_decode(bzdecompress(base64_decode($line)));
                $this->data = array_merge($this->data, $data);
            }
        }
    }

    
    public function add($name, $data) {
 
        $this->data[$name] = $data;
        
        return true;
    }
    
    public function get($name) {
        return isset($data[$name]) ? $data[$name] : null;  
    }

    public function save($name, $data) {
        
        $line =  base64_encode(bzcompress(json_encode($this->mirror), 9));
        file_put_contents($this->file, $line."\n", FILE_APPEND | LOCK_EX);
        
        return true;
    }
}

$db = new storage("users.dat");

$db->open();

$db->add("admin", ['password'=>md5('password')]);


