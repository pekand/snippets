#!/usr/bin/perl

package Reference::array;

use strict;
use warnings;

use Data::Dumper;

sub Main {
    my @a1 = (1, 2, 3, 4, 5, 6);

    $a1[0] = 7;

    print $a1[0]."\n";

    print Dumper(\@a1);

    my $size = @a1;
    print "item count: $size\n";

    my $size2 = scalar(@a1);
    print "item count: $size2\n";

    my $size3 = scalar @a1;
    print "item count: $size3\n";

    my $indexMax = $#a1; 
    print "Largest index: $indexMax\n";
}


__PACKAGE__->Main unless caller;

1;



