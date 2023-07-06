
use strict;
use warnings;
use Data::Dumper;

use lib './lib1';
use lib './lib2';
use lib './lib3';

use test3;



sub Main {
	warn Data::Dumper::Dumper($test3::profil{"profil1"});
    test1::Main();
    test2::Main();
    test3::Main();
};

Main;


1;
