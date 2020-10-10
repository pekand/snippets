<?php

namespace Pekand\DetailLog\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Http\Kernel;
use Pekand\DetailLog\Middleware\LogRequestMiddleware;
use Pekand\DetailLog\Session\CustomSessionHandler;
use Pekand\DetailLog\Cache\CustomCacheStore;
use Pekand\DetailLog\Listeners\CacheEventSubscriber;

class DetailLog
{

    public function uidBoot()
    {
        $requestUid = Str::uuid()->toString();

        config([
            'requestUid' => $requestUid
        ]);
    }

    public function logRequestBoot()
    {
        App::make(Kernel::class)->pushMiddleware(LogRequestMiddleware::class);
    }

    public function logQueryBoot()
    {
        DB::listen(function ($query) {
            Log::channel('query')->info("Query", [
                'requestUid' => config('requestUid', null),
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time,
            ]);
        });
    }

    public function logEventBoot()
    {
        Event::listen('*', function ($eventName, array $data) {   
            // skip log event (prevent infinite loop)
            if($eventName === 'Illuminate\Log\Events\MessageLogged'){
                return;
            }

            Log::channel('events')->info("Event", [
                'requestUid' => config('requestUid'),
                'eventName' => $eventName,
            ]);

        });
    }

    public function sessionBoot(\Illuminate\Container\Container $container, \Illuminate\Http\Request $request)
    {
        Session::extend('detaillog', function ($app) use ($container, $request) {
            $connection = $container->make('db')->connection(config('session.connection'));
            $table = config('session.table');
            $lifetime = config('session.lifetime');
            return new CustomSessionHandler($connection, $table, $lifetime, $container, $request);
        });
    }

    public function cacheBoot(\Illuminate\Container\Container $container)
    {
        Cache::extend('detaillog', function ($app) use ($container) {
            $connection = $container->make('db')->connection(config('session.connection'));
            $store = config('cache.stores');
            $prefix = config('cache.prefix');
            return Cache::repository(new CustomCacheStore($connection, $store['detaillog']['table'], $prefix));
        });

        Event::subscribe(CacheEventSubscriber::class);
    }
}
