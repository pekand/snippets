<?php

// Daylight saving time (DST)


$year = 2021;

for($i = 1; $i <= 12; $i++) {    
    for($j = 1; $j <= cal_days_in_month(CAL_GREGORIAN, $i, $year) ; $j++) { 
        for($k = 0; $k < 24 ; $k++) { 
            $i_pad = str_pad($i, 2, "0", STR_PAD_LEFT);
            $j_pad = str_pad($j, 2, "0", STR_PAD_LEFT);
            $k_pad = str_pad($k, 2, "0", STR_PAD_LEFT);
            $date = new DateTime($year."-".$i_pad."-".$j."T".$k_pad.":00:00 UTC");
            $date->setTimezone(new DateTimeZone('Europe/Bratislava'));
            echo "$i_pad.$j_pad. $k_pad:00:00 : ". $date->format('Y-m-d\TH:i:s T').PHP_EOL;
        }
    }
}



/*

....
03.27. 22:00:00 : 2021-03-27T23:00:00 CET
03.27. 23:00:00 : 2021-03-28T00:00:00 CET
03.28. 00:00:00 : 2021-03-28T01:00:00 CET
03.28. 01:00:00 : 2021-03-28T03:00:00 CEST
03.28. 02:00:00 : 2021-03-28T04:00:00 CEST
03.28. 03:00:00 : 2021-03-28T05:00:00 CEST
03.28. 04:00:00 : 2021-03-28T06:00:00 CEST
....
10.30. 21:00:00 : 2021-10-30T23:00:00 CEST
10.30. 22:00:00 : 2021-10-31T00:00:00 CEST
10.30. 23:00:00 : 2021-10-31T01:00:00 CEST
10.31. 00:00:00 : 2021-10-31T02:00:00 CEST
10.31. 01:00:00 : 2021-10-31T02:00:00 CET
10.31. 02:00:00 : 2021-10-31T03:00:00 CET
....

*/
