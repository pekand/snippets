<?php

require __DIR__ . '/vendor/autoload.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Lib\CustomObject; //autoload own object

new CustomObject();

$log = new Logger('name');
$log->pushHandler(new StreamHandler('app.log', Logger::WARNING));

$log->warning('Foo');
$log->error('Bar');
