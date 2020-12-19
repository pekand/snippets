<?php

echo "<pre>";

echo trim("  aaaaa bbbbb ").PHP_EOL; // -> 'aaaaa bbbbb'
echo trim("  aaaaa bbbbb ", " \n\r\t\v\0").PHP_EOL; // -> 'aaaaa bbbbb'
echo trim("  aaaaa bbbbb ", " b").PHP_EOL; // -> 'aaaaa'


echo ltrim("  aaaaa bbbbb ").PHP_EOL; // -> 'aaaaa bbbbb '
echo rtrim("  aaaaa bbbbb ").PHP_EOL; // -> '  aaaaa bbbbb'
