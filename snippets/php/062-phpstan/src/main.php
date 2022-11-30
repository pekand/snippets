<?php

interface A {
	public function test();
}

class C implements A {
	public function test() {
		echo "eee";
	}
}

class E implements A {
	public function do() {
		echo "ddd";
	}

	public function test() {
		echo "eee";
	}
}

class D {
	public function test1(A $a) {
		if ($a instanceof E) {
			$a->do();
		} 
		$a->test();
	}
}

$d = new D();
$d->test1(new E());
