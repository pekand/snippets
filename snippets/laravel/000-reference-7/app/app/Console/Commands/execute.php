<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class execute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:command1 {--option1 : Description1}  {--option2WithValue=} {--option3WithDefault=defaultValue} {--option4Array=*} {--S|shortOption} {param1 : Description2} {optionalParam2?} {optionalParam3=defaultValue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command1 description';

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
        // mesages
        $this->error('Error message');
        $this->info('Info message');
        $this->comment('Comment message');

 
        $this->line('Line mesage');
        $this->question('Question mesage');


        // table
        $headers = ['column1', 'column2'];
        $table = [
            ['value1', 'value2'],
            ['value1', 'value2'],
            ['value1', 'value2'],
        ];
        $this->table($headers, $table);

        //example command
        // php artisan execute:command1 --option1 --option2WithValue=value1 --option3WithDefault --option4Array=1 --option4Array=2 -S param1 param2 param3

        $param1 = $this->argument('param1');
        $param2 = $this->argument('optionalParam2'); // default null
        $param3 = $this->argument('optionalParam3');

        $option1 =  $this->option('option1');
        $option2 =  $this->option('option2WithValue');
        $option3 =  $this->option('option3WithDefault');
        $option4 =  $this->option('option4Array');

        $info = json_encode([
            'params' => [
                'param1' => $param1,
                'param2' => $param2,
                'param3' => $param3,
            ],
            'options' => [
                'option1' => $option1,
                'option2' => $option2,
                'option3' => $option3,
                'option4' => $option4,
            ]
        ], JSON_PRETTY_PRINT);

        $this->line($info);

        return 0; // no error  
    }
}
