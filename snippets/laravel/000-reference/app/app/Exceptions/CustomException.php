<?php

namespace App\Exceptions;

use Exception;

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
        echo "report custom exception\n";
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
        return "render custom exception\n";
    }
}
