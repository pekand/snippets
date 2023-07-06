#!/usr/bin/perl

package main2;

use strict;
use warnings;
use Data::Dumper;


*OLD_STDOUT = *STDOUT;
*OLD_STDERR = *STDERR;

# reassign STDOUT, STDERR
open my $log_fh, '>>', 'the-log-file.log';
*STDOUT = $log_fh;
*STDERR = $log_fh;

print STDERR "Could not open file\n";

# done, restore STDOUT/STDERR
*STDOUT = *OLD_STDOUT;
*STDERR = *OLD_STDERR;