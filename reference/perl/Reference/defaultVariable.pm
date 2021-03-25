#!/usr/bin/perl

package Reference::defaultVariable;

use strict;
use warnings;

sub Main {
    #when function dont have paramete then is used variable $_

    print "#################### Default variable\n";

    my @names = ('Foo', 'Bar', 'Baz');

    for (@names) {
        print;
    }

    print "\n";

    for (@names) {
        print $_."\n";
    }

    # is equivalent to

    ### for my $_ (@names) {
    ###     print $_;
    ### }

    print "\n####################\n";
}

__PACKAGE__->Main unless caller;

1;





