<?php

mt_srand(random_int(PHP_INT_MIN, PHP_INT_MAX));

function uid($len) { 
    $ch = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $out = "";
    for ($i=0; $i < $len; $i++) { 
        $out .= $ch[mt_rand(1, strlen($ch))-1];
    }
    
    return $out;
}

echo uid(32);
