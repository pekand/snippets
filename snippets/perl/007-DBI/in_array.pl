#!/usr/bin/perl

package Application::Database;

use strict;
use warnings;
use DBI;

my $db = 0;

sub DBConnect {
    
    if($db != 0){
        return $db;
    }

    my $driver = "mysql"; 
    my $database = "test";
    my $dsn = "DBI:mysql:database=test;host=127.0.0.1;port=3306";
    my $userid = "root";
    my $password = "root";

    $db = DBI->connect($dsn, $userid, $password ) or die $DBI::errstr;
} 

sub qm_list {
    my ( $cnt, $times ) = @_;

    my $qs = $cnt ? '(' . substr( ',?' x $cnt, 1 ) . ')' : '()';
    return $qs if not $times or $times < 2;
    return substr( ",$qs" x $times, 1 );
}

sub getTable {
    my $ids = [1,2];
    my $sth = DBConnect->prepare("SELECT * FROM materialy WHERE id in ".qm_list(scalar(@$ids)));
    $sth->execute(@$ids);
    print "\nerror=".($DBI::errstr || '');
    print "\nquery=".$sth->{Statement};
    print "\n";

    while (my @row = $sth->fetchrow_array()) {
       print join(" ", @row)."\n";
    }

    $sth->finish();
}

getTable();

1;
