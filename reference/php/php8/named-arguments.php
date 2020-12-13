<?php

echo '<pre>';

echo '<h1>Named Arguments</h1>';

echo '<h2>Named Arguments in standard functions</h2>';
$a = array_fill(start_index: 0, count: 5, value: 50);
print_r($a);


echo '<h2>Named Arguments in own functions</h2>';
function test1($a = '' , $b = '', $c = ''){
    echo $a. $b. $c."\n";
}

test1(c:'c');
test1('a', c:'c'); // unamed arguments cant be after named
test1('a', defaul, 'c');
test1(c:'c', b:'b', a:'a');
