<?php

echo "<pre>";

file_put_contents(
    "test.txt" , 
    "content", 
    0, // FILE_USE_INCLUDE_PATH|FILE_APPEND|LOCK_EX
    null // context
);

unlink("test.txt");
