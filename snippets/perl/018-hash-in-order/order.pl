#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;
my $t = {
    2 => 2,
    1 => 1,
    3 => 3,
    5 => 5,
    4 => 4,
    6 => 6
};

print Data::Dumper::Dumper($t);

#compare as integer
for my $key (sort { $a <=> $b } keys %$t) {
    print $t->{$key}." ";
}

my $t2 = {
    "a1" => 2,
    "a2" => 1,
    "b1" => 3,
    5 => 5,
    "b2" => 4,
    6 => 6
};

print Data::Dumper::Dumper($t2);

#compare as string
for my $key (sort { $a cmp $b } keys %$t2) {
    print $t2->{$key}." ";
}
