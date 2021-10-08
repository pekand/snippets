#!/usr/bin/perl

use strict;
use warnings;

my $old_die_handler = $SIG{__DIE__};
sub _death_handler { 
    my ( $package, $file, $line ) = caller();

    print "CATCH: $file, $package, $line\n";

    if (defined $old_die_handler) {
        goto &$old_die_handler;
    }
}
$SIG{__DIE__} = \&_death_handler;

sub Main {
    eval {
        die("Error eval");
    };

    if ($@) {
        warn "WARN: $@";
    }

    die("Error global");

    print "DONE\n";
}

__PACKAGE__->Main unless caller;

1;

