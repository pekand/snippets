#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

my $data = {
    item1 => "value1",
    item2 => "value2",
    item3 => "value3",
};

if (exists $data->{item1}) {
    print "exists \n";
} else {
    print "not exists \n";
}


if (!exists $data->{item5}) {
    print "not exists \n";
} else {
    print "exists \n";
}
