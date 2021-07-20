use warnings;
use strict;
use Carp;
use feature 'say';

use IO::Socket qw(AF_INET AF_UNIX SOCK_STREAM SHUT_WR SHUT_RD);
use IO::Select;
use Time::HiRes qw(usleep);

my $clientName = $ARGV[0];

my $client = IO::Socket->new(
    Domain => AF_INET,
    Type => SOCK_STREAM,
    proto => 'tcp',
    PeerPort => 8000,
    PeerHost => '127.0.0.1',
    Blocking => 0,
) || die "Can't open socket: $IO::Socket::errstr";

my $readers = IO::Select->new
    or die "Can't create the IO::Select read object";

$readers->add($client);

say "Sending header to server";
my $size = $client->send($clientName." message");
say "size = ".($size || 0);

while(1) {
   my @ready = $readers->can_read(0);
   
   foreach my $cl (@ready)
   {
      my $buffer;
      $cl->recv($buffer, 1024);
      say "Response from server '$buffer'";

      say "Sending mesage to server";
      my $size = $cl->send($clientName." message");
      say "size = ".($size || 0);
   }
   

   usleep(1000000);
}

$client->close();

#$client->shutdown(SHUT_WR);
#$client->shutdown(SHUT_RD);
