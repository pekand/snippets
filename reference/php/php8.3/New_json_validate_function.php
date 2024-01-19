<?php

// OLD

function json_validate_OLD(string $string): bool {
    json_decode($string);

    return json_last_error() === JSON_ERROR_NONE;
}

var_dump(json_validate_OLD('{ "test": { "foo": "bar" } }')); // old version


// NEW 8.3

var_dump(json_validate('{ "test": { "foo": "bar" } }')); //  new version 
