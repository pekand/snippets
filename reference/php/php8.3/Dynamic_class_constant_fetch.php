<?php

class Foo {
    const PHP = 'PHP 8.3';
}

$searchableConstant = 'PHP';


var_dump(constant(Foo::class . "::{$searchableConstant}")); // before 8.3

var_dump(Foo::{$searchableConstant}); // get constant value by name

