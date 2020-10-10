<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Logging extends Controller
{
    public function main(Request $request)
    {
        $message = "Message";

        Log::debug($message); // dev information
        Log::info($message); // normal information
        Log::notice($message); // more important event
        Log::warning($message); // this may be eror in future
        Log::error($message); // somethinks go wrong      
        Log::critical($message); // part of aplication is not available
        Log::alert($message); // immediate action should be exercised       
        Log::emergency($message); // system is unusable

        //Contextual Information

        Log::info("Contextual Information", [
            'extrainfo' => 'value',
        ]);

        // Writing To Specific Channel
        Log::channel('custom')->info('info message');

        // Writing To multiple Channels
        Log::stack(['single', 'custom'])->info('info message');

    }
}
