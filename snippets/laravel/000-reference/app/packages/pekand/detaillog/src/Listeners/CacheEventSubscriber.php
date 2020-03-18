<?php

namespace Pekand\DetailLog\Listeners;

use Illuminate\Support\Facades\Log;

class CacheEventSubscriber
{
    public function cacheHit($event) {
        Log::channel('cache')->info("Event: cacheHit", []);
    }

    public function cacheMissed($event) {
        Log::channel('cache')->info("Event: cacheMissed", []);
    }

    public function keyForgotten($event) {
        Log::channel('cache')->info("Event: keyForgotten", []);
    }

    public function keyWritten($event) {
        Log::channel('cache')->info("Event: keyWritten", []);
    }

    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Cache\Events\CacheHit',
            'Pekand\DetailLog\Listeners\CacheEventSubscriber@cacheHit'
        );

        $events->listen(
            'Illuminate\Cache\Events\CacheMissed',
            'Pekand\DetailLog\Listeners\CacheEventSubscriber@cacheMissed'
        );

        $events->listen(
            'Illuminate\Cache\Events\KeyForgotten',
            'Pekand\DetailLog\Listeners\CacheEventSubscriber@keyForgotten'
        );

        $events->listen(
            'Illuminate\Cache\Events\KeyWritten',
            'Pekand\DetailLog\Listeners\CacheEventSubscriber@keyWritten'
        );
    }
}
