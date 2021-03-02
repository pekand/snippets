#!"c:\Apps\Strawberry\perl\bin\perl.exe"

use strict;
use warnings;

use lib './modules';
use NameOfTheProject::SomeModule;

print "Content-type: text/html; charset=utf-8\n\n";

sub l {
    print "<br>\n";
}

sub h {
    my ( $header ) = @_ || "default";;
    print "<h1>$header</h1>\n";
}

h("comments");

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

h("scalars");

my $hexa = 0xff;
my $octal = 0377;
my $integer = 200;
my $negative = -300;
my $floating = 200.340;
my $bigfloat = -1.2E-23;


h("text");

print 'text\n';

print "text\n";

print " \\ \' \" \041 \x41 \$ \ua \lA  \r \n \Uabc \LABC";

my $v_string = v77.97.114.116.105.110;
print $v_string;

l();

my $long_text1 = <<EOF;
long text $integer \x41
EOF

print $long_text1;

my $long_text2 = <<"EOF";
long text $integer \x41
EOF

print $long_text2;


my $i = 5;
$i++;
print "a", "b", "c", $i;

l();


print "i=$i";

l();

print $i + "1";

l();

print $i . "1";

l();

my @a1 = (1, 2, 3, 4, 5, 6);
$a1[0] = 7;
print $a1[0]."\n";

my $size = @a1;
print "item count: $size\n";

l();

#hash
my %data = ('item1', 'value1', 'item2', 'value2', 'item3', 'value3');
print "\$data{'item1'} = $data{'item1'}\n";

l();



for $i (1, 2, 3, 4, 5) {
    print "$i ";
}

l();

print NameOfTheProject::SomeModule::some_function();
