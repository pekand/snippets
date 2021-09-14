#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;

use Time::Piece;
use Time::Seconds;

################# Date parse

my $now_string = localtime->strftime('%Y-%m-%d %H:%M:%S');

my $time_piece_now = Time::Piece->new;

my $time_piece_from_string = Time::Piece->strptime($now_string, '%Y-%m-%d %H:%M:%S');

my $time_piece_from_string2 = Time::Piece->strptime("2022-01-01 00:00:00", '%Y-%m-%d %H:%M:%S');


################# catch error

my $time_piece_from_string_wrong = -1;

eval {
    $time_piece_from_string_wrong = Time::Piece->strptime("basd_string", '%Y-%m-%d %H:%M:%S');    
};

print $@ if $@;        

################# Date Comparison

if ($time_piece_from_string2 > $time_piece_now) {
    print ">\n";
} else {
    print "<\n";
}


################# Date Calculations

my $last_chceck = Time::Piece->strptime("2021-08-08 00:00:00", '%Y-%m-%d %H:%M:%S');

if (Time::Piece->new - $last_chceck > ONE_DAY) {
    print ">\n";
} else {
    print "<\n";
}

################# Date Calculations

my $tomorrow = Time::Piece->new + ONE_DAY * 1;
my $tomorow_string = $tomorrow->strftime('%Y-%m-%d %H:%M:%S');
warn Data::Dumper::Dumper($tomorow_string);
