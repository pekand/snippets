#!/usr/bin/perl

package Reference::dump;

use strict;
use warnings;

use Data::Dumper;

sub Main {
    my $scalar = 1;
    my @array = (1, 2, 3, 4, 5, 6);
    my %hash = ('item1', 'value1', 'item2', 'value2', 'item3', 'value3');

    print Dumper($scalar);
    print Dumper(@array);
    print Dumper(%hash);

    print Dumper(\$scalar, \@array, \%hash);

    my $rscalar = \$scalar;
    my $rarray = \@array;
    my $rhash = \%hash;

    print Dumper($rscalar, $rarray, $rhash);
}

__PACKAGE__->Main unless caller;

1;


