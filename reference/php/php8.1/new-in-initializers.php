<?php

// https://www.php.net/manual/en/language.enumerations.php

interface Logger {

}

class NullLogger implements  Logger {

}

class Service
{
    private Logger $logger;
   
    public function __construct(Logger $logger = new NullLogger()) { // allow new in variable inicialization
        $this->logger = $logger;
    }

    public function test(Logger $logger = new NullLogger()) { // allow new in variable inicialization
        $this->logger = $logger;
    }
}

$service = new Service();
