#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;


my $line1 = "[06/Sep/2021:15:54:06 +0000] 1.1.1.1 - - - server1 server1 to: 127.0.0.1:1234: GET /irl/endpoint HTTP/1.1 upstream_response_time 0.003 msec 1630943646.413 request_time 0.004";

my $regex = '(\[[^\]]+\]) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+)(.*)';

my @a = $line1 =~ /$regex/s; 

warn Data::Dumper::Dumper(\@a);



