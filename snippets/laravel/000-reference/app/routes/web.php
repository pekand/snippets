<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Main */

Route::get('/', 'Main@show');

/* Profile */
Route::get('/profile', 'Profile@show');

/* Dev */
Route::get('/dev/', 'Dev@show')->middleware('dev');

Route::group(['middleware' => 'dev'], function()
{
    Route::get('/dev/info', 'Dev@info');
    Route::get('/dev/env', 'Dev@env');
    Route::get('/dev/server', 'Dev@server');
    Route::get('/dev/db/fluent/examples', 'Fluent@test');
    Route::get('/dev/db/eloquent/examples', 'Eloquent@test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

