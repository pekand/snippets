<?php


function printTable($header, $data) {
    $columnsSize = [];

    foreach($header as $column){
        if(!isset($columnsSize[$column])) {
            $columnsSize[$column] = strlen($column);
            continue;
        }

        if($columnsSize[$column] < strlen($column)) {
            $columnsSize[$column] = strlen($column);
        }
    }

    foreach($data as $key => $row){
        foreach($header as $column){
            if($columnsSize[$column] < strlen($row[$column])) {
                $columnsSize[$column] = strlen($row[$column]);
            }
        }
    }
    echo "|";
    foreach($header as $column) {
        echo str_pad($column, $columnsSize[$column], " ", STR_PAD_RIGHT)."|";
    }
    echo "\n";

    foreach($data as $key => $row){
        echo "|";
        foreach($header as $column){
            echo str_pad($row[$column], $columnsSize[$column], " ", STR_PAD_RIGHT)."|";
        }
        echo "\n";
    }

}

$dateStart = new DateTime("2022-01-01 00:00:00");
$dateEnd =  new DateTime("2022-12-31 23:59:59");
$dateNext = $dateStart;

$header = ["Y-m-d","m","M", "F","N","D","l","W"  ];  
$data = [];

while (true) {
    $data[] = [
        'Y-m-d' =>$dateNext->format("Y-m-d"),
        'm' =>$dateNext->format("m"),
        'M' =>$dateNext->format("M"),
        'F' =>$dateNext->format("F"),
        'N' =>$dateNext->format("N"),
        'D' =>$dateNext->format("D"),
        'l' =>$dateNext->format("l"),
        'W' =>$dateNext->format("W"),
    ];
    $dateNext->modify('+1 day');
    if ($dateEnd < $dateNext) {
        break;
    }
}

printTable($header, $data);
