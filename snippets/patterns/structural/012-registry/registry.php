<?php

// storage for objects used globally in application
// is antipattern becouse break dependency injection

interface Service {

}

class Logger implements Service {
	function log ($message) {
		echo $message.PHP_EOL;
	}
}

abstract class Registry {
    const LOGGER = 'logger';

    private static $services = [];

    private static $allowedKeys = [ // allow use only for specific keys
        self::LOGGER,
    ];

    public static function set(string $key, Service $value) {
        if (!in_array($key, self::$allowedKeys)) {
            throw new InvalidArgumentException('Invalid key given');
        }

        self::$services[$key] = $value;
    }

    public static function get(string $key): Service {
        if (!in_array($key, self::$allowedKeys) || !isset(self::$services[$key])) {
            throw new InvalidArgumentException('Invalid key given');
        }

        return self::$services[$key];
    }
}

$loggerService = new Logger(); // create service
Registry::set(Registry::LOGGER, $loggerService); // store service or override existing service with own
$loggerService = Registry::get(Registry::LOGGER); // retrive service from global registry
$loggerService->log('message');
