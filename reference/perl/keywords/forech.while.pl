#!"c:\Apps\Strawberry\perl\bin\perl.exe"

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

o({
    'key' => "value1",
    'key1' => "value1",
    'key2' => "value1",
});
