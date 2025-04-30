<?php

$year = 2025;

for ($month = 1; $month <= 12; $month++) {
    echo str_pad(date('F', mktime(0, 0, 0, $month, 1, $year)), 20, ' ', STR_PAD_BOTH) . "\n";
    echo "Mo Tu We Th Fr Sa Su\n";

    $firstDayOfMonth = date('N', mktime(0, 0, 0, $month, 1, $year)); 
    $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));

    $currentDay = 1;

    for ($i = 1; $i < $firstDayOfMonth; $i++) {
        echo "   ";
    }

    while ($currentDay <= $daysInMonth) {
        echo str_pad($currentDay, 2, ' ', STR_PAD_LEFT) . " ";
        if ((($currentDay + $firstDayOfMonth - 1) % 7) == 0) {
            echo "\n";
        }
        $currentDay++;
    }

    echo "\n\n----------------------------------------\n\n";
}