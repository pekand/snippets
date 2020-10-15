<?php

Route::group(['middleware' => [ 'web']], function()
{


Route::get('/info', 'Info@show');
Route::get('/info/info', 'Info@info');
Route::get('/info/env', 'Info@env');
Route::get('/info/server', 'Info@server');
Route::get('/info/session', 'Info@session');
Route::get('/info/csfr', 'Info@csfr');
Route::get('/info/token', 'Info@csfr');
Route::get('/info/user', 'Info@user');
Route::get('/info/routes', 'Info@routes');

});
