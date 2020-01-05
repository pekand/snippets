<?php

$p= array(1, 2, 3);
list($a, $b, $c) = $p;
var_dump([$a, $b, $c]);

// skip values
list( , , $c) = $p;
var_dump([$c]);

list($a, list($b, $c)) = [1, [2, 3]];
var_dump([$a, $b, $c]);

list(1 => $a, 3 => $b) = [1, 2, 3, 4];
var_dump([$a, $b]);

$p= ['a' => 1, 'b' => 2];

list('a' => $a, 'b' => $b) = $p;
var_dump([$a, $b]);

[$a, $b, $c] = [1, 2, 3];
var_dump([$a, $b, $c]);

$p = [[1, 2], [3, 4], [5, 6]];
foreach($p as list($a, $b)){
    var_dump([$a, $b]);
}