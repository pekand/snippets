<?php


function generateRandomInt()
{
	$generateWinningSegmentValue = [
		'MIN' => 0,
		'MAX' => 9999,
	];

	try {
    throw new \Exception();
		return random_int($generateWinningSegmentValue['MIN'], $generateWinningSegmentValue['MAX']);
	} catch (\Exception $e) {
		return mt_rand($generateWinningSegmentValue['MIN'], $generateWinningSegmentValue['MAX']);
	}
}

$number_segments = 15;

$distribution = [];

for ($i=0; $i < 1000000 ; $i++) { 
	$genRandInt = generateRandomInt();
	$genSegmentId = ($genRandInt % $number_segments);

	if(!isset($distribution[$genSegmentId])){
		$distribution[$genSegmentId] = 0;
	}

	$distribution[$genSegmentId]++;
}
ksort($distribution);
var_dump($distribution);

/*
example of result:
array(10) {
  [0]=>
  int(99964)
  [1]=>
  int(99623)
  [2]=>
  int(100397)
  [3]=>
  int(100191)
  [4]=>
  int(100390)
  [5]=>
  int(100149)
  [6]=>
  int(99549)
  [7]=>
  int(99571)
  [8]=>
  int(100321)
  [9]=>
  int(99845)
}*/