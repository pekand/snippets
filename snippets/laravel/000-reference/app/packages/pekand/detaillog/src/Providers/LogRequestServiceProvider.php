<?php

namespace Pekand\DetailLog\Providers;

use Illuminate\Support\ServiceProvider;
use Pekand\DetailLog\Services\DetailLog;

class LogRequestServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(DetailLog $detailLog)
    {
        $detailLog->logRequestBoot();
    }
}
