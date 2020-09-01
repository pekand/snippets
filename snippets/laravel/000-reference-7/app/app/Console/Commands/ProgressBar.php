<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProgressBar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display progress bar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display progress bar
     *
     * @exampe php artisan execute:progress
     * @return mixed
     */
    public function handle()
    {
        $values = ['value', 'value','value','value','value','value','value',];

        $bar = $this->output->createProgressBar(count($values));

        $bar->start();

        foreach ($values as $value) {
            //action
            sleep(1);

            $bar->advance();
        }

        $bar->finish();

        return 0;
    }
}
