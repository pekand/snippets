<?php

use parallel\{Runtime, Events, Events\Event\Type, Channel};


$runtime3= new Runtime();

$channel3 = Channel::make('myChannel', Channel::Infinite);

$future3 = $runtime3->run(function(Channel $ch) {
    $events = new Events();

    $events->addChannel($ch);
    //$events->setBlocking(false);
    $events->setTimeout(100000);

    while(true)
    {
        /* Your code. */
        for ($i = 0; $i < 10; $i++) {
            echo "%";
            usleep(100000);
        }

        /* check if some message is in channell */
        try
        {
            $event = NULL;
            do
            {
                $event = $events->poll();
                if($event && $event->source == 'myChannel')
                {
                    $events->addChannel($ch);
                    if($event->type == Events\Event\Type::Read)
                    {
                        if(is_array($event->value) && count($event->value) > 0)
                        {
                            if($event->value['name'] == 'stop')
                            {
                                echo "\nStopping thread\n";
                                return "done";
                            }
                            else
                            {
                                echo "\nMesage from main thread: ".$event->value['name']." => ".$event->value['value']."\n";
                            }
                        }
                    }
                    
                    if($event->type == Events\Event\Type::Close) { // channel was closed
                        echo "\nChannel is closed\n";
                        return "closed";
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
}, [$channel3]);

try {
    $count = 10;
    while ($count--) {
        echo "\ncount = $count \n";
        $channel3->send(['name' => "message", 'value' => "message1"]);
        usleep(1000000);
    }

    $channel3->send(['name' => "stop", 'value' => true]);

    $channel3->close();
    
} catch(Error $err) {
    echo "\nError:", $err->getMessage();
} catch(Exception $e) {
    echo "\nException:", $e->getMessage();
}


printf("Runtime3 future is %s\n", $future3->value());
