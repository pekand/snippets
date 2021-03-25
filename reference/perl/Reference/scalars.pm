#!/usr/bin/perl

package Reference::scalars;

use strict;
use warnings;

sub Main {
    my $hexa = 0xff;
    my $octal = 0377;
    my $integer = 200;
    my $negative = -300;
    my $floating = 200.340;
    my $bigfloat = -1.2E-23;
}

__PACKAGE__->Main unless caller;

1;


