#!/usr/bin/perl

package Reference::foreach;

use strict;
use warnings;

sub o
{
    my $params = shift;

    $params->{key} ||= "default";

    foreach my $key (keys %$params) {
        print "$key => $$params{$key}\n";
    }
}

sub Main {
    o({
        'key' => "value1",
        'key1' => "value1",
        'key2' => "value1",
    });
}

__PACKAGE__->Main unless caller;

1;




