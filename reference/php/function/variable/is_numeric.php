<?php

echo "<pre>";

$tests = array(
    true,
    false,
    
    1,
    0x1,
    01,
    0b1,
    1e0,
    "1",
    "+1",
    "-1",
    "0x1",
    "01",
    "0b1",
    "1e0",
    "string",
    array(),
    1.1,
    null
);

foreach ($tests as $element) {
    echo var_export($element).' '.(is_numeric($element)?'is':'is not').' numeric'.PHP_EOL;
}
