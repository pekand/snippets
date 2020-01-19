<?php

// share memory resources between objects

class SharedItem // object representing shared data betwen items
{
    private $data = "";

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getData(): string
    {
        return $this->data;
    }
    
    public function setData(string $data): void
    {
        $this->data = $data;
    }
}

class Item // base object use witch use shared data and not shared data
{
    private $data = ""; // shared data between items

	private $attrib = ""; // other parameters not shared 

    public function __construct(SharedItem $data) // data should by set only by contructor to prevent modification of shared data
    {
        $this->data = $data;
    }

    public function getAttrib(): string
    {
        return $this->attrib;
    }
    
    public function setAttrib(string $data): void
    {
        $this->attrib = $attrib;
    }
}

class Flyweight
{
    private $sharedItem;

    public function __construct(SharedItem $sharedItem) {
        $this->sharedItem = $sharedItem;
    }

    public function getSharedItem(): SharedItem {        
        return $this->sharedItem;
    }
}


class ItemsFlyweightFactory { // factory for creating items with sharable part

    private $flyweights = [];

    public function __construct(array $initialFlyweights)
    {
        foreach ($initialFlyweights as $state) {
            $this->flyweights[$this->getKey($state)] = new Flyweight(new SharedItem($state));
        }
    }

    private function getKey($state): string { // calculate unique key for data
        return md5($state);
    }

    public function getItem($data): Item { // search for existing shared data or create new object
        $key = $this->getKey($data);

        if (!isset($this->flyweights[$key])) {
            $this->flyweights[$key] = new Flyweight(new SharedItem($data)); // create flyweight if not exist
        }
        
        return new Item($this->flyweights[$key]->getSharedItem()); 
    }
}


// create flyweight and sedd it with same objects
$factory = new ItemsFlyweightFactory([
    "data1",
    "data2",
    "data3",
]);

$item1 = $factory->getItem("data3");
$item2 = $factory->getItem("data4");

print_r($factory); // store 4 objects instead of 5 objects in memory