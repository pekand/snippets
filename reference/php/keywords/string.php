<?php

echo "<pre>";

function __(...$m) {echo implode('',$m).PHP_EOL;}


__(
    "strlen('string')=", 
    strlen('string')
); //6

__(
    "strlen('ABCDabcdábcčdď')=", 
    strlen('ABCDabcdábcčdď')
); // 17

__(
    "str_word_count=", 
    str_word_count('world world world')
); // 3

__(
    "strpos('world world1 world', 'world1')=", 
    strpos('world world1 world', 'world1')
); // 6

__(
    "str_replace('old', 'new', 'string old string')=", 
    str_replace('old', 'new', 'string old string')
); // string new string

__(
    "mb_strlen=", 
    mb_strlen("ABCDabcdábcčdď")
); // 14
