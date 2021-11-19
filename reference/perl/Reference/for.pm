#!/usr/bin/perl

package Reference::for;

use strict;
use warnings;

sub Main {
    for my $i (1, 2, 3, 4, 5) {
        print "$i ";
    }

    print "\n";

    my @a = (1..5);
    for my $e (@a) {
        print "$e ";
    }

    print "\n";

    my $b = [1..5];
    for my $e (@$b) {
        print "$e ";
    }

    print "\n";

    my @c = (1..5);
    for(my $i = 0; $i < scalar @c; $i++){
        print("$c[$i] ");
    }

    print "\n";

    my @d = (1..5);
    for(my $i = 0; $i < $#d +1; $i++){
        print("$d[$i] ");
    }

    print "\n";

    my $e = [1..5];
    for(my $i = 0; $i < scalar @$e; $i++){
        print("@$e[$i] ");
    }

    print "\n";

    my $f = [1..5];
    foreach (@$f)
    {
        print("$_ ");
    }

    print "\n";

    my @g = (1..5);
    for my $i (0..$#g)
    {
        print("$g[$i] ");
    }

    print "\n";

    my $h = [1..5];
    for my $i (0..$#$h)
    {
        print("$$h[$i] ");
    }

    print "\n";

    for my $i (1..5)
    {
        print("$i ");
    }

    print "\n";
}


__PACKAGE__->Main unless caller;

1;


