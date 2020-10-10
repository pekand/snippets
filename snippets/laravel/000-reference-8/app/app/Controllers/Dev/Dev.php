<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Dev extends Controller
{
    public function show(Request $request)
    {
        return view('dev/controllers/dev/dev');
    }
}
