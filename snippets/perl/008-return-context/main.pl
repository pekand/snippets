#!/usr/bin/perl

use strict;
use warnings;

use Want qw(want);
 
sub func {
    if (want('VOID')) {
        print 'VOID ';
        return;
    }
    if (want('ARRAY')) {
        print 'ARRAY ';
        return [];
    }
    if (want('HASH')) {
        print 'HASH ';
        return {};
    }
    if (want('LIST')) {
        print 'LIST ';
        return;
    }
    if (want('CODE')) {
        print 'CODE ';
        return sub { print 'hi ' };
    }
    if (want('SCALAR')) {
        print 'SCALAR ';
        return '';
    }
 
    die 'OTHER';
    return;
}
 
func();                 # VOID
my @x = func();         # LIST
my $z = func();         # SCALAR
my $y = func()->[0];    # ARRAY
my $q = func()->{name}; # HASH
func()->();             # CODE hi
 
 
print func();           # LIST
scalar func();          # SCALAR
my %h = (
    result => func(),   # LIST  Odd number of elements in hash assignment
);
