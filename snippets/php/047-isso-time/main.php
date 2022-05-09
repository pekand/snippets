<?php

if (date_default_timezone_get()) {
    echo 'date_default_timezone_set: ' . date_default_timezone_get() . "\n";
}

$datetime = new DateTime('2010-12-30 23:21:46', new DateTimeZone('Europe/Bratislava'));
$datetime->setTimezone(new DateTimeZone('UTC'));
echo $datetime->format("Y-m-d\TH:i:s.v\Z");
