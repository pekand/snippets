#!/usr/bin/perl

use strict;
use warnings;
use Data::Dumper;


sub Main {

    my %h = ( 
        'item1'=>'value1', 
        'item2'=>'value2', 
        'item3'=>'value3'
    );
    print scalar keys %h;

}

__PACKAGE__->Main unless caller;

1;

