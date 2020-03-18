<?php

namespace Pekand\DetailLog\Providers;

use Illuminate\Support\ServiceProvider;
use Pekand\DetailLog\Services\DetailLog;

class UidServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(DetailLog $detailLog)
    {
        $detailLog->uidBoot();
    }
}
