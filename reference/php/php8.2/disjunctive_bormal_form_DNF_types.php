<?php

class Type1 {

}

class Type2 extends Type1{
	
}


class Type3{
	
}

class Object1 {
    public function method1((Type1&Type2)|null $param1) {
        return $param1;
    }
}

/*

		same as:
		
		if ((($param1 instanceof Type1) && ($param1 instanceof Type2)) || ($param1 === null)) {
            return $param1;
        }

        throw new Exception('Invalid entity');

*/


$o = new Object1();

//ok
$o->method1(new Type2());

//Fatal error: Uncaught TypeError: Object1::method1(): Argument #1 ($param1) must be of type (Type1&Type2)|null, Type3 given
$o->method1(new Type3());
