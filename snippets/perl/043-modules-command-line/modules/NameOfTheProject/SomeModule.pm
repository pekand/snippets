package NameOfTheProject::SomeModule;

use strict;
use warnings;
require Exporter;
our @ISA = qw(Exporter);
our @EXPORT_OK = qw(some_function);

sub some_function {
    return 123;
}

1;
