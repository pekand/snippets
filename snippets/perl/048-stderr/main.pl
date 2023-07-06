#!/usr/bin/perl

package applicationLog;

use strict;
use warnings;
use Data::Dumper;

$a = "test";
open(my $fh, '>>', 'test1.txt');print $fh Data::Dumper::Dumper($a)."\n";close $fh;
print STDERR "Could not open file\n";
