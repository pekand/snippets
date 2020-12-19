<?php

echo "<pre>";


echo strpos("123456789", "1").PHP_EOL; // -> 0
echo strpos("123456789", "2").PHP_EOL; // -> 1
echo strpos("123456789", "9").PHP_EOL; // -> 8
echo strpos("123456789", "10")?'1':'0'.PHP_EOL; // -> 0
echo (strpos("1234567891", "1", 9)?'1':'0').PHP_EOL; // -> 1 (star on offset 9)
echo (strpos("1234567891", "1", 10)?'1':'0').PHP_EOL; // -> 0 (star on offset 10)
