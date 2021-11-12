#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

my $data = undef;


### 1. is undef
### 2. is undef
### 3. is undef
### 4. is not undef
### 5. is undef
### 6. is not undef
### 7. is undef
### 8. is not undef


# 1. is undef

if(!$data) {
    print "1. is undef\n";
} else {
    print "1. is not undef\n";
}

# 2. is undef

if(defined $data) {
    print "2. is not undef\n";
} else {
    print "2. is undef\n";
}

# 2. is undef

if(!defined $data) {
     print "2. is undef\n";
} else {
    print "2. is not undef\n";
}

my $data1 = {
    a=>undef,
    b=>123
};

# 3. is undef

if(!$data1->{a}) {
    print "3. is undef\n";
} else {
    print "3. is not undef\n";
}

# 4. is not undef

if(!$data1->{b}) {
    print "4. is undef\n";
} else {
    print "4. is not undef\n";
}

# 5. is undef


if(defined $data1->{a}) {
    print "5. is not undef\n";
} else {
    print "5. is undef\n";
}

# 6. is not undef


if(defined $data1->{b}) {
    print "6. is not undef\n";
} else {
    print "6. is undef\n";
}

# 7. is undef

if(!defined $data1->{a}) {
    print "7. is undef\n";
} else {
    print "7. is not undef\n";
}

# 8. is not undef

if(!defined $data1->{b}) {
    print "8. is undef\n";
} else {
    print "8. is not undef\n";
}
