<?php

echo "<pre>";

$json = '{"a":1,"b":2,"c":3,"0":{"a":1,"b":2,"c":3,"0":{"a":1,"b":2,"c":3}}}';

echo print_r(json_decode($json)).PHP_EOL;


echo print_r(json_decode($json, true)).PHP_EOL; //associative

echo print_r(json_decode($json, true, 1)).PHP_EOL; // max depth
if (($code = json_last_error()) !== JSON_ERROR_NONE){
    echo $code.':'.json_last_error_msg ().PHP_EOL;
}

try {
    echo print_r(
        json_decode(
            $json, 
            true, 
            512, 
            JSON_BIGINT_AS_STRING |
            JSON_INVALID_UTF8_IGNORE |
            JSON_INVALID_UTF8_SUBSTITUTE |
            JSON_OBJECT_AS_ARRAY |
            JSON_THROW_ON_ERROR
        )
    ).PHP_EOL;
} catch (\Exception $e) {
    echo $e->getCode().':'.$e->getMessage().PHP_EOL;
}
