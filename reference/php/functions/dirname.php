<?php

echo "<pre>";

$dir = getcwd();

echo $dir.PHP_EOL;

echo dirname($dir).PHP_EOL;
echo dirname($dir, 2).PHP_EOL; // level (default 1)

echo basename($dir).PHP_EOL; // get name component from string (path is not check)
echo basename(__FILE__, '.php').PHP_EOL; // remove sufix from name component

echo realpath('.').PHP_EOL;

$path_parts = pathinfo(
    $dir,
    PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME // options (defalt is all)
);

echo var_export($path_parts, true);
