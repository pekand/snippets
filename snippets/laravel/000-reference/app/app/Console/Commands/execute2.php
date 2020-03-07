<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class execute2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:command2 {param1} {params2*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command2 description';

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
     * Example of command with variable params 
     *
     * @return mixed
     */
    public function handle()
    {

        // call other command from command
        $this->call('execute:command1', [
            'param1' => 'param1',
        ]);

        // call and supres output
        $this->callSilent('execute:command1', [
            'param1' => 'param1',
        ]);

        $param1 = $this->argument('param1');
        $param2 = $this->argument('params2'); // default null

        $info = json_encode([
            'params' => [
                'param1' => $param1,
                'param2' => $param2,
            ],
        ], JSON_PRETTY_PRINT);

        $this->info($info);
    }
}
