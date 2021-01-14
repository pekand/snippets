<?php

echo "<pre>";

$_SERVER['REQUEST_URI'] = str_replace(
    "/commands/apache/001-rewrite-subdirectory", "", 
    $_SERVER['REQUEST_URI']
);

var_dump($_SERVER);
