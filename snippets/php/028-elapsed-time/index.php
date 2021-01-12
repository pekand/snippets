<?php

echo "<pre>".PHP_EOL;

function formatSec(int $seconds) {  
  return sprintf('%02d:%02d:%02d', ($seconds/3600),($seconds/60%60), $seconds%60);
}

$start = microtime(true);
echo 'start = '. $start.PHP_EOL;
sleep(3);
$timeElapsedSecs = microtime(true) - $start;


echo 'elapsed = '. $timeElapsedSecs.PHP_EOL;
echo 'round = '. round($timeElapsedSecs, 3).PHP_EOL;
echo 'formated = '.formatSec($timeElapsedSecs).PHP_EOL;
