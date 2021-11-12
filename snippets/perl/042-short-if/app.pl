#!/usr/bin/perl

use strict;
use warnings;
use Data::Dumper;


sub Main {

    my $a = 0;

    my $b = 5 if $a;

    print $b;
    print defined $b ? 1 : 0;

}

__PACKAGE__->Main unless caller;

1;

