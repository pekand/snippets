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
Route::get('/dev/', 'Dev@show')->middleware(['auth', 'web']);

/* tools */

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/info', 'Dev@info');
    Route::get('/dev/env', 'Dev@env');
    Route::get('/dev/server', 'Dev@server');
    Route::get('/dev/csfr', 'Dev@csfr');

});

/* Services */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/services', 'Services@main');
});

/* Services */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/events', 'Events@main');
});

/* Configuration */

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/configuration', 'Configuration@show');
});

/* Commands */

Route::group(['middleware' =>['auth', 'web']], function()
{
    Route::get('/dev/commands', 'Commands@main');
});

/* Fluent */

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/db/fluent', 'Fluent@test');
});

/* Eloquent */

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/db/eloquent', 'Eloquent@test');
});

/* File Storage */

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/file', 'File@main');
    Route::get('/dev/file/files', 'File@files');
    Route::get('/dev/file/create', 'File@create');
    Route::get('/dev/file/operations', 'File@operations');
    Route::post('/dev/file/upload', 'File@uploadFile');
    Route::post('/dev/file/upload2', 'File@uploadFile2');
    Route::post('/dev/file/upload3', 'File@uploadFile3');
    Route::get('/dev/file/missing', 'File@missing');
    Route::get('/dev/file/url', 'File@fileUrl');
    Route::get('/dev/file/download', 'File@download');
    Route::get('/dev/file/downloadmime', 'File@downloadMime');

});


/* Unit Tests - tools */

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/unit/json', 'Unit@getjson');
    Route::post('/dev/unit/json', 'Unit@getjson');
    Route::get('/dev/unit/json/block', 'Unit@getjsonblock');
    Route::post('/dev/unit/json/block', 'Unit@getjsonblock');
    Route::get('/dev/unit/json/upload', 'Unit@uploadFile');
    Route::post('/dev/unit/json/upload', 'Unit@uploadFile');
});
