<?php

echo "<pre>";

echo time().PHP_EOL; // -> 1608244283 from 1970-01-01 00:00:00 GMT

$date = new DateTime("1970-01-01T01:00:00 CET");
$date->setTimezone(new DateTimeZone('UTC'));
echo $date->format('Y-m-d H:i:s T').PHP_EOL;
