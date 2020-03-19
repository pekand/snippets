<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Scaffolding extends Controller
{
    public function bootstrap(Request $request)
    {
        return view('dev/controllers/scaffolding/bootstrap');
    }

    public function vue(Request $request)
    {
        return view('dev/controllers/scaffolding/vue');
    }

    public function react(Request $request)
    {
        return view('dev/controllers/scaffolding/react');
    }
}
