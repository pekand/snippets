<?php


$game =[
	[0,0,0, 0,0,0, 8,0,1],
	[0,6,7, 0,0,2, 4,5,3],
	[1,0,0, 7,0,8, 0,0,0],

	[6,0,0, 2,0,3, 0,0,0],
	[0,3,9, 0,0,0, 6,1,0],
	[4,0,0, 6,0,0, 0,0,5],

	[3,0,0, 4,0,7, 0,0,2],
	[0,4,1, 0,0,0, 5,8,0],
	[0,0,0, 0,0,0, 0,0,0],
];

$options = [];

function inrow($n,$r) {

	for($i=0; $i<9; $i++) {
		if($game[$r][$i] == $n) {
			return true;
		}
	}

	return false;
}

function incol($n,$c){
	for($i=0; $i<9; $i++) {
		if($game[$i][$c] == $n) {
			return true;
		}
	}

	return false;
}

function inbloc($n,$b) {
	$i = 0;
	$j = 0;

	switch ($b) {
		case 0: $i = 0;$j = 0;break;
		case 1: $i = 3;$j = 0;break;
		case 2: $i = 6;$j = 0;break;
		
		case 3: $i = 0;$j = 3;break;
		case 4: $i = 3;$j = 3;break;
		case 5: $i = 6;$j = 3;break;
		
		case 6: $i = 0;$j = 6;break;
		case 7: $i = 3;$j = 6;break;
		case 8: $i = 6;$j = 6;break;

	}

	return $game[0+$i][0+$j]==$n ||
	$game[0+$i][1+$j]==$n ||
	$game[0+$i][2+$j]==$n ||
	$game[1+$i][0+$j]==$n ||
	$game[1+$i][1+$j]==$n ||
	$game[1+$i][2+$j]==$n ||
	$game[2+$i][0+$j]==$n ||
	$game[2+$i][1+$j]==$n ||
	$game[2+$i][2+$j]==$n;
}


for($i=0; $i<9; $i++) {
	for($j=0; $j<9; $j++) {
		echo $game[$i][$j]." ";
	}
	echo "\n";
}
