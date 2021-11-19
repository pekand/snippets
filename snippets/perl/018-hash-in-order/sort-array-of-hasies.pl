#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

my $data = [ {
        item => 1,
    }, {
        item => 4,
    }, {
        item => 3,
    }, {
        item => 2,
    }, 
];

print Data::Dumper::Dumper($data);

my $sorted =  [ sort { $a->{item} <=> $b->{item} } @$data ];

print Data::Dumper::Dumper($sorted);

