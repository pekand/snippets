#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;
use DBI;
use Data::Dumper;


sub foo {
  return (1, "test", 3);
}

my (,,$x) = foo();

print "x = $x\n";

my ($a, $b, $c) = foo();

print "a = $a, b = $b, c = $c\n";

#print Data::Dumper::Dumper(getTableItem(10) ? 1 : 0);



1;
