#!/usr/bin/perl

package Snippets::callbackWithHash;

use strict;
use warnings;

use Data::Dumper;

sub o {

    my @args = (1,2,3);

    my ($c) = @_;
    $$c{action1}->(@args);
    $$c{action2}->(@args);
    $$c{action3}->(@args);

    my $coderef = $$c{action4};
    $coderef->(@args);

};

sub Main {
    print "Main\n";

    # hash with callbacks
    my %callbacks = (
        action1 => sub {
            print "action1\n";
        },
        action2 => sub {
            print "action2\n";
        },
    );

    # add anonymous callback to hash
    $callbacks{action3} = sub {
        print "action3\n";
    };

    # add subrutine to hash
    sub action4 {
        print "action4\n";
    }
    $callbacks{action4} = \&action4;

    o(\%callbacks);
};

__PACKAGE__->Main unless caller;

1;
