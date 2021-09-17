#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

my $data = undef;

if(!$data) {
    print "is undef\n";
} else {
    print "is not undef\n";
}

if(defined $data) {
    print "is not undef\n";
} else {
    print "is undef\n";
}

my $data1 = {
    a=>undef,
    b=>123
};

if(!$data1->{a}) {
    print "is undef\n";
} else {
    print "is not undef\n";
}

if(!$data1->{b}) {
    print "is undef\n";
} else {
    print "is not undef\n";
}

if(defined $data1->{a}) {
    print "is not undef\n";
} else {
    print "is undef\n";
}

if(defined $data1->{b}) {
    print "is not undef\n";
} else {
    print "is undef\n";
}

if(!defined $data1->{a}) {
    print "is undef\n";
} else {
    print "is not undef\n";
}

if(!defined $data1->{b}) {
    print "is undef\n";
} else {
    print "is not undef\n";
}
