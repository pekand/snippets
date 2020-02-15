<?php


// add extra functionality to real object caching, loging, control access,...

interface Subject
{
    public function request(): void;
}

class RealSubject implements Subject // base object with functionality 
{
    public function request(): void
    {
        echo "Real request.\n";
    }
}

class ProxySubject implements Subject // add logging functionality arround object 
{

    private $realSubject;


    public function __construct(RealSubject $realSubject)
    {
        $this->realSubject = $realSubject;
    }


    public function request(): void
    {
    	echo "Proxy Request\n";
        $this->realSubject->request();
        $this->logAccess();
    }

    private function logAccess(): void
    {
        echo "Logging\n";
    }
}


$proxy = new ProxySubject(new RealSubject);
$proxy->request();