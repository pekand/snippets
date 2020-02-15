<?php

// make class witch reate bridge for real implementation (wrapper for technology)
// StorageAbstraction contain attribute $database witch contain real implementation of technology
// allow easy change technology for other technology

interface DatabaseImplementation {
    public function connect($host);        
    public function query($query);    
}

class DatabaseSQL extends DatabaseImplementation // first database implementation
{
	
	public function __construct(argument){
		
	}
	
	public function connect($host){
		// real implementation connection to db
	}
	
	public function query($query){
		// real query call
	}
}

class FileStorage extends DatabaseImplementation // second (optional) database implementation 
{
	
	public function __construct(argument){
		
	}
	
	public function connect($host){
		// real implementation connection to db
	}
	
	public function query($query){
		// real query call
	}
}

class StorageAbstraction 
{
	private $database
	function __construct(DatabaseImplementation $database)
	{
		$this->database = $database;
	}
	
	public function connect($host){
		$database->connect($host);
	}
	
	public function query($query){
		$database->connect($host);
	}
}

$storage1 = new StorageAbstraction(new FileStorage()); // use abstract storage with real inplementation

$storage1->connect("host");
$storage1->query("query");

$storage2 = new StorageAbstraction(new DatabaseSQL()); // use abstract storage with other real inplementation, this is optional cena exist only one implementation 
$storage2->connect("host");
$storage2->query("query");
