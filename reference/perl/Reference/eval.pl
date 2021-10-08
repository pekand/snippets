#!/usr/bin/perl

package Reference::eval;

use strict;
use warnings;

sub Main {
	eval {
		die("Error message");
	};

	if ($@) {
		warn "Error: $@\n";
	}
}

__PACKAGE__->Main unless caller;

1;


