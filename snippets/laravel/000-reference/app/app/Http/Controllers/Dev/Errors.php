<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;

class Errors extends Controller
{
    public function main(Request $request)
    {
        try {
            throw new CustomException();
        } catch (\Exception $e) {
            report($e); // report catched exception 
            throw $e;
        }
    }

    public function error404(Request $request)
    {
        abort(404, 'page not found');
    }

    public function error500(Request $request)
    {
        abort(500, 'error');
    }
}
