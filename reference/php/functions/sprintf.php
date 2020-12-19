<?php

echo "<pre>";

echo sprintf("%b", 65).PHP_EOL; // binary
echo sprintf("%c", 65).PHP_EOL; // character
echo sprintf("%d", 123).PHP_EOL; // signet decimal
echo sprintf("%s", 'abc').PHP_EOL; // string
echo sprintf("%e %E", 123.123, 123.123).PHP_EOL; // scientific notation
echo sprintf("%f", 123.123).PHP_EOL; // locale aware float
echo sprintf("%F", 123.123).PHP_EOL; // non-locale aware float
echo sprintf("%g %G", 123.123, 123.123).PHP_EOL; // general
echo sprintf("%h %H", 123.123, 123.123).PHP_EOL; // general
echo sprintf("%o", 65).PHP_EOL; // octal
echo sprintf("%u", 65).PHP_EOL; // unsigned int
echo sprintf("%x %X", 128, 128).PHP_EOL; // hex

echo sprintf("%%").PHP_EOL;
echo sprintf("%+d", 123).PHP_EOL; // '+123' add + to positive numbers
echo sprintf("%5d", 123).PHP_EOL; // '  123' - pad from left
echo sprintf("%'X5d", 123).PHP_EOL; // '  123' - pad from left with character X
echo sprintf("%05d", 123).PHP_EOL; // '00123' - pad from left wit 0
echo sprintf("%5.5f", 123.123456789).PHP_EOL; // '123.12346'

