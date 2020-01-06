<?php

echo "<pre>";

// A function called on each tick event (code may be optimalized)
function tick_handler()
{
    echo "called\n";
}

register_tick_function('tick_handler');

declare(ticks=1) {
    $a = 1;

    if ($a > 0) {
        $a += 2;
    }
}

unregister_tick_function('tick_handler');
