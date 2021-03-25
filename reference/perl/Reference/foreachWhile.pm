#!/usr/bin/perl

package Reference::foreachWhile;

use strict;
use warnings;

sub o
{
    my $params = shift;

    $params->{key} ||= "default";

    while (my ($key, $value) = each(%$params))
    {
      print "$key => $value\n";
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
