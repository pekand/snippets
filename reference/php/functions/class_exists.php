<?php

echo "<pre>";

spl_autoload_register( function($class) {
    echo 'autoload:'.$class.PHP_EOL;
    $fileName = strtolower($class) . '.php';
    if(file_exists($fileName)){
        require $fileName;
    }
});

echo class_exists('MyClass', false).PHP_EOL; // skip autoloader
echo class_exists('MyClass').PHP_EOL; // use autoload

class ClassName
{

}

echo class_exists('ClassName').PHP_EOL;

