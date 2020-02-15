<?php

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('Lib\\', __DIR__.'/src');

use Lib\CustomObject;

new CustomObject();


