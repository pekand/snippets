use DateTime;

use DateTime::Format::Strptime;

my $parser = DateTime::Format::Strptime->new(
  pattern => '%B %d, %Y %I:%M %p %Z',
  on_error => 'croak',
);

my $dt = $parser->parse_datetime('October 28, 2030 9:00 PM PDT');

print $dt->iso8601 . " ";
print DateTime->now->iso8601 . " ";

print " compare=".DateTime->compare( DateTime->now, $dt )

# DateTime->compare( $dt1, $dt2 );
# -1 if $dt1 < $dt2, 
#  0 if $dt1 == $dt2, 
#  1 if $dt1 > $dt2
