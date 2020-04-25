<?php

echo date_default_timezone_get().PHP_EOL;
date_default_timezone_set('America/New_York');
date_default_timezone_set('Europe/Berlin');
date_default_timezone_set('Europe/Bratislava');
date_default_timezone_set('UTC');

echo json_encode(getdate()).PHP_EOL;
echo json_encode(getdate(time())).PHP_EOL;

echo date('Y-m-d h:i:s').PHP_EOL;

echo date("Y-m-d h:i:s", time()).PHP_EOL;

echo date('d').PHP_EOL; // 01 - 31
echo date('D').PHP_EOL; // Mon - Sun
echo date('j').PHP_EOL; // 1 - 31
echo date('l').PHP_EOL; //Sunday - Saturday
echo date('N').PHP_EOL; // 1 - 7  (Monday - Sunday)
echo date('jS').PHP_EOL; //1st, 2nd, 3rd or 4th ...
echo date('w').PHP_EOL; // 0 - 6 (Sunday- Saturday)
echo date('z').PHP_EOL; // 0 - 365
echo date('W').PHP_EOL; // 1 - 57 (week in year)
echo date('F').PHP_EOL; // January - December
echo date('m').PHP_EOL; // 01 - 12
echo date('M').PHP_EOL; // Jan - Dec
echo date('n').PHP_EOL; // 1 - 12
echo date('t').PHP_EOL; // 28, 29, 30, 31 (says in month)
echo date('L').PHP_EOL; //  0 - 1 (leap year)
echo date('o').PHP_EOL; // 1999 (ISO-8601 year)
echo date('Y').PHP_EOL; // 1999 (year)
echo date('y').PHP_EOL; // 99 (year)
echo date('a').PHP_EOL; // am - pm
echo date('A').PHP_EOL; // AM - PM
echo date('B').PHP_EOL; // 000 - 999 (Swatch Internet time)
echo date('g').PHP_EOL; // 1 - 12 (12-hour format)
echo date('G').PHP_EOL; // 0 - 23 (24-hour format)
echo date('h').PHP_EOL; // 01 - 12 (12-hour format)
echo date('H').PHP_EOL; // 00 - 23 (24-hour format)
echo date('i').PHP_EOL; // 00 - 59 (minutes)
echo date('s').PHP_EOL; // 00 - 59 (Seconds)
echo date('u').PHP_EOL; // (microseconds)
echo date('v').PHP_EOL; // (milliseconds)
echo date('e').PHP_EOL; // UTC (Timezone identifier)
echo date('I').PHP_EOL; // 1- 0 1 (Daylight Saving Time)
echo date('O').PHP_EOL; // +0200 (Difference to GMT)
echo date('P').PHP_EOL; // +02:00 (Difference to GMT)
echo date('Y').PHP_EOL; // (Timezone abbreviation)
echo date('Z').PHP_EOL; // (Timezone offset in seconds)
echo date('c').PHP_EOL; // 2000-01-01T00:00:00+00:00  (ISO 8601 date)
echo date('r').PHP_EOL; // Mon, 1 Jan 2000 00:00:00 +0000 (RFC 2822 formatted date)
echo date('U').PHP_EOL; // timestamp Unix Epoch (January 1 1970 00:00:00 GMT)


$timestamp = mktime(
    $hour = date("H"), 
    $minute = date("i"), 
    $second = date("s"), 
    $month = date("n"), 
    $day = date("j"),
    $year = date("Y")
);

$timestamp = mktime(12, 0, 0, 1, 1, 2000);

echo strtotime("+1 week 1 days 1 hours 1 minutes 1 seconds").PHP_EOL;

echo strtotime("now").PHP_EOL;
echo strtotime("1 days ago").PHP_EOL;
echo strtotime("yesterday").PHP_EOL;
echo strtotime("today").PHP_EOL;
echo strtotime("noon").PHP_EOL; // lunchtime
echo strtotime("midnight").PHP_EOL;
echo strtotime("tomorrow").PHP_EOL;

echo strtotime("back of midnight").PHP_EOL; // midnight + 15 min
echo strtotime("front of midnight").PHP_EOL; // midnight - 15 min

echo strtotime("first day of next month").PHP_EOL;
echo strtotime("last day of next month").PHP_EOL;

echo strtotime("monday").PHP_EOL;
echo strtotime("mon").PHP_EOL;

echo strtotime("first monday").PHP_EOL;
echo strtotime("second monday").PHP_EOL;
echo strtotime("fourth monday").PHP_EOL;
echo strtotime("next monday").PHP_EOL;
echo strtotime("last monday").PHP_EOL;
echo strtotime("previous monday").PHP_EOL;
echo strtotime("this monday").PHP_EOL;


echo strtotime("+1 sec").PHP_EOL;
echo strtotime("-2 secs").PHP_EOL;
echo strtotime("+1 second").PHP_EOL;
echo strtotime("+1 seconds").PHP_EOL; // pluralization
echo strtotime("+1 min").PHP_EOL;
echo strtotime("+1 minute").PHP_EOL;
echo strtotime("+1 hour").PHP_EOL;
echo strtotime("+1 day").PHP_EOL;
echo strtotime("+1 fortnight").PHP_EOL;
echo strtotime("+1 month").PHP_EOL;
echo strtotime("+1 year").PHP_EOL;
echo strtotime("+1 weeks").PHP_EOL;

echo strtotime("last day of next month").PHP_EOL;

echo date('Y-m-d h:i:s', strtotime("2020-01-01 01:01:01")).PHP_EOL; // convert string to timestamp and back to string

///////////////////////

echo (checkdate(1, 1, 2020) ? '1' : '0').PHP_EOL; // check if date is valid

///////////////////////

$start = microtime(true);
usleep(1000000); // 1sec
// sleep(1);
$stop = microtime(true) - $start;
echo $stop.'sec'.PHP_EOL;

///////////////////////


