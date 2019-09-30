<?php


function getImage($w, $h, $file = null) {
	$im = @imagecreate($w, $h);
	$backgroundColor = imagecolorallocate($im, 188, 212, 230);
	$textColor = imagecolorallocate($im, 0, 0, 255);
	imagestring($im, 1, 5, 5,  $w."x".$h, $textColor);
	imagepng($im, $file);
	imagedestroy($im);
}

$w = 300;
$h = 200;

for ($i=0; $i < 100 ; $i++) { 
	getImage($w, $h, 'images/img'.str_pad($i, 3, 0).'.png');
}