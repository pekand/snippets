<?php

echo "<pre>";

print_r(['a'=>1,'b'=>1]);

echo print_r(['a'=>1,'b'=>1], true).PHP_EOL;

var_dump(['a'=>1,'b'=>1], ['a'=>1,'b'=>1]);

var_export(['a'=>1,'b'=>1]); // export in php syntaxt

echo var_export(['a'=>1,'b'=>1], true); // export as string
