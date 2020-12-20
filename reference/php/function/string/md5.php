<?php

echo "<pre>";

$str = "test";

echo 'md5 = '.md5($str).PHP_EOL; 
echo 'md5(bin+base64) = '.base64_encode(md5("test", true)).PHP_EOL; // binary
echo 'md5(bin2hex) = '.bin2hex(md5("test", true)).PHP_EOL;

echo 'crc32 = '.crc32($str).PHP_EOL; 

echo 'sha1 = '.sha1($str).PHP_EOL; 
echo 'sha1(bin+base64) = '.base64_encode(sha1("test", true)).PHP_EOL; // binary

echo '<hr>';
echo json_encode(hash_algos()).PHP_EOL;

echo '<hr>';
foreach (hash_algos() as $alg) {
    echo $alg.' = '.hash($alg, $str).PHP_EOL;
}
