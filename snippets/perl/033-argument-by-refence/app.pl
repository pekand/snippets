#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;



sub change_data {
    my $data = shift;

    $data->{test} = "after\n";
}

sub main {

    my $data = {
        test => "before\n",
    };

    print $data->{test};

    change_data($data);

    print $data->{test};

}

main();


