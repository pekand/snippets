<?php

echo "<pre>";

echo json_encode(array_merge([1,2,3],[4,5,6])).PHP_EOL; // -> [1,2,3,4,5,6]
echo json_encode(array_merge([1,2,3],[4,5,6],[7,8,9])).PHP_EOL; // -> [1,2,3,4,5,6,7,8,9]
echo json_encode(array_merge()).PHP_EOL; // -> []
echo json_encode(array_merge([1=>1,2=>2], [2=>222,3=>3])).PHP_EOL; // -> [1,2,222,3]
echo print_r(array_merge([111=>1, 222=>2], [333=>3, 444=>4]), true).PHP_EOL; // Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 ) (numerical keys are renumbered)
echo json_encode(array_merge(['a'=>1,'b'=>2], ['b'=>222,'c'=>3])).PHP_EOL; // -> {"a":1,"b":222,"c":3}

echo json_encode([1,2,3] + [4,5,6]).PHP_EOL; // -> [1,2,3]
echo json_encode(['a'=>1,'b'=>2] + ['b'=>222,'c'=>3]).PHP_EOL; // -> {"a":1,"b":2,"c":3}
