<?php

echo "<pre>";

// include relative to current script location
include __DIR__ . '/helpers/include.php';

// include parameter to included file
$param1 = "parameter from parent file";
include "helpers/include-params.php";

// return value from included file
$result = include "helpers/include-return.php";
echo $result."\n";


include "helpers/include.php"; // include and evaluate or warning if file not exists
require	"helpers/include.php"; // include and evaluate or error if file not exists

include_once "helpers/include.php"; // like include but only include file once
require_once "helpers/include.php";// like require but only include file once

// include variable from file
include "helpers/include-variable.php";
echo $variable."\n"; // use variable from included file


// include in function
function foo()
{
    include 'helpers/include-variable2.php';
    echo $variable2."\n"; // from file
}
foo();

// include url http://...
if(ini_get('allow_url_include') == 1) {
   include $_SERVER['DOCUMENT_ROOT']."/php/000-reference/helpers/include-params.php"; // php.ini: allow_url_include=1
} 

// read content to variable
ob_start();
include 'helpers/include-content.php';
$content = ob_get_clean();
echo "$content\n";
