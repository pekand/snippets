<?php

echo "<pre>";

if (empty($var)) { // is not deffined 
   echo "is not set\n";
}

$var = false;
if (empty($var)) { // is equal to false
   echo "is false\n";
}

$var = null;
if (empty($var)) { // is equal to false
   echo "is null\n";
}

$var = [];
if (empty($var)) { // is equal to false
   echo "is empty array\n";
}

if (empty($var['test'])) { // is equal to false
   echo "is not set array key\n";
}

$var = 0;
if (empty($var)) { // is equal to false
   echo "is empty int\n";
}

$var = 0.0;
if (empty($var)) { // is equal to false
   echo "is empty float\n";
}

$var = "";
if (empty($var)) { // is equal to false
   echo "is empty string\n";
}