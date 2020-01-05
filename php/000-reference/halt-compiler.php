<?php

$fp = fopen(__FILE__, 'r');
fseek($fp, __COMPILER_HALT_OFFSET__); // read file content after compileer halt mark
echo stream_get_contents($fp);
__halt_compiler(); 


custom not php data 