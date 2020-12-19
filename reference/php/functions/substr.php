<?php

echo "<pre>";

echo substr("123456789", 1) . PHP_EOL; // -> '23456789'
echo substr("123456789", 100) . PHP_EOL; // -> ''
echo substr("123456789", 0, 3) . PHP_EOL; // -> '123'
echo substr("123456789", 0, 20) . PHP_EOL; // -> '123456789'
echo substr("123456789", -1) . PHP_EOL; // -> '9'
echo substr("123456789", -5) . PHP_EOL; // -> '56789'
echo substr("123456789", -3, -1) . PHP_EOL; // -> '78'
echo substr("123456789", -3, -5) . PHP_EOL; // -> ''
echo substr("123456789", -2, 3) . PHP_EOL; // -> '89'
echo (substr(123, 5) ? '1' : '0') . PHP_EOL; // -> 0
