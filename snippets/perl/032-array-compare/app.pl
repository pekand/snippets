#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;


my $a1 = [1,2,3,4,5,6,7,8,9];
my $a2 = [1,2,3,4,5,6,7,8,9];

my $same = 1;
for my $v (@$a1) {
    if (!grep( /^$v$/, @$a2 ) ) {
        $same = 0;
        last;
    }
}

print $same;
