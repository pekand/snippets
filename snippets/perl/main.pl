#!/usr/bin/perl

package main;

use strict;
use warnings FATAL => 'all';
use Data::Dumper;

sub Main {
    print "Main\n";
    print Dumper {};
}

__PACKAGE__->Main unless caller;

1;
