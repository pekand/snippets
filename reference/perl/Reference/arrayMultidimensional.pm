#!/usr/bin/perl

package Reference::arrayMultidimensional;

use strict;
use warnings;

use Data::Dumper;

sub Main {
  print "#################### Print multi array\n";

  my @a1 = (
    [1, 2, 3, 4, 5, 6], 
    [7, 8, 9, 10, 11, 12],
    [13, 14, 14, 15, 16, 17]
  );

  $a1[1][1] = 100;
  $a1[1]->[1] = 101;

  for(my $i = 0; $i < @a1; $i++) 
  {    
     for(my $j = 0; $j < @{$a1[$i]}; $j++) 
     {   
        print "$a1[$i][$j] ";   
     }   
     print "\n";   
  }   

  print "#################### Print multi array\n";

  my $a2 = [
    [1, 2, 3, 4, 5, 6], 
    [7, 8, 9, 10, 11, 12],
    [13, 14, 14, 15, 16, 17]
  ];


  $a2->[1]->[1] = 101;
  $$a2[1][1] = 102;

  for(my $i = 0; $i < @$a2; $i++)
  {    
     for(my $j = 0; $j < @{$$a2[$i]}; $j++) 
     {   
        print "".$$a2[$i][$j]." ";   
     }   
     print "\n";   
  }  

  print "#################### Print multi array\n";

  my $a3 = [
    [1, 2, 3, 4, 5, 6], 
    [7, 8, 9, 10, 11, 12],
    [13, 14, 14, 15, 16, 17]
  ];

  my @a = @$a3;
  for(my $i = 0; $i < @a; $i++)
  {
     my @row = @{$a[$i]};
     for(my $j = 0; $j < @row; $j++)
     {
        print $row[$j]." ";   
     }
     print "\n";   
  }  

  print "#################### Print multi array foreach\n";

  my @a4 = (
    [1, 2, 3, 4, 5, 6], 
    [7, 8, 9, 10, 11, 12],
    [13, 14, 14, 15, 16, 17]
  );

  for my $row (@a4) {
      for my $value (@$row) {
          print $value." "; 
      }
      print "\n"; 
  }

  foreach my $row (@a4) {
      foreach my $value (@$row) {
          print $value." "; 
      }
      print "\n"; 
  }

  print "#################### Print multi array foreach\n";

  my $a4 = [
    [1, 2, 3, 4, 5, 6], 
    [7, 8, 9, 10, 11, 12],
    [13, 14, 14, 15, 16, 17]
  ];

  for my $row (@$a4) {
      for my $value (@$row) {
        print $value." "; 
    }
    print "\n";   
  } 

  foreach my $row (@$a4) {
      foreach my $value (@$row) {
        print $value." "; 
    }
    print "\n";   
  } 
}

__PACKAGE__->Main unless caller;

1;


