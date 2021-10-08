#!/usr/bin/perl

use strict;
use warnings;

my $old_warn_handler = $SIG{__WARN__};
sub _warn_handler { 
    my ( $package, $file, $line ) = caller();

    print "WARN CATCH: $file, $package, $line\n";

    if (defined $old_warn_handler) {
        goto &$old_warn_handler;
    }
}
$SIG{__WARN__} = \&_warn_handler;


my $old_die_handler = $SIG{__DIE__};
sub _die_handler { 
    my ( $package, $file, $line ) = caller();

    print "DIE CATCH: $file, $package, $line\n";

    if (defined $old_die_handler) {
        goto &$old_die_handler;
    }
}
$SIG{__DIE__} = \&_die_handler;

sub _death_handler2 { 
    my ( $package, $file, $line ) = caller();

    
}

sub test {
    local $SIG{__WARN__} = sub {
        my ( $package, $file, $line ) = caller();
        print "LOCAL WARN CATCH: $file, $package, $line\n";
    }; 
    local $SIG{__DIE__} = sub {
         my ( $package, $file, $line ) = caller();
        print "LOCAL DIE CATCH: $file, $package, $line\n";
    };

    warn "Warn test";
    die("Error test");
}

sub Main {
    eval {
        test();
    };

    if ($@) {
        warn "WARN1: $@";
    }

    eval {
        die("Error eval");
    };

    if ($@) {
        warn "WARN2: $@";
    }

    die("Error global");

    print "DONE\n";
}

__PACKAGE__->Main unless caller;

1;

