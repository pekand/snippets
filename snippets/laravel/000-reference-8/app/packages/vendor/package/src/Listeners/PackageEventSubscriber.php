<?php

namespace Vendor\Package\Listeners;

class PackageEventSubscriber
{
    /**
     * Handle new ticket event
     */
    public function handlePackageEvent($event) {
        echo "PackageEvent message: ".$event->message."<br>\n";
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Vendor\Package\Events\PackageEvent',
            'Vendor\Package\Listeners\PackageEventSubscriber@handlePackageEvent'
        );
    }
}
