dispecing#!/usr/bin/perl

package test3;

use strict;
use warnings;

use test1;
use test2;

use Exporter;
our @ISA    = qw/ Exporter /;
our @EXPORT = qw(%cprofil);

# profil usera na centrale
my %profil = (
    "profil1"     => 0x10000,
);

sub Main {    
    print "test3\n";
}


1;





