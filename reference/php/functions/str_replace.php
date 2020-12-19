<?php

echo "<pre>";

echo str_replace("search_for", "replace_with", "text search_for").PHP_EOL; // -> 'text replace_with'
echo str_replace([1,2,3,4,5], "1", "1 2 3 4 5 6 7 8 9").PHP_EOL; // -> 1 1 1 1 1 6 7 8 9
echo str_replace([1,2,3,4,5], [0,1,2,3,4], "1 2 3 4 5 6 7 8 9").PHP_EOL; // -> 0 1 2 3 4 6 7 8 9
echo json_encode(str_replace(1, 0, ["1 2 3" , "1 2 3"])).PHP_EOL; // -> ["0 2 3","0 2 3"]

$o = str_replace([1,2,3,4,5], [0,1,2,3,4], "1 2 3 4 5 6 7 8 9", $count);
echo $count.PHP_EOL; // -> 5 (number of replaced strings)
