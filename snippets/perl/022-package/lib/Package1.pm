package Package1;

use strict;
use warnings;
use Carp;
use Data::Dumper;


my $items = {};

sub action1 {
    my $id = shift;
    my $value = shift;

    if (defined $items->{$id} && defined  $items->{$id}{value}) {
        print "\nfrom cache ". $items->{$id}{value} ;
    }

    $items->{$id}{value} = $value;

    print "\nadd to cache ".$items->{$id}{value};    
}

1;



