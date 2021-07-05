#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

use Time::Piece;

my $a = [
    {
        p1=>{
            v=>"value"
        },
        times => {

        }
    },
    {
        p2=>{
            v=>"value"
        },
        times => {
            expiration_timestamp => 123
        }
    },
    {
        p3=>{
            v=>"value"
        },
        times => {
            expiration_timestamp => 123
        }
    }
];


for my $el (@$a){
    delete $el->{times}{expiration_timestamp};
}

print Data::Dumper::Dumper($a);

my $x = $a->[0]->{times}{expiration_timestamp};

print Data::Dumper::Dumper($a);






