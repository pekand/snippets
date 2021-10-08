#!/usr/bin/perl

use strict;
use warnings;
use Data::Dumper;


sub evalReturnExample {
    my $res = eval {
        return 5;
    };

    if ($@) {

        warn $@;
    }

    print "res = $res \n";
}

sub evalNextExample {

    for my $i (1, 2, 3) {
        eval {
            next;
        };

        if ($@) {
            warn $@;
        }

        print "$i ";
    }
   

    print "\n";
}

sub Main {
    evalReturnExample();
    evalNextExample();
}

__PACKAGE__->Main unless caller;

1;

