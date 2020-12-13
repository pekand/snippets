<?php

echo "<pre><h1>mixed</h1>";

function test(mixed $i): mixed {
    return 1;
}


var_dump(test(1));

function test2(mixed $i): mixed {
    return null; // null is allowed as mixed
}

var_dump(test2(1));
