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
        var_dump($_ENV);

        var_dump($_SERVER);

        return;
    }

    public function server(Request $request)
    {

        var_dump($_SERVER);

        return;
    }

    public function users(Request $request)
    {

        $users = DB::select('select * from users where id = ?', [1]);

        return;
    }
}
