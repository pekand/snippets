<?php


$decoded = @json_decode(file_get_contents("data.json"), true);
$json_error = json_last_error();

if ($json_error !== JSON_ERROR_NONE) {
    var_dump("ERROR: ".$json_error." ".json_last_error_msg());
} 
