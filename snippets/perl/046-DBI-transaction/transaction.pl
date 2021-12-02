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
    my $password = "";

    $db = DBI->connect($dsn, $userid, $password ) or die $DBI::errstr;
} 

sub createTable {
    my $sth = DBConnect->prepare("CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(256) NOT NULL,
      `email` varchar(256) NOT NULL,
      `password` varchar(256) NOT NULL,
      PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");
    $sth->execute() or die $DBI::errstr;
    
    #$sth = DBConnect->prepare("ALTER TABLE `users` ADD PRIMARY KEY (`id`);");
    #$sth->execute() or die $DBI::errstr;
 
    #$sth = DBConnect->prepare("ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    #$sth->execute() or die $DBI::errstr;

    $sth->finish();
}

sub dropTable {
    my $sth = DBConnect->prepare("DROP TABLE IF EXISTS `users`");
    $sth->execute() or die $DBI::errstr;
    $sth->finish();
}

sub getTable {
    my $sth = DBConnect->prepare("SELECT * FROM users");
    $sth->execute() or die $DBI::errstr;
    
    while (my @row = $sth->fetchrow_array()) {
       print join(" ", @row)."\n";
    }

    $sth->finish();
}

sub testTransaction {
    my $dbh = DBConnect();

    $dbh->{AutoCommit} = 0; # enable transactions
    $dbh->{RaiseError} = 1; # die( ) if a query has problems

    my $records = [
        [1, "admin", 'admin@email.com', "password"]
    ];

    eval {
        my $values = "( ".(@$records > 0 ? join ", ", (join ", ", ("?") x @{@$records[0]}) x @$records : '()')." )";
        my $query  = "INSERT INTO users (id, name, email, password) VALUES $values";
        print "QUERY: $query\n";
        my $sth = $dbh->prepare($query);
        $sth->execute(map { @$_ } @$records);
        
    };

    if ($@) {
      warn "Transaction aborted: $@";
      eval { $dbh->rollback( ) };
    } else {
        $dbh->commit();
    }
}

DBConnect();
#dropTable();
createTable();
testTransaction();
getTable();


1;
