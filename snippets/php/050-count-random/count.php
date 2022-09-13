<?php

$counter = [];

$handle = fopen("file.out", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $num = trim($line);
        if(!isset($counter[$num])) {
            $counter[$num] = 0;
        }

        $counter[$num]++;
    }

    fclose($handle);
}


$counter2 = [];

ksort($counter);
for($i = -32768; $i < 32768; $i++){
    echo $i ." - " . (isset($counter[$i]) ? $counter[$i] : 0) . "\n";

    $value = $counter[$i];
    if(!isset($counter2[$value])) {
        $counter2[$value] = 0;
    }

    $counter2[$value]++;
}

ksort($counter2);
foreach($counter2 as $key => $value){
    echo $key ." - " . $value . "\n";
}
