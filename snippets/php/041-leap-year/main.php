<?php


$year = 2000;

for ($year=1901;$year<=2100;$year++){
    $leap = date('L', mktime(0, 0, 0, 1, 1, $year));
    echo $year . ' ' . ($leap ? '[x]' : '[ ]') . (($year == date('Y'))?"<-":"  "). " ";
    if($year % 10 == 0) echo "\n"; 
}
