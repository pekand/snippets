<?php

namespace App\Controllers\Info;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;

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
            'APP_ENV' => App::environment(),
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

        $data = ['routes'=>[]];
        foreach ($routes as $route) {

            $routeData = [];

            $routeData['uri'] = $route->uri();
            $routeData['methods'] = [];
            foreach ($route->methods() as $method) {
                $routeData['methods'][] = $method;
            }

            $data['routes'][] = $routeData;
        }

        if(isset($_GET['RAW'])){
            foreach ($data['routes'] as $route) {
               echo  '<a href="/'.$route['uri'].'">'.$route['uri'].'</a><br>';
            }
            return null;
        }

        return $data;
    }


}
