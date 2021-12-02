<?php

$dateStart = '1986-03-02 00:00:00';
$dateEnd = date("Y-m-d h:i:s");

$dateStartDT = new DateTime($dateStart);
$dateEndDT = new DateTime($dateEnd);
$diff = $dateEndDT->diff($dateStartDT);

$days_between = $diff->days;
echo "Is $days_between Days between dates $dateStart and $dateEnd\n";

$weeks_between = ceil($days_between/7);
echo "Is $weeks_between Weaks between dates $dateStart and $dateEnd\n";

$time_between = $diff->y." years ".$diff->m." months ".$diff->d." days".$diff->d." hours ".$diff->h." minutes ".$diff->s." seconds ".$diff->f." miliseconds";

echo "Is $time_between between dates $dateStart and $dateEnd\n";
