<?php

use parallel\{Runtime, Channel};

$runtime1 = new Runtime();
$runtime2= new Runtime();

$channel = new Channel;

$future = $runtime1->run(function(Channel $ch){
    for ($i = 0; $i < 20; $i++) {
        echo "*";
        usleep(100000);
    }

    $ch->send("done");

    return "easy1";
}, [$channel]);

$future2 = $runtime2->run(function(Channel $ch){
    for ($i = 0; $i < 20; $i++) {
        echo "@";
        usleep(100000);
    }

    $ch->send("done");

    return "easy2";
}, [$channel]);

try {
    $done_count = 0;
    for ($i = 0; $i < 100; $i++) {
        $channelMessage=$channel->recv();

        echo "\nChannel mesage: $channelMessage\n";

        if ($channelMessage == "done"){
            $done_count = $done_count + 1;
        }

        if ($done_count == 2) {
            echo "All done\n";
            break;
        }
        
    }

    $channel->close();
    
} catch(Error $err) {
    echo "\nError:", $err->getMessage();
} catch(Exception $e) {
    echo "\nException:", $e->getMessage();
}

printf("Runtime1 future is %s\n", $future->value());
printf("Runtime2 future is is %s\n", $future2->value());
