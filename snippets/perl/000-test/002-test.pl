#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

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


if (exists $a->[0]){
    print 1;
} else {
    print 0;
}

if (exists $a->[0]->{times}{expiration_timestamp}){
    print 1;
} else {
    print 0;
}

if (exists $a->[1]->{times}{expiration_timestamp}){
    print 1;
} else {
    print 0;
}

if (exists $a->[100]->{times}{expiration_timestamp}){
    print 1;
} else {
    print 0;
}




