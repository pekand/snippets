#!/usr/bin/perl

package applicationLog;

use strict;
use warnings;
use Data::Dumper;

sub  trim { my $s = shift; $s =~ s/^\s+|\s+$//g; return $s };

sub getTimestamp {
    use DateTime;
    use DateTime::TimeZone;

    my $time = shift || "";
    my $timezone = shift || DateTime::TimeZone->new( name => 'local' )->name();

    my $dt;
    
    if ($time ne "") {
        my @parts = ($time =~ /^(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})(T| )(?<hour>\d{2}):(?<minute>\d{2}):(?<second>\d{2})(?<timezone>.*)$/);

        my $customTimezone = trim($+{timezone});

        if ($customTimezone eq "Z") {
            $timezone = "UTC";
        } elsif ($customTimezone ne "") {
            $timezone = $customTimezone;
        }

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

    return $dt->strftime("%Y-%m-%dT%H:%M:%S %Z");
    #return $dt->iso8601;
    #return $dt->rfc3339;    
}

print getTimestamp("2000-01-01T00:00:00Z")."\n";
print getTimestamp("2000-01-01T00:00:00 Europe/Bratislava")."\n";
print getTimestamp("2000-01-01T00:00:00 CET")."\n";
print getTimestamp("2000-01-01T00:00:00", 'UTC')."\n";
print getTimestamp("", "Europe/Bratislava")."\n";
print getTimestamp()."\n";
print getTimestamp("2001-02-03T04:05:06")."\n";
print getTimestamp("2000-01-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-03-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-04-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-05-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-06-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-07-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-08-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-09-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-10-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-11-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-12-01T00:00:00", 'Europe/Bratislava')."\n";
print getTimestamp("2000-05-01T00:00:00 CET")."\n";








