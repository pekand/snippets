<?php

use Illuminate\Http\Request;

Route::get('/', function () {
	$links = \App\Link::all();

    return view('welcome', ['links' => $links]);
});

Route::get('/login',array('as'=>'login',function(){
    return view('login');
}));

Route::get('/register',array('as'=>'register',function(){
    return view('login');
}));

Route::get('/submit', function () {
    return view('submit');
})->middleware('auth');

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new App\Link($data))->save();

    return redirect('/');
})->middleware('auth');