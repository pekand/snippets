
use strict;
use warnings;

use lib '.';

use Reference::hash;
use Reference::integer;
use Reference::integer;
use Reference::reference;
use Reference::scalars;
use Reference::string;
use Reference::subrutine;
use Reference::subrutineParamsHash;
use Reference::subrutineParameters;
use Reference::subrutineParamsHash2;
use Reference::arrayMultidimensional;
use Reference::comments;
use Reference::defaultVariable;
use Reference::dump;
use Reference::for;
#use Subrutines::localtime;

sub Reference {
    Reference::hash::Main;
    Reference::integer::Main;
    Reference::integer::Main;
    Reference::reference::Main;
    Reference::scalars::Main;
    Reference::string::Main;
    Reference::subrutine::Main;
    Reference::subrutineParamsHash::Main;
    Reference::subrutineParameters::Main;
    Reference::subrutineParamsHash2::Main;
    Reference::arrayMultidimensional::Main;
    Reference::comments::Main;
    Reference::defaultVariable::Main;
    Reference::dump::Main;
    Reference::for::Main;
}

sub Subrutines {
    #Subrutines::localtime::Main;
};

sub Main {
    Reference();
    Subrutines();


};

Main;


1;
