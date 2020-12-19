<?php

echo "<pre>".PHP_EOL;

$s = "1 2 3 4 5 6 7 8 9";

echo json_encode(explode(" ", $s)).PHP_EOL; // -> ["1","2","3","4","5","6","7","8","9"]
echo json_encode(explode(" ", $s, 2)).PHP_EOL; // -> ["1","2 3 4 5 6 7 8 9"] (limit to 1)
echo json_encode(explode(" ", $s, 5)).PHP_EOL; // -> ["1","2","3","4","5 6 7 8 9"] (limit to 5)
echo json_encode(explode(" ", $s, -1)).PHP_EOL; // -> ["1","2","3","4","5","6","7","8"]
echo json_encode(explode(" ", $s, -3)).PHP_EOL; // -> ["1","2","3","4","5","6"]

$data = "1:2:3:4:5";
list($var1,$var2,$var3,$var4,$var5) = explode(":", $data);
echo $var1.' '.$var2.' '.$var3.' '.$var4.' '.$var5.PHP_EOL; // -> 1 2 3 4 5
