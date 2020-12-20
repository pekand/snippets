<?php

date_default_timezone_set('Europe/Berlin');

$date = new DateTime();
$date = new DateTime("now", new DateTimeZone('Europe/Berlin'));
$date = DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00');
$date = new DateTime("1970-01-01T00:00:00", new DateTimeZone('UTC'));
$date = new DateTime("1970-01-01T00:00:00+00:00");
$date = new DateTime("1970-01-01T00:00:00 GMT");
$date = new DateTime("1970-01-01T00:00:00 GMT+0000");
$date = new DateTime("1970-01-01T01:00:00 CET"); // Europe/Berlin

echo $date->getTimestamp() . PHP_EOL;

$timeZone = $date->getTimezone();
echo $timeZone->getName() . PHP_EOL;

// error handling
try {
    $date = new DateTime('!');
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    var_dump(DateTime::getLastErrors());
}

/*

array(4) {
  'warning_count' =>
  int(0)
  'warnings' =>
  array(0) {
  }
  'error_count' =>
  int(1)
  'errors' =>
  array(1) {
    [0] =>
    string(20) "Unexpected character"
  }
}

*/

$date->modify('+1 day');
echo $date->format('Y-m-d H:i:s'). PHP_EOL;

$date->setTimezone(new DateTimeZone('Europe/Berlin'));
$date->setDate(2000, 1, 1);
$date->setTime($hour=0, $minute=0, $second=0, $microseconds = 0);
$date->setTimestamp(time());


$date->add(new DateInterval('P1Y1DT1H1M1S')); // P = period separator T = time separator,  Y  = years , M  = months, D  = days , W =  weeks , H = hours , M = minutes , S = seconds
$date->sub(new DateInterval('P1D'));

//////////////////////

// iteration over time period 

$begin = new DateTime('2020-01-01' );
$end = new DateTime('2020-01-10' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    echo $date->format("Y-m-d") . PHP_EOL; 
}

//////////////////////

// time difference

$d1=new DateTime();
$d2=new DateTime();
$interval=$d2->diff($d1); 
echo $interval->format('%d days %H hous %I minutes %S seconds %F microseconds') . PHP_EOL;

$interval = DateInterval::createFromDateString('1 day 1 minute 1 second');

/////////////////////

// Procedural style

// error handling
$date = date_create("!"); // error : Unexpected character
if (!$date) {
    var_dump(date_get_last_errors());
}

$date = date_create("now", timezone_open('Europe/Berlin'));
$date = date_create_from_format ('Y-m-d H:i:s', '2000-01-01 00:00:00', timezone_open('Europe/Berlin'));

$date = date_modify($date, '+1 day');
$date = date_date_set($date , $year = 2020, $month = 1, $day = 1);
$date = date_time_set($date , $hour = 0 , $minute = 0 , $second = 0 , $microseconds = 0 );
$timeStamp = date_timestamp_get($date);
$date = date_timestamp_set($date, $timeStamp);
$timeZone = date_timezone_get($date); 
$date = date_timezone_set($date, timezone_open('Europe/Berlin'));
$date = date_add($date, date_interval_create_from_date_string('1 day'));
$date = date_sub($date, date_interval_create_from_date_string('1 day'));
echo date_format($date, 'Y-m-d H:i:s') . PHP_EOL;


//////////////////

var_dump(date_parse("2000-01-01 00:00:00"));
var_dump(date_parse_from_format('Y-m-d H:i:s', "2000-01-01 00:00:00"));
/*
array(12) {
  'year' =>
  int(2000)
  'month' =>
  int(1)
  'day' =>
  int(1)
  'hour' =>
  int(0)
  'minute' =>
  int(0)
  'second' =>
  int(0)
  'fraction' =>
  double(0)
  'warning_count' =>
  int(0)
  'warnings' =>
  array(0) {
  }
  'error_count' =>
  int(0)
  'errors' =>
  array(0) {
  }
  'is_localtime' =>
  bool(false)
}
*/


//////////////////////////

$zenith = ini_get("date.sunrise_zenith");

echo 'zenith = '.$zenith . PHP_EOL;

echo date('Y-m-d'). ', sunrise time : ' .date('H:i:s', 
    date_sunrise(time(), SUNFUNCS_RET_TIMESTAMP, $latitude = 48.1582782, $longitude =17.1285745, $zenith,  $gmt_offset = 2)
) . PHP_EOL;

echo date('Y-m-d'). ', sunset time : ' .date('H:i:s', 
    date_sunset(time(), SUNFUNCS_RET_TIMESTAMP, $latitude = 48.1582782, $longitude = 17.1285745, $zenith,  $gmt_offset = 2)
) . PHP_EOL;


var_dump(date_sun_info (time(), $latitude = 48.1582782, $longitude =17.1285745));

/*

array(9) {
  'sunrise' =>
  int(1587786127)
  'sunset' =>
  int(1587837398)
  'transit' =>
  int(1587811762)
  'civil_twilight_begin' =>
  int(1587784087)
  'civil_twilight_end' =>
  int(1587839438)
  'nautical_twilight_begin' =>
  int(1587781537)
  'nautical_twilight_end' =>
  int(1587841988)
  'astronomical_twilight_begin' =>
  int(1587778651)
  'astronomical_twilight_end' =>
  int(1587844874)
}

*/


////////////////////

$localTimeZone = new DateTimeZone('UTC');
$localTime = new DateTime('now', $localTimeZone);
echo $localTime->format('Y-m-d H:i:s').PHP_EOL;

$userTimeZone = new DateTimeZone('Europe/Berlin');
$userTime = new DateTime('now', $userTimeZone);

$localOffset = $localTime->getOffset() / 3600;
$userOffset = $userTime->getOffset() / 3600;

$diff = $userOffset - $localOffset;
echo "time zone difference = ". $diff . ' hours' . PHP_EOL;


////////////////////////

// get Daylight Saving Time Transitions between two timestamps

echo "time zone database version = ". timezone_version_get() . PHP_EOL;
$userTimeZone = new DateTimeZone('Europe/Berlin');
var_dump(
    $userTimeZone->getTransitions(
        mktime(0, 0, 0, 1, 1, 2020),
        mktime(0, 0, 0, 1, 1, 2021)
    )
);
 
////////////////////////

// immutable
$date = new DateTimeImmutable();
$date = new DateTimeImmutable('now');
$date = new DateTimeImmutable('now', new DateTimeZone('Europe/Berlin'));
$date = DateTimeImmutable::createFromMutable(new DateTime());
$date = $date->setTimestamp(time());
