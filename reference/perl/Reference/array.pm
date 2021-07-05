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

    my $a2 = [1,2,3,4,5,6,7];
    my $size4 = scalar @$a2;
    print "item count: $size4\n";

    my $size5 = @$a2;
    print "item count: $size5\n";

    if(@$a2 == 7) {
         print "compare\n";
    }

    my $a3 = [
        [1,2,3,4,5,6,7],
        [8,9,10,11,12,13,14],
        [15,16,17,18,19,20,21],
    ];

    for my $row (@$a3) {
        for my $col (@$row) {
            print "$col, ";
        }        
    }

}


__PACKAGE__->Main unless caller;

1;



