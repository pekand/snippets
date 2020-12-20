<?php

echo "<pre>";

$a = [1, 2, 3, 4, 5];

echo (in_array(1, $a) ? '1' : '0') . PHP_EOL; // -> 1
echo (in_array(6, $a) ? '1' : '0') . PHP_EOL; // -> 0
echo (in_array('1', $a) ? '1' : '0') . PHP_EOL; // -> 1
echo (in_array('1', $a , true) ? '1' : '0') . PHP_EOL; // -> 0 strict mode (check types)


$b = [[1, 2], [3, 4], [5, 6]];

echo (in_array([1, 2], $b) ? '1' : '0') . PHP_EOL; // -> 1 (search for array in array)
echo (in_array(1, $b) ? '1' : '0') . PHP_EOL; // -> 0 
