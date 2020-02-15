<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo "<pre>";

echo "<h1>\$GLOBALS</h1>";
print_r($GLOBALS);
echo "<h1>\$_SERVER</h1>";
print_r($_SERVER);
echo "<h1>\$_GET</h1>";
print_r($_GET);
echo "<h1>\$_POST</h1>";
print_r($_POST);
echo "<h1>\$_FILES</h1>";
print_r($_FILES);
echo "<h1>\$_REQUEST</h1>";
print_r($_REQUEST);

echo "<h1>\$_SESSION</h1>";
$_SESSION["test"]="test";
print_r($_SESSION);

echo "<h1>\$_ENV</h1>";
print_r($_ENV);

echo "<h1>\$_COOKIE</h1>";
print_r($_COOKIE);

echo "<h1>\$http_response_header</h1>";
file_get_contents("https://google.com");
print_r($http_response_header);

echo "<h1>\$argc</h1>";
print_r($argc);

echo "<h1>\$argv</h1>";
print_r($argv);