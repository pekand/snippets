<?php

echo "<pre>";

echo json_encode(array_keys(['a'=>1,'b'=>2,'c'=>3])).PHP_EOL; // -> ["a","b","c"]
echo json_encode(array_keys(['a'=>1,'b'=>2,'c'=>3], 1)).PHP_EOL; // -> ["a"] (search keys with value 1)
echo json_encode(array_keys(['a'=>1,'b'=>2,'c'=>3], '1', true)).PHP_EOL; // -> [] (strict type comparison)
