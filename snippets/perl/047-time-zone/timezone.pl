#!/usr/bin/perl

package applicationLog;

use strict;
use warnings;
use Data::Dumper;

sub getTimestamp {
    use DateTime;
    use DateTime::TimeZone;

    my $time = shift || "";
    my $timezone = shift || DateTime::TimeZone->new( name => 'local' )->name();

    my $dt;
    
    if ($time ne "") {
        my @parts = ($time =~ /^(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})T(?<hour>\d{2}):(?<minute>\d{2}):(?<second>\d{2})$/);

        if (@parts != 0) {
            $dt = DateTime->new(
                year       => $+{year},
                month      => $+{month},
                day        => $+{day},
                hour       => $+{hour},
                minute     => $+{minute},
                second     => $+{second},
                nanosecond => 0,
                time_zone  => $timezone,
            );
        } else {
            die("Wrong format of date ".$time);
        }
    } else {
        $dt = DateTime->now(time_zone => $timezone); 
    }

    return $dt->strftime("%Y-%m-%dT%H:%M:%S %z");
}

print getTimestamp("2001-02-03T04:05:06", 'UTC')."\n";
print getTimestamp("", "Europe/Bratislava")."\n";
print getTimestamp()."\n";






