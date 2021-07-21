#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;
use DBI;
use Data::Dumper;



my $a = undef;

if (defined $a){
    print "1";
} else {
    print "0";
}

################

my $b;

if (defined $b){
    print "1";
} else {
    print "0";
}

1;
