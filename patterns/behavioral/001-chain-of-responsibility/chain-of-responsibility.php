<?php

// handlle request with object. If object can't find satisfy requestor, transfer request to other object in chain. Repeat until request is satisfied or return null

interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $request): ?string;
}

abstract class AbstractHandler implements Handler
{
    private $nextHandler; // storage for next handler 

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }
        
        return null;
    }
}

class Object1Handler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "request1") {
            return "response1";
        } else {
            return parent::handle($request);
        }
    }
}

class Object2Handler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "request2") {
            return "response2";
        } else {
            return parent::handle($request);
        }
    }
}

class Object3Handler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "request3") {
            return "response3";
        } else {
            return parent::handle($request);
        }
    }
}

$object1 = new Object1Handler;
$object2 = new Object2Handler;
$object3 = new Object3Handler;

$object1
	->setNext($object2)
	->setNext($object3);

foreach (['request1', 'request2', 'request4'] as $value) {
	$result = $object1->handle($value);
	
	if ($result) {
        echo $value .' ->'.$result.PHP_EOL;
    } else {
        echo $value . ' -> no response found'.PHP_EOL;
    }
}

