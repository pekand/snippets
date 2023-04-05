<?php

class C1 {
	public function test1 () {
		return 123;
	}
}

function test2($o){
	$result = $o != null ? $o->test1() : null;
	return $result;
}

$o = new C1();

echo "\nResult1:".test2($o);
echo "\nResult2:".test2(null);

