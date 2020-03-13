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

/* 
    Getting Started 
*/

/* Configuration */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/configuration', 'Configuration@show');
});


/* 
    Architecture Concepts 
*/

/* Services */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/services', 'Services@main');
});

/* Facades */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/facades', 'Facades@main');
});

/* Contracts */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/contracts', 'Contracts@main');
});

/* 
    The Basics 
*/

/* errors handling */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/session', 'Session@main');
});

/* errors handling */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/errors', 'Errors@main');
    Route::get('/dev/errors/404', 'Errors@error404');
    Route::get('/dev/errors/500', 'Errors@error500');
});

/* log */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/log', 'Logging@main');
});

/* 
    Frontend 
*/

/* 
    Security 
*/

/* 
    Digging Deeper 
*/


/* Commands */
Route::group(['middleware' =>['auth', 'web']], function()
{
    Route::get('/dev/commands', 'Commands@main');
});

/* cache */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/cache', 'Caching@main');
    Route::get('/dev/cache/locks', 'Caching@locks');
    Route::get('/dev/cache/tags', 'Caching@tags');
});

/* Events */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/events', 'Events@main');
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


/* Events */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/helpers', 'Helpers@main');
});

/* 
    Database 
*/

/* Fluent */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/db/fluent', 'Fluent@test');
});

/* Eloquent ORM */

/* Eloquent */
Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/dev/db/eloquent', 'Eloquent@test');
});

/* 
    Testing 
*/

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
