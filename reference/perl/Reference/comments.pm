#!/usr/bin/perl

package Reference::comments;

sub Main {
# comment

=for comment
block comment
=cut

=begin comment
block comment
=cut

=pod
block comment
=cut
}

__PACKAGE__->Main unless caller;

1;


