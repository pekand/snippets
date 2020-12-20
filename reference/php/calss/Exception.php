<?php

echo "<pre>";


function test() {
    $previous = new \Exception("Parent error");
    throw new \Exception(
        'message', 
        1, // code 
        $previous //previous 
    );
}

try {
    test();
} catch (\Exception $e) {
   
    echo 'getMessage = '.$e->getMessage().PHP_EOL;
    echo 'getPrevious = '.$e->getPrevious()->getMessage().PHP_EOL;
    echo 'getCode = '.$e->getCode().PHP_EOL;
    echo 'getFile = '.$e->getFile().PHP_EOL;
    echo 'getLine = '.$e->getLine().PHP_EOL;
    echo 'getTrace = '.json_encode($e->getTrace()).PHP_EOL;
    echo 'getTraceAsString = '.$e->getTraceAsString().PHP_EOL;
    echo '__toString = '.$e.PHP_EOL;

} 
