#!/usr/bin/perl

package Reference::for;

use strict;
use warnings;

use Time::HiRes;

sub Main {
    
    for my $i (1..5)
    {
        print("$i");
        $| = 1;
        sleep(1);
    }
    
    print "\n";

    for my $i (1..5)
    {
        print("$i");
        $| = 1;
        Time::HiRes::usleep(1000000); # 1 second == 5000000 microseconds
        
    }

    print "\n";
    
    for my $i (1..5)
    {
        print("$i");

        $| = 1;

        eval {
            Time::HiRes::nanosleep(1000000000); # 1 second == 1000000000 nanoseconds
        };

        if($@){
            sleep(1);
        }
    }

    print "\n";
}


__PACKAGE__->Main unless caller;

1;




