#!"c:\Apps\Strawberry\perl\bin\perl.exe"
use strict;
use warnings;

use Path::Tiny;

use FindBin qw($Bin);

##################### CREATE DIRECTORY

mkdir("foo", 0700);
chdir("foo") or die "can't chdir\n";

mkdir("bar", 0700);
chdir("bar") or die "can't chdir\n";

##################### WRITE FILE 
{
    open my $fh, '>', 'output.txt';
    print {$fh} "text\n";
    close $fh;
}

##################### READ FILE
{
    open my $fh, '<', 'output.txt';
    my ($text) = <$fh>;
    print $text;
    close $fh;
}



##################### READ FILE

use File::Slurp;
my $text = read_file('output.txt');

print $text;

##################### change dir

chdir("../..") or die "can't chdir\n";

##################### LIST DIRECTORY

my $dir = path('foo','bar');

my $iter = $dir->iterator;
while (my $file = $iter->()) {
    
    next if $file->is_dir();
    
    print "$file\n";
}

##################### LIST DIRECTORY

my @files = glob(".".'*');
for my $file (@files)
{
    if($file eq "." || $file eq "..") {
        next;
    }

    print $file."\n";
}

#####################

rmdir("foo") or print "can't delete '$!' \n";

#####################

chdir("foo/bar") or die "can't chdir\n";

if(-e "output.txt") 
{
    unlink("output.txt");
}

chdir("..") or die "can't chdir\n";

if(-e "bar") 
{
    rmdir("bar");
}

#####################

chdir("..") or die "can't chdir\n";

use File::Path qw(rmtree);
rmtree("foo") or print "can't delete '$!' \n";

