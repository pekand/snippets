#!"c:\Apps\Strawberry\perl\bin\perl.exe"
use strict;
use warnings;

use Spreadsheet::Read;

my $workbook = ReadData ("test.xls");
print $workbook->[1]{A1} . "\n";
