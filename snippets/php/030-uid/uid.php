<?php

function uid($len) { 
    $ch = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $out = "";
    for ($i=0; $i < $len; $i++) { 
        $out .= $ch[mt_rand(1, strlen($ch))-1];
    }
    return $out;
}

echo uid(32);
