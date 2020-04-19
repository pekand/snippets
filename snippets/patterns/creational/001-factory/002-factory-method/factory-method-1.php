<?php

// overide apstract dependency metod in parent class

interface Writer
{
    public function write(string $message);
}

class StdoutWriter implements Writer
{
    public function write(string $message)
    {
        echo $message;
    }
}

class FileWriter implements Writer
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function write(string $message)
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
    }
}

interface Logger
{
    public function log(string $message);
}

abstract class AbstractLogger implements Logger
{
    abstract public function getWriter(): Writer; // avait implementation of dependenci

    public function log(string $message) {
        $writer = $this->getWriter();
        $writer->write(date("Y-m-d h:i:s")." ".$message);
    }
}

class StdoutLogger extends AbstractLogger
{
    public function getWriter(): Writer
    {
        return new StdoutWriter();
    }
}

class FileLogger extends AbstractLogger
{
    public function getWriter(): Writer
    {
        return new FileWriter("file.log");
    }
}

function doAction(Logger $logger) {
    $logger->log("Message1");
}

doAction(new StdoutLogger());
doAction(new FileLogger());
