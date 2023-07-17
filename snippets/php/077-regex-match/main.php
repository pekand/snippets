<?php

$text = [
	'V109.1.2.3__test'
];

$regex = "/^V(\d+)((\.\d+)+)__(.*)$/";

foreach ($text as $t){
	preg_match($regex, $t, $m);

	var_dump($m);
}
