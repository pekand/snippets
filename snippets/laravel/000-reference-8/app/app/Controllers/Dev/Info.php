<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Router;

class Info extends Controller
{
    public function show(Request $request)
    {
        return view('info/empty');
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

    public function user(Request $request)
    {
        $users = Auth::user();

        return [
            'user' => $users,
        ];
    }

    public function session(Request $request)
    {
        $data = $request->session()->all();

        return [
            'laravel_session'=>\Illuminate\Support\Facades\Session::getId(),
            'session' => $data,
        ];
    }

    public function routes(Request $request)
    {
        $routes = \Route::getRoutes();

        foreach ($routes as $route) {  
            echo "<a href='/".$route->uri()."'>".$route->uri().'</a> (';
            foreach ($route->methods() as $method) {  
               echo "{$method} ";
            }
            echo ")<br>";
        }
    }

    
}
