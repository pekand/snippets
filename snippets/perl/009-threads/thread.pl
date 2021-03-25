#!/usr/bin/perl

package Example::Template;

use strict;
use warnings FATAL => 'all';
use Data::Dumper;

use threads;
use threads::shared qw(shared_clone);

my $share = shared_clone({
    thread1 => 0,
    thread2 => 0,
    thread3 => 0,
});

sub worker1 {
    while(1){
        $share->{thread1}++;
        print "Thread1 running...\n\n";
        sleep(1);
    }
}

sub worker2 {
    while(1){
        $share->{thread2}++;
        print "Thread2 running...\n\n";
        sleep(1);
    }
}

sub worker3 {
    while(1){
        $share->{thread3}++;
        print "Thread3 running...\n\n";
        sleep(1);
    }
}


sub Main {
    my $thr1 = threads->create(\&worker1);
    $thr1->detach();

    my $thr2 = threads->create(\&worker2);
    $thr2->detach();

    my $thr3 = threads->create(\&worker3);
    $thr3->detach();

    while(1){
        for my $key (keys %$share) {
            print "$key = ".$share->{$key}."\n";
        }
        print "main...\n\n";
        sleep(2);
    };
}

__PACKAGE__->Main unless caller;

1;
