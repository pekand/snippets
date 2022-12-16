<?php

$t = 5;
while($t--){
	sleep(1);
	echo "tick\n";
}
ini_set('max_execution_time', 10);
set_time_limit(5);
while(true){
	sleep(1);
	echo "tick\n";
}
