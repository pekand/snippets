<?php

echo "<pre>";

define('TEST', 'value');

if (defined('TEST')) {
    echo TEST.PHP_EOL;
}

class Class1
{
    const CONST1 = 'value A';
}

if (defined('Class1::CONST1')) {
    echo 'Class1::CONST1 defined'.PHP_EOL;
}
