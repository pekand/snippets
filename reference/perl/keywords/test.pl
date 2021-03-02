#!"c:\Apps\Strawberry\perl\bin\perl.exe"

use strict;
use warnings;

use Data::Dumper;

my(%hash) = ( 'param1' => 1, 'param2' => 'balls', 'param2' => 'balls');

#########################
sub o
{
    my($param1, %params) = @_;

    print "1:".$param1 . "\n";

    foreach my $key (keys %params) {
        print "2:".$key . " : " . $params{$key} . "\n";
    }
}

o("test", ( 'a' => 1, 'b' => 2, 'c' => 3));

o("test", ( 'a' => 1, 'b' => 2, 'c' => 3));

#########################

sub o2
{
    my $params = shift;

    $params->{key} ||= "default";

    print "3:".$$params{key}."\n";

    print "4:".$params->{key}."\n";

    foreach my $key (keys %$params) {
        print "5:".$key . " : " . $$params{$key} . "\n";
    }

    warn Dumper($params);
}


my(%hash2) = ( 'param1' => 1, 'param2' => 2, 'key' => 3);
o2(\%hash2);

o2({
    'key' => "value1",
    'key1' => "value1",
    'key2' => "value1",
});
