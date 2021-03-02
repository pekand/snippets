#!"c:\Apps\Strawberry\perl\bin\perl.exe"

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

o({
    'key' => "value1",
    'key1' => "value1",
    'key2' => "value1",
});
