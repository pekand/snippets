<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Dev extends Controller
{

    public function show(Request $request)
    {
        return view('dev/dev');
    }

    public function info(Request $request)
    {
        phpinfo();

        return;
    }

    public function env(Request $request)
    {
        return [
            'env' => $_ENV,
            'server' => $_SERVER,
        ];
    }

    public function server(Request $request)
    {
        return [
            'server' => $_SERVER,
        ];
    }

    public function csfr(Request $request)
    {

        return [
            'csrf' => csrf_token(),
        ];
    }
}
