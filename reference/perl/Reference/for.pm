#!/usr/bin/perl

package Reference::for;

use strict;
use warnings;

sub Main {
    for my $i (1, 2, 3, 4, 5) {
        print "$i ";
    }
    print "\n";
}


__PACKAGE__->Main unless caller;

1;


