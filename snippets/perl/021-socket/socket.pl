use warnings;
use strict;
use Carp;
use feature 'say';

use IO::Socket qw(AF_INET AF_UNIX SOCK_STREAM SHUT_WR SHUT_RD);
use IO::Select;
use Time::HiRes qw(usleep);

my $server = IO::Socket->new(
    Domain => AF_INET,
    Type => SOCK_STREAM,
    Proto => 'tcp',
    LocalHost => '127.0.0.1',
    LocalPort => 8000,
    ReusePort => 0,
    Listen => 5,
    Blocking => 0,
) || die "Can't open socket: $IO::Socket::errstr";
say "Waiting on 8000";

my $readers = IO::Select->new
    or die "Can't create the IO::Select read object";

$readers->add($server);

my $counter = 0;
my $clientsCounter = 0;

my $clients = {};

while (1) {
   my @ready = $readers->can_read(0);
   
   foreach my $so (@ready)
   {
      #new connection read
      if($so == $server)
      {
         my $newClient = $server->accept();
         my $client_address = $newClient->peerhost();
         my $client_port = $newClient->peerport();
         say "Connection from $client_address:$client_port";
   
         my $data = "";
         $newClient->recv($data, 1024);
         say "Header from client: $data";

         $data = "Header from server";
         $newClient->send($data);

         $readers->add($newClient);

         $clients->{++$clientsCounter} = $newClient;
      }
      else
      {
         my $data = "";
         $so->recv($data, 1024);
         say "Data from client: $data";
         
         $data = "Data from server";
         $so->send($data);
        
      }
   }

   #$so->shutdown(SHUT_RDWR);
   #$so->shutdown(SHUT_RD);
   #$so->shutdown(SHUT_WR);
   #$readers->remove($sock);
   #$so->close;

    print "waiting[".(++$counter)."]...\n";
    usleep(1000000);
}

$server->close();
