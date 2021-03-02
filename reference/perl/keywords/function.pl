#!"c:\Apps\Strawberry\perl\bin\perl.exe"

use strict;
use warnings;

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
}

o2({
    'key' => "value1",
    'key1' => "value1",
    'key2' => "value1",
});
