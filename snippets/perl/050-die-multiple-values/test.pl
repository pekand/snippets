
use strict;
use warnings;
use v5.10.1;

sub risky_operation {
    my ($param) = @_;
    unless (defined $param) {
        my $error_info = { code => 124, message => "Missing parameter" };
        die $error_info;  # Passing a reference to a hash
    }
    # ... do some risky stuff ...
}

eval {
    risky_operation();
};
if ($@) {
    my $error_info = $@;
    if (ref $error_info eq 'HASH') {
        print "Caught an exception with code $error_info->{code}, message: $error_info->{message}\n";
    } else {
        print "Caught an exception: $@\n";
    }
}