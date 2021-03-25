#!/usr/bin/perl

package Reference::subrutine;

use strict;
use warnings;

sub l {
    print "<br>\n";
}

sub h {
    my ( $header ) = @_ || "default";;
    print "<h1>$header</h1>\n";
}

sub Main {
    h("header");

    l();
}

__PACKAGE__->Main unless caller;

1;
