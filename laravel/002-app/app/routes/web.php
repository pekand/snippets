<?php

use Illuminate\Http\Request;

Route::get('/', function () {
	$links = \App\Link::all();

    return view('welcome', ['links' => $links]);
});


Route::get('/submit', function () {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new App\Link($data))->save();

    return redirect('/');
});