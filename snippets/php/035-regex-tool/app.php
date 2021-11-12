<?php

/*
    fileter text with regex 

    usage

    php app.php    -o out.txt -r "/(\/bonus\/[^ ,]+)/i" -i text.txt
    php app.php -s -o out.txt -r "/(\/bonus\/[^ ,]+)/i" < text.txt

    
*/

$readStdin = 0;
$readFile = 0;
$outputFile = 0;
$regex = 0;

for($i=1;  $i< count($argv); $i++) {
    if ($argv[$i] == "-s") {
        $readStdin = 1;
    }

    if (($argv[$i] == "-f" || $argv[$i] == "-i") && isset($argv[$i+1])) {
        $readFile = $argv[$i+1];
    }

    if ($argv[$i] == "-o" && isset($argv[$i+1])) {
        $outputFile = $argv[$i+1];
    }

    if ($argv[$i] == "-r" && isset($argv[$i+1])) {
        $regex = $argv[$i+1];
    }
}

$handle = null;

if($readFile) {
    $handle = fopen($readFile, "r");
}

if ($readStdin) {
    $handle = fopen( 'php://stdin', 'r' );
}


if($outputFile) {
    $out = fopen($outputFile, "w");
}

while (($line = fgets($handle)) !== false) {
    
    $res = preg_match_all($regex, $line, $matches);

    if($res) {
        $text = "";
        for($i=1;  $i < count($matches); $i++) {
            $text .= $matches[$i][0];
        }

        if ($outputFile) {
            fwrite($out, $text.PHP_EOL);
        } else {
            echo ($text.PHP_EOL);
        }
    }
}

if($outputFile) {
    fclose($out);
}

fclose($handle);
