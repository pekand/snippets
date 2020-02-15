<?php

// null representation for object (disable object dunctionality with set null object dependencie)

class Service
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function doSomething()
    {
        $this->logger->log('action'); // no check if logger is set
    }
}

interface Logger
{
    public function log(string $str);
}

class PrintLogger implements Logger
{
    public function log(string $str)
    {
        echo $str.PHP_EOL;
    }
}

class NullLogger implements Logger
{
    public function log(string $str)
    {
        // null loger doing nothink but method still exists
    }
}


$service = new Service(new NullLogger());
$service->doSomething();

$service = new Service(new PrintLogger());
$service->doSomething();
