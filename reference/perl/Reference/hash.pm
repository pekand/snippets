#!/usr/bin/perl
package Reference::hash;

use strict;
use warnings;

use Data::Dumper;

sub Main {
    print "########## Init \n";

    my %hash = ('item1', 'value1', 'item2', 'value2', 'item3', 'value3');

    my %hash2 = ( 
        'item1'=>'value1', 
        'item2'=>'value2', 
        'item3'=>'value3'
    );

    print Dumper(\%hash);
    print Dumper(\%hash2);

    print "########## Change value \n";

    $hash{"item1"} = "value4";
    $hash{item2} = "value5";

    print "\$hash{'item1'} = $hash{'item1'}\n";

    print Dumper(\%hash);

    print "########## Get size \n";

    my $size = scalar(%hash);
    print "item count: $size\n";

    my $size2 = scalar(keys %hash);
    print "item count: $size2\n";

    print "########## Inner hash\n";

    my %hash3 = (
        'item1' => {
            'item2'=> "value"
        }
    );

    print "".($hash3{item1}{item2})."\n";
    print "".($hash3{item1}->{item2})."\n";

    my $hash4 = {
        'item1' => {
            'item2'=> "value"
        }
    };

    print $hash4->{item1}{item2}."\n";
    print $hash4->{item1}->{item2}."\n";
}

__PACKAGE__->Main unless caller;

1;
