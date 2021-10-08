#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

my $d = undef;

if (defined $d->[0]{test}) { #nieje
    print "je ";
} else {
    print "nieje ";
}

my $e = [];

if (defined $e->[0]{test}) { #nieje
    print "je ";
} else {
    print "nieje ";
}

my $a = [{test=>undef}];

if (defined $a->[0]{test}) { #nieje
    print "je ";
} else {
    print "nieje ";
}

my $b = [{test=>0}];

if (defined $b->[0]{test}) { #je
    print "je ";
} else {
    print "nieje ";
}

my $c = [{test=>1}];

if (defined $c->[0]{test}) { #je
    print "je ";
} else {
    print "nieje ";
}
