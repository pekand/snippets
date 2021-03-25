#!/usr/bin/perl

package Snippets::callback;

use strict;
use warnings;

use Data::Dumper;

sub o {
    my ($callback) = @_;

    &$callback();
};

sub Main {
    print "Main\n";

    sub action1 {
        print "action1\n";
    }

    o(\&action1);
};

__PACKAGE__->Main unless caller;

1;
