#!/usr/bin/perl

use strict;
use warnings;
use Benchmark qw(:all);

# shttps://perldoc.perl.org/Benchmark

Benchmark->debug(1);
my $t = timeit(10, sub { 
    5 ** 4 
});
Benchmark->debug(0);
