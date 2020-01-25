<?php

//Single responsibility principle
//separate all what can be separated to independent groups and use it as dependency


/*

// bad example: Class is responsible for logging messages and creating user

class UserManager
{
    public function createUser(Database $db, string $name, string $password)
    {
        try
        {
            $db->query("insert into");
        }
        catch (Exception $ex)
        {
            file_put_contents('logs.txt', $ex->getMessage().PHP_EOL , FILE_APPEND | LOCK_EX);
        }
    }
}

*/

class Database 
{
    public function query(string $query)
    {
        echo "execute:".$query.PHP_EOL;
        throw new Exception("exception");
    }
}

class UserRepository
{
	private $db;
	
	public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function createUser(string $name, string $password)
    {
        $this->db->query("insert into");
    }
}

class FileSystem
{
	public function appendToFile(string $filePath, string $message)
	{
		file_put_contents($filePath, $message.PHP_EOL , FILE_APPEND | LOCK_EX);
	}
}

class Logger
{
	private $fileSystem;
	
	public function __construct(FileSystem $fileSystem)
	{
		$this->fileSystem = $fileSystem;
	}
	
	public function error(string $message)
	{
		echo "save error message".PHP_EOL;
		$this->fileSystem->appendToFile("logs.txt",$message);
	}
}

class UserManager
{
	private $userRepository;
	private $log;
	
	public function __construct(UserRepository $userRepository, Logger $log)
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