<?php
include "vendor/autoload.php";

use PHPUnit\Framework\TestCase;

final class MyTest extends TestCase {
    protected $logFile;

    protected function setUp(): void {
        $this->logFile = fopen('/tmp/logfile', 'w');
    }

    #[\Override] // method must by declared or defined in parent
    protected function taerDown(): void {
        fclose($this->logFile);
        unlink('/tmp/logfile');
    }
}

//By adding the #[\Override] attribute to a method, PHP will ensure that a method with the same name exists in a parent class or in an implemented interface. Adding the attribute makes it clear that overriding a parent method is intentional and simplifies refactoring, because the removal of an overridden parent method will be detected. 

//PHP Fatal error:  MyTest::taerDown() has #[\Override] attribute, but no matching parent method exists in C:\Documents\Projects\github\snippets\reference\php\php8.3\New_Override_attribute.php on line 14

// Fatal error: MyTest::taerDown() has #[\Override] attribute,
// but no matching parent method exists