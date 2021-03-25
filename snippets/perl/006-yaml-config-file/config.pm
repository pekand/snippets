#!/usr/bin/perl

#https://www.perl.com/article/29/2013/9/17/How-to-Load-YAML-Config-Files/

package applicationConfig;

use strict;
use warnings;
use YAML::XS 'LoadFile';
use Data::Dumper;


my $config = LoadFile('config.yaml');

print Dumper($config);

my $param1 = $config->{param1};

my $param1 = $config->{param2}->[0];
my $param2 = $config->{param2}->[1];

for my $param (@{$config->{param2}}) { 
    print $param."\n";
}

my $param3 = $config->{group1}->{param3};
my $param4 = $config->{group1}->{param4};

for (keys %{$config->{group1}}) {
    print "$_: $config->{group1}->{$_}\n";
}
