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

sub getTable {
    my $sth = DBConnect->prepare("SELECT * FROM materialy");
    $sth->execute() or die $DBI::errstr;
    
    while (my @row = $sth->fetchrow_array()) {
       print join(" ", @row)."\n";
    }

    $sth->finish();
}



1;
