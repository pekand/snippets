<?php


function readCsv($file){
    $data = [];
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = $row;
        }
        fclose($handle);
    }
    return $data;
}

function writeCsv($file, $data){
    $fp = fopen($file, 'w');

    foreach ($data as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);
}


$csv = readCsv("in.csv");
var_dump($csv);
writeCsv("out.csv", $csv);
