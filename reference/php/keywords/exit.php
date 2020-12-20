<?php

function shutdown() // shutdown is called before exit
{
    echo 'Shutdown'.PHP_EOL;
}

register_shutdown_function('shutdown');


class Foo {
    public function __destruct() { // destructor is called before exit
        echo 'Destruct' . PHP_EOL;
    }
}

$foo = new Foo();

exit; // exit progrgram, call shutdown function and destructors; no value returned
exit();	
exit("message"); // print message before exit
exit(0); // normal exit
exit(1); // exit with error code 1, error codes: 1-254 
fopen("file.txt", 'r') or exit("unable to open file ");

die(); // alias for exit