#!/usr/bin/perl

use strict;
use warnings FATAL => 'all';

my $a = {
    ke1 => "value1"
};

#check if key exists in hash 
if(!exists $a->{ke2}) {
    print "key not exists\n\n";
}

1;
