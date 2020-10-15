<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class Commands extends Controller
{
    public function main(Request $request)
    {

        $command1 = 'execute:command1 --option1 --option2WithValue=value1 --option3WithDefault --option4Array=1 --option4Array=2 -S param1 param2 param3';
        $exitCode1 = Artisan::call($command1);
        $output1 = Artisan::output();

        $command2 = 'execute:command1';
        $exitCode2 = Artisan::call($command2, [
            '--option1' => true,
            '--option2WithValue' => 'default',
            '--option3WithDefault' => null,
            '--option4Array' => [1, 2, 3],
            '-S' => true,
            'param1' => 'param1',
            'optionalParam2' => 'param2',
            'optionalParam3' => 'param3',
        ]);
        $output2 = Artisan::output();

        $command3 = "list";
        $exitCode3 = Artisan::call($command3, []);
        $output3 = Artisan::output();


        return [
            ['command'=>$command1,'exitCode'=>$exitCode1,'output'=>$output1,'note'=>'not existing command'],
            ['command'=>$command2,'exitCode'=>$exitCode2,'output'=>$output2,'note'=>'not existing command'],
            ['command'=>$command3,'exitCode'=>$exitCode3,'output'=>$output3,'note'=>'atisan list'],
        ];
    }
}
