<?php

echo "<pre>";

$itemCount = 100000;

echo "<h1>Sort alg by time over $itemCount random items</h1>";

$data = [];
for ($i=0; $i < $itemCount; $i++) { 
    $data[] = random_bytes(1024);
}

$algOut = [];
foreach (hash_algos() as $alg) {
    $starttime = microtime(true);
    foreach ($data as $value) {
        $out = hash($alg, $value);
    }
    $endtime = microtime(true);
    $timediff = $endtime - $starttime;

    $algOut[] = ['alg'=>$alg, 'time'=>$timediff];
}


usort($algOut, function ($a, $b) {
    return $a['time'] <=> $b['time'];
});


foreach ($algOut as $value) {
    echo $value['alg']. ' = '.$value['time'].PHP_EOL;
}
