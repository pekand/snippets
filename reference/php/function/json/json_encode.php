<?php

echo "<pre>";


$a = [
    'a' => 1, 
    'b' => 2, 
    'c' => 3, 
    [
        'a' => 1, 
        'b' => 2, 
        'c' => 3, 
        [
            'a' => 1, 
            'b' => 2, 
            'c' => 3
        ]
    ]
];

echo json_encode($a).PHP_EOL;
if (($code = json_last_error()) !== JSON_ERROR_NONE){
    echo $code.':'.json_last_error_msg ().PHP_EOL;
}

try {
    echo json_encode($a,  JSON_THROW_ON_ERROR).PHP_EOL;
} catch (\Exception $e) {
    echo $e->getCode().':'.$e->getMessage().PHP_EOL;
}

echo json_encode($a, 0, 1).PHP_EOL; // max depth 


echo json_encode($a,
    JSON_FORCE_OBJECT |
    JSON_HEX_QUOT |
    JSON_HEX_TAG |
    JSON_HEX_AMP |
    JSON_HEX_APOS |
    JSON_INVALID_UTF8_IGNORE |
    JSON_INVALID_UTF8_SUBSTITUTE |
    JSON_NUMERIC_CHECK |
    JSON_PARTIAL_OUTPUT_ON_ERROR |
    JSON_PRESERVE_ZERO_FRACTION |
    JSON_PRETTY_PRINT |
    JSON_UNESCAPED_LINE_TERMINATORS |
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE |
    JSON_THROW_ON_ERROR
).PHP_EOL;
if (($code = json_last_error()) !== JSON_ERROR_NONE){
    echo $code.':'.json_last_error_msg ().PHP_EOL;
}
