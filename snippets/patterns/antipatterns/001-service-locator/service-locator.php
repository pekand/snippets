<?php

// global storage for classies instances
// antipatern / break SOLID Dependency Inversion principle

interface Service
{

}

class CustomService implements Service
{
    public function __construct($param1, $param2){
        echo $param1.' '.$param2;
    }

}

class ServiceLocator
{
    /**
     * @var string[][]
     */
    private array $services = [];

    /**
     * @var Service[]
     */
    private array $instantiated = [];

    public function addInstance(string $class, Service $service)
    {
        $this->instantiated[$class] = $service;
    }

    public function addClass(string $class, array $params)
    {
        $this->services[$class] = $params;
    }

    public function has(string $interface): bool
    {
        return isset($this->services[$interface]) || isset($this->instantiated[$interface]);
    }

    public function get(string $class): Service
    {
        if (isset($this->instantiated[$class])) {
            return $this->instantiated[$class];
        }

        $args = $this->services[$class];

        $object = new $class(...$args);

        if (!$object instanceof Service) {
            throw new InvalidArgumentException('Could not register service: is no instance of Service');
        }

        $this->instantiated[$class] = $object;

        return $object;
    }
}


$serviceLocator = new ServiceLocator();

$serviceLocator->addClass('CustomService', [1, 2]);

$customService = $serviceLocator->get('CustomService');


