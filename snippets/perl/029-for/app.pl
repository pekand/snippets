#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;
use DBI;
use Data::Dumper;

sub fun () {
    print "call\n";
    return [1,2,3,4];
}

for my $val (@{fun()}) {
    print $val."\n";
}

1;
