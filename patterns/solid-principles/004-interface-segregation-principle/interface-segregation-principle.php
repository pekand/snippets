<?php

//Interface segregation principle
// use multiple minimal interfaces


/*

bad example: FileAppend is forcet to implement both methods but loggig system need only append to file

interface StorageManager {
	public function appendToFile(string $filePath, string $message);
	public function writeToFile(string $filePath, string $message);
}

//class is se for append to log file
class FileAppend implements StorageManager
{
	public function appendToFile(string $filePath, string $message)
	{
		file_put_contents($filePath, $message.PHP_EOL , FILE_APPEND | LOCK_EX);
	}
	
	public function writeToFile(string $filePath, string $message)
	{
		throw new Exception("Not implemented");
	}
}

*/

interface AppendStorageManager {
	public function appendToStorage(string $filePath, string $message);
}

interface WriteStorageManager {
	public function writeToStorage(string $filePath, string $message);
}

interface StorageManager extends  AppendStorageManager, WriteStorageManager {

}

//class is se for append to log file
class FileStorage implements AppendStorageManager
{
	public function appendToStorage(string $filePath, string $message)
	{
		file_put_contents($filePath, $message.PHP_EOL , FILE_APPEND | LOCK_EX);
	}
	
	public function writeToStorage(string $filePath, string $message)
	{
		throw new Exception("Not implemented");
	}
}

class Logger
{
	private $storage;
	
	public function __construct(AppendStorageManager $storage)
	{
		$this->storage = $storage;
	}
	
	public function error(string $message)
	{
		echo "save error message".PHP_EOL;
		$this->storage->appendToStorage("logs.txt", $message);
	}
}

$storage = new FileStorage();
$log = new Logger($storage);
$log->error("error message");