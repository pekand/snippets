<?php

//Dependency inversion principle
//encapsulate dependency to abstract object and use is with interface (middle man)


interface DatabaseInterface {
	public function query(string $query);
}

class Database implements DatabaseInterface
{
	public function query(string $query)
	{
		echo "execute:".$query.PHP_EOL;
		throw new Exception("exception");
	}
}

interface UserRepositoryManager {
	public function createUser(string $name, string $password);
}

class UserRepository implements UserRepositoryManager
{
	private $db;
	
	public function __construct(DatabaseInterface $db)
	{
		$this->db = $db;
	}
	
	public function createUser(string $name, string $password)
	{
		$this->db->query("insert into");
	}
}

interface StorageManager {
	public function appendToStorage(string $filePath, string $message);
}

class FileSystem implements StorageManager
{
	public function appendToStorage(string $filePath, string $message)
	{
		file_put_contents($filePath, $message.PHP_EOL , FILE_APPEND | LOCK_EX);
	}
}

interface LogManager {
	public function error(string $message);
}

class Logger implements LogManager
{
	private $storage;
	
	public function __construct(StorageManager $storage)
	{
		$this->storage = $storage;
	}
	
	public function error(string $message)
	{
		echo "save error message".PHP_EOL;
		$this->storage->appendToStorage("logs.txt",$message);
	}
}

class UserManager
{
	private $userRepository;
	private $log;
	
	public function __construct(UserRepositoryManager $userRepository, LogManager $log) // is not depend on concrete implementation of userRepository or log can be switch to other implementation whole logic is encapsulated (with middle men class)
	{
		$this->userRepository = $userRepository;
		$this->log = $log;
	}

	public function createUser(string $name, string $password)
	{
		try
		{
			$this->userRepository->createUser($name, $password);
		}
		catch (Exception $ex)
		{
			$this->log->error($ex->getMessage());
		}
	}
}

$database = new Database();
$userRepository = new UserRepository($database);
$fileSystem = new FileSystem();
$logger = new Logger($fileSystem);
$userManager = new UserManager($userRepository, $logger);
$userManager->createUser("admin", "password");