<?php 

$start = microtime(true);

$pid = 0;
sleep(5);
for($i = 0;$i<1000000;$i++) {
	$pid = getmypid();
}

echo $pid."\n";
$time_elapsed_secs = microtime(true) - $start;
echo $time_elapsed_secs;