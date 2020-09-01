<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Prompts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:prompts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Examples of prompt';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $param = $this->ask('Prompt varaible');
        $this->info($param);

        $password = $this->secret('Prompt password');
        $this->info($password);

        if ($this->confirm('Do you wish to continue?')) {
            $this->info("action1");
        }

        $param = $this->anticipate('Autocomplete variable', ['option1', 'option2']);
        $this->info($param);

        $choice = $this->choice('Choice', ['option1', 'option2'], $defaultIndex = 1);
        $this->info($choice);

        $choice = $this->choice(
            'Choice',
            ['option1', 'option2'],
            $defaultIndex = 1,
            $maxAttempts = null,
            $allowMultipleSelections = false
        );

        $this->info($choice);

        return 0;
    }
}
