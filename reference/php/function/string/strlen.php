<?php

echo "<pre>";

echo strlen('12345').PHP_EOL; // -> 5
echo strlen('š').PHP_EOL; // -> 2 (number of bytes)
echo mb_strlen('š', 'utf8').PHP_EOL; // -> 1 (number of characters)
