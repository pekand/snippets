<?php

echo "<pre>";

function generator($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield $i;
    }
}

$generator = generator(5);
foreach ($generator as $value) {
    echo "$value\n";
}

// gnerator with keys
function generator2($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield $i => $i;
    }
}

$generator = generator2(5);
foreach ($generator as $key => $value) {
    echo "$key => $value\n";
}

// null generator
function generator3($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield;
    }
}

$generator = generator3(3);
foreach ($generator as $key => $value) {
	echo "$key => $value\n";
}

// reference generator
function &generator4($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield $i;
    }
}

$generator = generator4(3);
foreach ($generator as &$value) {
	echo "$value\n";
	$value = 4; // change value of i in generator
}

// yield from - inner iterator
function generator5($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield $i;
    }
}

function generator6($c) {
	yield 10;
	yield from generator5(3);
	yield 10;
}

$generator = generator6(3);
foreach ($generator as $value) {
	echo "$value\n";
}

// yield from - inner iterator with keys
function generator7($c) {
    for ($i = 1; $i <= $c; $i++) {
        yield $i => $i;
    }
}

function generator8($c) {
	yield 1 => 10;
	yield from generator5(3); // keys from inner iterator are preserved
	yield 3 => 10;
}

$generator = generator8(3);
foreach ($generator as $key => $value) {
	echo "$key => $value\n";
}

var_dump(iterator_to_array(generator8(3))); // duplicate keys are overridden

// yield from - use for array yield
function generator9() {
	yield from [1, 2, 3];
}

$generator = generator9();
foreach ($generator as $value) {
	echo "$value\n";
}

// yield and retur
function generator10() {
	yield 1;
	yield 2;
	return 3;
}

$generator = generator10();
foreach ($generator as $value) {
	echo "$value\n";
}

echo $generator->getReturn().PHP_EOL; // return value from iterator

// infinite iterator
function generator11() {
	$i = 0;
	while(true) {
		yield $i++;
	}
}

$generator = generator11();
foreach ($generator as $value) {
	echo "$value\n";
	if ($value > 10) {
		break;
	}
}
