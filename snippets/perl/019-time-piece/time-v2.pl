#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

use Time::Piece;


my $datum_exspiracie = localtime; #current time
my $secAdd = 10 * 60;
my $datum_exspiracie_delay = $datum_exspiracie + $secAdd; #add 10 minutes

print "E=".$datum_exspiracie->strftime("%Y-%m-%d %H:%M:%S")."\n"; #current time
print "ED=".$datum_exspiracie_delay->strftime("%Y-%m-%d %H:%M:%S")."\n"; #new time

my $timeNow =  localtime;
$timeNow = $timeNow + 10*60;
print $timeNow->strftime('%H:%M');