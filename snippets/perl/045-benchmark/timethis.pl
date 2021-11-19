#!/usr/bin/perl

use strict;
use warnings;
use Data::Dumper;
use Benchmark qw( timethis );

# shttps://perldoc.perl.org/Benchmark

my $x = 1;

# how many time in 500000 iterations + instant output to console
my $benchmark_object = timethis (500000, sub { 
    $x += 1;
});

# COUNT -5 => 5 CPU time seconds 
# COUNT 0 => 3 seconds
# COUNT 5 => 5 real (wallclock) time seconds

print "cpu_p=".$benchmark_object->cpu_p."\n"; # cpu_p - total cpu parent process
print "cpu_c=".$benchmark_object->cpu_c."\n"; # cpu_c - total cpu children processes
print "cpu_a=".$benchmark_object->cpu_a."\n"; # cpu_a - total CPU of parent and any children processes.
print "real=".$benchmark_object->real."\n";   # Real elapsed time "wallclock seconds".
print "iters=".$benchmark_object->iters."\n"; # Number of iterations run.

