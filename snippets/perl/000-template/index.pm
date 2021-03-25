#!/usr/bin/perl

package Snippets::callback;

use strict;
use warnings;

use Data::Dumper;

my %callbacks = (
    action1 => sub {
        print "action1";
    },
    action2 => sub {
        print "action2";
    },
);

sub o {
    my ($c) = @_;
    $c->action1;
};

sub Main {
    print "test";
    o(\%callbacks);
};

__PACKAGE__->Main unless caller;

1;
