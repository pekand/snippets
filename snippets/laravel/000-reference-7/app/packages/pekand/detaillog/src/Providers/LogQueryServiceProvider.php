<?php

namespace Pekand\DetailLog\Providers;


use Illuminate\Support\ServiceProvider;
use Pekand\DetailLog\Services\DetailLog;

class LogQueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(DetailLog $detailLog)
    {       
        $detailLog->logQueryBoot();
    }
}
