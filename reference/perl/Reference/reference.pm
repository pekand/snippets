#!/usr/bin/perl

package Reference::reference;

use strict;
use warnings;

use Data::Dumper;

sub Main {
    print "#################### Init\n";

    my $scalar = 1;
    my @array = (1, 2, 3, 4, 5, 6);
    my %hash = ('item1', 'value1', 'item2', 'value2', 'item3', 'value3');


    print Dumper(\$scalar, \@array, \%hash);

    print "#################### Create reference\n";

    my $rscalar = \$scalar;
    my $rarray = \@array;
    my $rhash = \%hash;


    print Dumper($rscalar);
    print Dumper($rarray);
    print Dumper($rhash);

    print "#################### Dereference\n";

    my @array2 = @{$rarray};
    my %hash2 = %{$rhash};


    print Dumper(@array2);
    print Dumper(%hash2);

    print "#################### Use reference to change value\n";

    ${$rarray}[0] = 5;
    ${$rhash}{"item1"} = "value4";

    $$rarray[0] = 6;
    $rarray->[1] = 7;
    $$rhash{"item1"} = "value5555";
    $rhash->{"item2"} = "value6666";

    print Dumper(\$scalar, \@array, \%hash);
    print Dumper($rscalar, $rarray, $rhash);

    print "#################### Copy value from reference\n";

    my $rarray2 = [@{$rarray}];

    $$rarray2[1] = 100; # value of $rarray is unchanged

    print Dumper($rarray, $rarray2);
}

__PACKAGE__->Main unless caller;

1;



