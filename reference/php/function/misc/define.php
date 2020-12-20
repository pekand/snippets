<?php

echo "<pre>";

define('TEST', 'value');

if (defined('TEST')) {
    echo TEST.PHP_EOL;
}

define('DEBUG', true);

if(defined('DEBUG') && DEBUG){
    echo 'debugging mode'.PHP_EOL;
}


