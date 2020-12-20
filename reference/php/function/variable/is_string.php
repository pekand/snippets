<?php

echo "<pre>";

echo (is_string('')?1:0).PHP_EOL;

echo (is_null(null)?1:0).PHP_EOL;

echo (is_bool(true)?1:0).PHP_EOL;

echo (is_array([])?1:0).PHP_EOL;
echo (is_countable([])?1:0).PHP_EOL;

echo (is_int(1)?1:0).PHP_EOL;
echo (is_integer(1)?1:0).PHP_EOL;
echo (is_long(1)?1:0).PHP_EOL;
echo (is_scalar(1)?1:0).PHP_EOL;
echo (is_double(1.0)?1:0).PHP_EOL;
echo (is_float(1.0)?1:0).PHP_EOL;
echo (is_numeric(1)?1:0).PHP_EOL;

echo (is_resource(fopen('http://www.google.com', 'r'))?1:0).PHP_EOL;

echo (is_object(new stdClass())?1:0).PHP_EOL;

echo (is_callable(function(){})?1:0).PHP_EOL;
echo (is_iterable([])?1:0).PHP_EOL;



