<?php

echo "<pre>";

$dir = getcwd();
$file = __FILE__;

echo (file_exists($dir) ? '1' : '0') . PHP_EOL; // check if file or directory exists
echo (is_readable($file) ? '1' : '0') . PHP_EOL;
echo (is_writable($file) ? '1' : '0') . PHP_EOL;
echo (is_dir($dir) ? '1' : '0') . PHP_EOL;
echo (is_file($file) ? '1' : '0') . PHP_EOL;
echo (is_link($file) ? '1' : '0') . PHP_EOL;
