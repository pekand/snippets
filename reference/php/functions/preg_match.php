<?php

echo "<pre>";

echo (preg_match("/123/", "123456789") ? '1': '0') . PHP_EOL; // -> 1

echo (preg_match("/123/", "123456789", $match, 0, 5) ? '1': '0') . PHP_EOL; // -> start from offset 5

if(preg_match("/abc/", "abc def ghi", $match)) {
    echo json_encode($match).PHP_EOL; // -> ["abc"]
}

if(preg_match("/^(abc)(.*)(ghi)$/", "abc def ghi", $match)) {
    echo json_encode($match).PHP_EOL; // -> ["abc def ghi","abc"," def ","ghi"]
}

if(preg_match("/^(abc)(.*)(ghi)$/", "abc def ghi", $match , PREG_OFFSET_CAPTURE)) {
    echo json_encode($match).PHP_EOL; // -> [["abc def ghi",0],["abc",0],[" def ",3],["ghi",8]]
}

if(preg_match("/(a)(b)*(c)/", "ac", $match , PREG_UNMATCHED_AS_NULL)) {
    echo json_encode($match).PHP_EOL; // -> ["ac","a",null,"c"] (b is unmatchet use null instead of '')
}

if(preg_match("/^(abc)(.*)(ghi)$/", "abc def ghi", $match , PREG_OFFSET_CAPTURE|PREG_UNMATCHED_AS_NULL)) {
    echo json_encode($match).PHP_EOL; // -> [["abc def ghi",0],["abc",0],[" def ",3],["ghi",8]]
}
