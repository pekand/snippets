<?php

define('ROOT_PATH', dirname(__FILE__));

require_once(ROOT_PATH.'/vendor/autoload.php');

use LocalVendor\LocalPackage\LocalClass;
use MyVendor\MyPackage\MyClass;

LocalClass::init();
MyClass::init();
