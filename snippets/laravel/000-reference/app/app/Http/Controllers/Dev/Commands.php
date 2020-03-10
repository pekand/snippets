<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class Commands extends Controller
{
    public function main(Request $request)
    {

        $exitCode1 = Artisan::call('execute:command1 --option1 --option2WithValue=value1 --option3WithDefault --option4Array=1 --option4Array=2 -S param1 param2 param3');

        $exitCode2 = Artisan::call('execute:command1', [
            '--option1' => true,
            '--option2WithValue' => 'default',
            '--option3WithDefault' => null,
            '--option4Array' => [1, 2, 3],
            '-S' => true,
            'param1' => 'param1',
            'optionalParam2' => 'param2',
            'optionalParam3' => 'param3',
        ]);

        $output = Artisan::output();

        return [
            'exitCode1' => $exitCode1,
            'exitCode2' => $exitCode2,
            'output' => $output,
        ];
    }
}
