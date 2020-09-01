<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Lib\Fruit;
use App\Lib\UserRepository;

class Main extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('welcome');
    }
}
