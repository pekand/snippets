#!/usr/bin/perl

package Reference::subrutineParamsHash;

use strict;
use warnings;

sub o
{
    my($param1, %params) = @_;

    print "1:".$param1 . "\n";

    foreach my $key (keys %params) {
        print "2:".$key . " : " . $params{$key} . "\n";
    }
}

sub Main {
    o("test", ( 'a' => 1, 'b' => 2, 'c' => 3));
}

__PACKAGE__->Main unless caller;

1;





