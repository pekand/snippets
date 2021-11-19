#!/usr/bin/perl

use strict;
use warnings;
use Benchmark qw(:all);

# shttps://perldoc.perl.org/Benchmark

my $t0 = Benchmark->new;
for my $i (1..3)
{
    sleep(1);
    print("$i ");
    $| = 1;
}

my $t1 = Benchmark->new;
my $td = timediff($t1, $t0);
print "the code took:",timestr($td),"\n";
