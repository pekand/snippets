#!/usr/bin/perl
use strict;
use warnings;
use Carp;
use Data::Dumper;

use lib './lib';

use Package1;

print "test";

Package1::action1(1,1);
Package1::action1(2,2);
Package1::action1(3,3);
Package1::action1(2,2);
Package1::action1(2,2);


warn Data::Dumper::Dumper(Package1::items);
