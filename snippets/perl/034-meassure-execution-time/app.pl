#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;

my $start = time;

my $count = 0;
for(my $i = 0; $i < 999999999; $i++) {
    $count += $i;
}

my $duration = time - $start;

print "count=$count\n";

print "duration=$duration\n";

