#!/usr/bin/perl

package Reference::string;

use strict;
use warnings;

sub Main {
    print 'text\n';

    print "text\n";

    print " \\ \' \" \041 \x41 \$ \ua \lA  \r \n \Uabc \LABC";

    my $v_string = v77.97.114.116.105.110;
    print $v_string;

    my $integer = 200;

    my $long_text1 = <<EOF;
long text $integer \x41
EOF

print $long_text1;

    my $long_text2 = <<"EOF";
long text $integer \x41
EOF

    print $long_text2;

}

__PACKAGE__->Main unless caller;

1;

