<?php

use Throwable; 
use Exception;

try {
    throw new Exception('message');
} catch(\Throwable $e) {
	echo $e->getMessage();
} catch (\Exception $e) {
    echo $e->getMessage();
} finally {
    
}

// multiple exception catch
class Exception1 extends Exception { }
class Exception2 extends Exception { }
try {
    throw new Exception1();
} catch (Exception1 | Exception2 $e) {
    echo get_class($e);
}