<?php

$start = microtime(true);

$primes = [];

$handle = fopen("primes.txt", "r");
while (($line = fgets($handle)) !== false) {
    $primes[] = $line;
}

$countDivs = 0;
$primeCount = 0;
for ($i = count($primes) > 0 ? $primes[count($primes)-1] + 1 : 2; $i < 99999999; $i++) { //99999999
    $found = false;
    $sqr = sqrt($i);

    for($j = 0; $j < count($primes); $j++) {
        if(sqrt($i) < $primes[$j]) {
            break;
        }

        $countDivs++;
        if($i % $primes[$j] == 0) {
            $found = true;
            break;
        }
    }

    if(!$found) {
        $primeCount++;
        $primes[] = $i;
        file_put_contents("primes.txt", $i.PHP_EOL, FILE_APPEND);
    }
}

$seconds = microtime(true) - $start;
echo "time = " . sprintf('%02d:%02d:%02d', ($seconds/3600), ($seconds/60%60), $seconds%60) . PHP_EOL;

echo "countDivs = ".$countDivs.PHP_EOL;

/*foreach($primes as $prime) {
    echo $prime.PHP_EOL;
}*/

