#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

use Time::Piece;

my $t = localtime;
my $datum_exspiracie =  "2021-06-24T23:59:59.000+02:00";
my $show_after_end_delay = 7;
my $show_as_actual_till = Time::Piece->strptime($datum_exspiracie, '%Y-%m-%dT%H:%M:%S.000+02:00') + (86400 * $show_after_end_delay);

print "L=".$t->strftime("%Y-%m-%dT%H:%M:%S")."\n";
print "S=".$show_as_actual_till->strftime("%Y-%m-%dT%H:%M:%S")."\n";
print "U=".localtime(1624599132)->strftime("%Y-%m-%dT%H:%M:%S")."\n";




