#!/usr/bin/perl

package CustomException;

use strict;
use warnings;

sub new {
   my $class = shift;
   my $self = {
      _message => shift,
   };
   bless $self, $class;
   return $self;
}

sub getMessage {
    my ( $self ) = @_;
    return $self->{_message};
}

package Main;

use strict;
use warnings;
use Data::Dumper;

sub Main {
    eval {
        die CustomException->new('Something bad happened');
    };

    if ($@) {
        warn Data::Dumper::Dumper($@);
        warn $@->getMessage();
    }
}

__PACKAGE__->Main unless caller;

1;

