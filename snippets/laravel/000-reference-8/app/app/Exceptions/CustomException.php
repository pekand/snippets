<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

class CustomException extends Exception
{
    /**
     * Report the exception.
     * - optional
     * - overide default report method in exception handler 
     *
     * @return void
     */
    public function report()
    {
        Log::notice("CustomException: report custom exception");
    }

    /**
     * Render the exception into an HTTP response.
     * - optional
     * - overide default report method in exception handler 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        Log::notice("CustomException: render custom exception");

        $customException = "custom text for custom exception"; //here go custom exceptio text

        return response()->json(['message' => $customException], 500);
    }
}
