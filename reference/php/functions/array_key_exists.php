<?php

echo "<pre>";

echo (array_key_exists(1, [1,2,3])?1:0).PHP_EOL;
echo (array_key_exists('a', ['a'=>1,'b'=>2,'c'=>3])?1:0).PHP_EOL;
