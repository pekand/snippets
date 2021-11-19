#!/usr/bin/perl

use strict;
use warnings;
use Benchmark qw( timethese cmpthese ) ;

# shttps://perldoc.perl.org/Benchmark

my $x = 3;

my $r = timethese( -5, {
    a => sub{
        $x*$x
    },
    b => sub{
        $x**2
    },
} );

cmpthese $r;
