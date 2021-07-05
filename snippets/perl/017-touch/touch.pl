#!/usr/bin/perl
use strict;
use warnings;
use Carp;

use IO::File;
use File::stat;

sub touch_file {

    my $file = shift;

    if ( -e $file ) {
        utime undef, undef, ($file) or croak "Couldn't touch $file: $!";
    } else {
        my $SYSOPEN_MODE = O_WRONLY|O_CREAT;
        eval {
            $SYSOPEN_MODE |= O_NONBLOCK;
        };
        sysopen my $fh,$file, $SYSOPEN_MODE or croak("Can't create $file : $!");
        close $fh or croak("Can't close $file : $!");
    }

    my $sb = stat($file) or croak("Could not stat $file: $!");
    return $sb->mtime || 0;
}

eval {
    touch_file("test.txt")
};

if($@) {
    print $@;
}







