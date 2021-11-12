#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

use Time::Piece;

my $datum_exspiracie =  "12021-06-24T23:59:59.000+02:00";

my $show_as_actual_till = localtime 0;
eval {
    $show_as_actual_till = Time::Piece->strptime($datum_exspiracie, '%Y-%m-%dT%H:%M:%S.000+02:00');
};

print $@ if $@; 

if (ref($show_as_actual_till) eq "Time::Piece") {
    print "S=".$show_as_actual_till->strftime("%Y-%m-%dT%H:%M:%S")."\n";
}





