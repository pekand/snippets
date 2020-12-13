<?php

echo "<pre><h1>throw expression</h1>";

$callable = fn() => throw new Exception(); // throw is expression now and can be used in other expression

try {
    $callable();
} catch (Exception $e) {
    echo "Exception1\n";
}

//////////////////////////

try {
    false || throw new Exception();
} catch (Exception $e) {
    echo "Exception2\n";
}
