#!/usr/bin/perl

package Subrutines::localtime;

use strict;
use warnings;

use Data::Dumper;

sub Main {
    my $a = localtime;
    my @b = localtime;

    print Dumper $a;
    print Dumper \@b;
}


__PACKAGE__->Main unless caller;

1;
