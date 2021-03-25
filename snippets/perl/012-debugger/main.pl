#!/usr/bin/perl

package Example::Template;

use strict;
use warnings FATAL => 'all';
use Data::Dumper;

my $var = 123;

sub Main {
    print "Main\n";
    print Dumper {};
}

__PACKAGE__->Main unless caller;

1;
