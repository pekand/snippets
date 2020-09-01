<?php

namespace Pekand\DetailLog\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class LogEventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(DetailLog $detailLog)
    {
        $detailLog->logEventBoot();
    }
}
