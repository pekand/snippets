#!/usr/bin/perl

package applicationLog;

use strict;
use warnings;

use constant APPLICATION_LOG_PATH => "application.log"; 

sub getTimestamp {
    use DateTime;
    use DateTime::TimeZone;
    
    my $time = localtime;
    my $dt = DateTime->now(); 
    $dt->set_time_zone('UTC');
    return $dt->rfc3339;
}

sub applicationLog {
    use Fcntl ':flock';
     
    my ($message) = @_;
    $message = getTimestamp()." ".$message."\n";
    open(my $fd, ">>", APPLICATION_LOG_PATH);
    flock($fd, LOCK_EX);
    print $fd  $message;
    close($fd);
} 

applicationLog("message");





