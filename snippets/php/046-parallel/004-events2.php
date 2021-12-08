<?php

use parallel\{Runtime, Events, Events\Event\Type, Channel};

/*

Description:

Main Thread;
1. Do somethink  10x
2. eatch time check if is some message from child thread
4. show mssage from child
5. if is count = 0 send stop mesage to child thread break 


Child Thread;
1. Do somethink
2. eatch time check if is some message from main thread
4. show mssage from main thread
5. if is stop mesage from main thread, finish tread

*/

$runtime3= new Runtime();

$channelToThread = Channel::make('channelToThread', Channel::Infinite);
$channelFromThread = Channel::make('channelFromThread', Channel::Infinite);

$future3 = $runtime3->run(function(Channel $ch3, Channel $ch4) {
    $events = new Events();

    $events->addChannel($ch3);
    //$events->setBlocking(false);
    $events->setTimeout(100000);

    while(true)
    {
        /* Your code. */
        for ($i = 0; $i < 10; $i++) {
            echo "%";
            usleep(100000);
        }

        $ch4->send(['name' => "messageToMainThread", 'value' => "message1"]);

        /* check if some message is in channell */
        try
        {
            $event = NULL;
            do
            {
                $event = $events->poll();
                if($event && $event->source == 'channelToThread')
                {
                    $events->addChannel($ch3);
                    if($event->type == Events\Event\Type::Read)
                    {
                        if(is_array($event->value) && count($event->value) > 0)
                        {
                            if($event->value['name'] == 'stop')
                            {
                                echo "\nStopping thread\n";
                                return "(future result)";
                            }
                            else
                            {
                                echo "\nMesage from main thread: ".$event->value['name']." => ".$event->value['value']."\n";
                            }
                        }
                    }
                    
                    if($event->type == Events\Event\Type::Close) { // channel was closed
                        echo "\nChannel is closed by main thread\n";
                        return "(future result)";
                    }
                }
            }
            while($event);
        }
        catch(Events\Error\Timeout $ex)
        {
            echo "Timeout\n";
        }
    }
}, [$channelToThread, $channelFromThread]);

try {
    $count = 10;
    $events = new Events();

    $events->addChannel($channelFromThread);
    //$events->setBlocking(false);
    $events->setTimeout(100000);

    register_shutdown_function ( function(){
        echo "Thread shutdown\n";
    } );

    while(true)
    {
        /* Your code. */
        for ($i = 0; $i < 10; $i++) {
            echo "@";
            usleep(100000);
        }

        $count = $count - 1;
        $channelToThread->send(['name' => "message", 'value' => "message ".$count]);

        if ($count == 0){
            $channelToThread->send(['name' => "stop", 'value' => true]);
        }

        /* check if some message is in channell */
        try
        {
            $event = NULL;
            do
            {
                $event = $events->poll();
                if($event && $event->source == 'channelFromThread')
                {
                    $events->addChannel($channelFromThread);
                    if($event->type == Events\Event\Type::Read)
                    {
                        if(is_array($event->value) && count($event->value) > 0)
                        {
                            if($event->value['name'] == 'messageToMainThread')
                            {
                                echo "\nMesage from thread: ".$event->value['name']." => ".$event->value['value']."\n";
                            }
                        }
                    }
                }
            }
            while($event);
        }
        catch(Events\Error\Timeout $ex)
        {
            echo "Timeout\n";
        }

        if ($count == 0){
            break;
        }
    }
} catch(Error $err) {
    echo "\nError:", $err->getMessage();
} catch(Exception $e) {
    echo "\nException:", $e->getMessage();
}

$channelToThread->close();
$channelFromThread->close();
#$runtime3->kill();
#$runtime3->close();

printf("Runtime3 future is %s\n", $future3->value());
