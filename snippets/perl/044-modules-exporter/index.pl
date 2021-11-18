#!/usr/bin/perl

use strict;
use warnings;

use lib './modules';
use NameOfTheProject::SomeModule qw(some_function);

# export function from module => no prefix is reqired
# https://perldoc.perl.org/Exporter
print NameOfTheProject::SomeModule::some_function();
print some_function();
