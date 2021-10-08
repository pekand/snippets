#!/usr/bin/perl

use strict;
use warnings;

use subs 'die';

#override die function
sub die {
    my ( $package, $file, $line ) = caller();

    print "DIE: $package $file $line \n";

    # call default die can create infinite loop
    if ($line == 22) {
        die @_;
    }
} 

sub Main {
    eval {
        die("Error message");
    };

    if ($@) {
        warn "Error: $@\n";
    }
}

__PACKAGE__->Main unless caller;

1;

