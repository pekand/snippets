#!/usr/bin/perl

package Reference::subrutineParamsHash2;

use strict;
use warnings;

sub o
{
    my $params = shift;

    $params->{key} ||= "default";

    print "3:".$$params{key}."\n";

    print "4:".$params->{key}."\n";

    foreach my $key (keys %$params) {
        print "5:".$key . " : " . $$params{$key} . "\n";
    }
}

sub Main {
    my %hash2 = ( 'param1' => 1, 'param2' => 2, 'key' => 3);

    o(\%hash2);

    o({
        'key' => "value1",
        'key1' => "value1",
        'key2' => "value1",
    });
}

__PACKAGE__->Main unless caller;

1;





