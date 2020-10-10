<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Lib\Repositories\UserRepository;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// $users is inserted by dependency injection
Artisan::command('execute:command3 {param1}', function ($param1, UserRepository $users) {
    $this->info($users->dump());
    $this->info("command1 with parameter {$param1}!");
})->purpose('Command2 description');
