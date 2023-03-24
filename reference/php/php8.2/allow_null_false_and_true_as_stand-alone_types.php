<?php

class Object1
{
    public function alwaysFalse(): false { 
    	return false;
    }

    public function alwaysTrue(): true { 

		return true;
    }

    public function alwaysNull(): null { 

    	return null;
    }

    public function error(): null { 

    	return true;
    }
}

$o = new Object1();
var_dump($o->alwaysFalse());
var_dump($o->alwaysTrue());
var_dump($o->alwaysNull());


//Fatal error: Uncaught TypeError: Object1::error(): Return value must be of type null, bool returned
var_dump($o->error());
