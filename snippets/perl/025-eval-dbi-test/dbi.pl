#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;
use DBI;
use  Data::Dumper;


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


sub getTableItem {
    my $id = shift;

    my $row;

    my $sth = DBConnect->prepare("SELECT MAX(*) FROM materialy WHERE id = ?");

    eval {
        
        $sth->execute(($id)) or die $DBI::errstr;

        
       $row = $sth->fetchrow_hashref();

        
    };

    print Data::Dumper::Dumper($row);
    print Data::Dumper::Dumper($row->{id});
    print Data::Dumper::Dumper(!defined($row) ? 1 : 0);
    print Data::Dumper::Dumper(!defined($row->{id}) ? 1 : 0);
    print Data::Dumper::Dumper(exists($row->{id}) ? 1 : 0);

        $sth->finish();

    if ($@ || ! defined $row->{'id'}) {
        return 0;
    }

    return 1;
}

print Data::Dumper::Dumper(getTableItem(10) ? 1 : 0);



1;
