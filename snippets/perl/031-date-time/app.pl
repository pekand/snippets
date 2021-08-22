#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;


my $timestamp = localtime(time);

print "$timestamp\n";

###################

use DateTime;
my $dt   = DateTime->now;   # Stores current date and time as datetime object
my $date = $dt->ymd;   # Retrieves date as a string in 'yyyy-mm-dd' format
my $time = $dt->hms;   # Retrieves time as a string in 'hh:mm:ss' format
my $wanted = "$date $time\n";   # creates 'yyyy-mm-dd hh:mm:ss' string
print $wanted;

###################

use Time::Piece;
print localtime->strftime('%Y-%m-%d %H:%M:%S')."\n";

1;
