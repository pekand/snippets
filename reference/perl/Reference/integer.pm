#!/usr/bin/perl

package Reference::integer;

use strict;
use warnings;

sub Main {
    my $i = 5;
    $i++;
    print "a", "b", "c", $i;

    print "i=$i";

    print $i + "1";

    print $i . "1";

    print "\n";
}

__PACKAGE__->Main unless caller;

1;


