<?php 
echo 
"<pre>"; 

touch('test.txt');

touch(
    'test.txt',
    time(), // touch time (default is time())
    time() // access time (defailt is as touch time)
);

if (touch('test.txt') === true) {
    echo "ok";
}

unlink('test.txt');
