<?php

// separate dependencies to diferent class and add it to object by constructor
// make object more testable by change dependencies forexample for mocks

class DatabaseConfiguration
{
    private $host;
    private $port;
    private $username;
    private $password;

    public function __construct(string $host, int $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

class DatabaseConnection
{
    private $configuration;

    public function __construct(DatabaseConfiguration $config) // get configuration as dependency
    {
        $this->configuration = $config;
    }

    public function getDns(): string
    {
        return sprintf(
            '%s:%s@%s:%d',
            $this->configuration->getUsername(),
            $this->configuration->getPassword(),
            $this->configuration->getHost(),
            $this->configuration->getPort()
        );
    }
}

$config = new DatabaseConfiguration('localhost', 3306, 'user', 'passwd');
$connection = new DatabaseConnection($config);
echo $connection->getDns();