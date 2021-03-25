#!/usr/bin/perl

package Reference::subrutineParameters;

use strict;
use warnings;

use Data::Dumper;

sub s1 {
    my ($param1_ref, $param2_ref) = @_;

    print Dumper($param1_ref, $param2_ref);
}


sub Main {
    print "#################### Pass two variables to subrutine\n";

    my $p1 = {
        item1=>'value1'
    };

    my $p2 = {
        item1=>'value1'
    };

    s1($p1, $p2);
}

__PACKAGE__->Main unless caller;

1;





