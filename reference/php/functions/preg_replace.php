<?php

echo "<pre>";

echo preg_replace("/(a) (b) (c)/", '"${0}" =  ${1}-${2}-$3', "a b c").PHP_EOL; // -> "a b c" =  a-b-c


echo preg_replace("/abc/", "123", "abc abc abc", -1).PHP_EOL; // -> "123 123 123" (unlimited replace count)

echo preg_replace("/abc/", "123", "abc abc abc", 2).PHP_EOL; // -> "123 123 abc" (limit to 2 time replace)

preg_replace("/abc/", "123", "abc abc abc", 2, $count).PHP_EOL;

echo $count.PHP_EOL; // -> 2 (count of string replaces)

echo json_encode(preg_replace(["/abc/", "/cde/"], ["123", "456"], ["abc cde fgh", "fgh abc cde"])).PHP_EOL; // -> ["123 456 fgh","fgh 123 456"]

