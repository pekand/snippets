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

Route::group(['middleware' => [ 'web']], function()
{

Route::get('/dev/info', 'Dev@info');
Route::get('/dev/env', 'Dev@env');
Route::get('/dev/server', 'Dev@server');
Route::get('/dev/session', 'Dev@session');
Route::get('/dev/csfr', 'Dev@csfr');
Route::get('/dev/token', 'Dev@csfr');
Route::get('/dev/user', 'Dev@user');

/*
    Getting Started
*/

/* Configuration */
Route::get('/dev/examples/configuration', 'Configuration@show');

/*
    Architecture Concepts
*/

/* Services */
Route::get('/dev/examples/services', 'Services@main');


/* Facades */
Route::get('/dev/examples/facades', 'Facades@main');


/* Contracts */
Route::get('/dev/examples/contracts', 'Contracts@main');

/*
    The Basics
*/

/* errors handling */
Route::get('/dev/examples/session', 'Session@main');

/* errors handling */
Route::get('/dev/examples/errors', 'Errors@main');
Route::get('/dev/examples/errors/404', 'Errors@error404');
Route::get('/dev/examples/errors/500', 'Errors@error500');

/* log */
Route::get('/dev/examples/log', 'Logging@main');


/*
    Frontend
*/

/* blade */
Route::get('/dev/examples/blade/comment', 'Blade@comment');
Route::get('/dev/examples/blade/variables', 'Blade@variables');
Route::get('/dev/examples/blade/extend', 'Blade@extend');
Route::get('/dev/examples/blade/include', 'Blade@include');
Route::get('/dev/examples/blade/components', 'Blade@components');
Route::get('/dev/examples/blade/phpblock', 'Blade@phpblock');
Route::get('/dev/examples/blade/json', 'Blade@json');
Route::get('/dev/examples/blade/control', 'Blade@control');
Route::get('/dev/examples/blade/aliasing', 'Blade@aliasing');
Route::get('/dev/examples/blade/collection', 'Blade@collection');
Route::get('/dev/examples/blade/stacks', 'Blade@stacks');
Route::get('/dev/examples/blade/injection', 'Blade@injection');
Route::get('/dev/examples/blade/extending', 'Blade@extending');
Route::get('/dev/examples/blade/form', 'Blade@form');
Route::post('/dev/examples/blade/form', 'Blade@formSave');
Route::post('/dev/examples/blade/form2', 'Blade@form2Save');

/* localization */
Route::get('/dev/examples/localization/{locale}', 'Localization@main');
Route::get('/dev/examples/localization/{locale}/messages', 'Localization@messages');

/* messages
    Security
*/

/*
    Digging Deeper
*/

/* Commands */
Route::get('/dev/examples/commands', 'Commands@main');

/* cache */
Route::get('/dev/examples/cache', 'Caching@main');
Route::get('/dev/examples/cache/locks', 'Caching@locks');
Route::get('/dev/examples/cache/tags', 'Caching@tags');


/* Events */
Route::get('/dev/examples/events', 'Events@main');


/* File Storage */
Route::get('/dev/examples/file', 'File@main');
Route::get('/dev/examples/file/files', 'File@files');
Route::get('/dev/examples/file/create', 'File@create');
Route::get('/dev/examples/file/operations', 'File@operations');
Route::post('/dev/examples/file/upload', 'File@uploadFile');
Route::post('/dev/examples/file/upload2', 'File@uploadFile2');
Route::post('/dev/examples/file/upload3', 'File@uploadFile3');
Route::get('/dev/examples/file/missing', 'File@missing');
Route::get('/dev/examples/file/url', 'File@fileUrl');
Route::get('/dev/examples/file/download', 'File@download');
Route::get('/dev/examples/file/downloadmime', 'File@downloadMime');
Route::get('/dev/examples/file/uploadform', 'File@uploadForm');

/* Packages */
Route::get('/dev/examples/packages', 'Packages@main');

/* Events */
Route::get('/dev/examples/helpers', 'Helpers@main');

/*
    Database
*/

/* Fluent */
Route::get('/dev/examples/db/fluent', 'Fluent@test');

/* Eloquent ORM */

/* Eloquent */
Route::get('/dev/examples/db/eloquent', 'Eloquent@test');

/*
    Testing
*/

/* Unit Tests - tools */
Route::get('/dev/examples/unit/json', 'Unit@getjson');
Route::post('/dev/examples/unit/json', 'Unit@getjson');
Route::get('/dev/examples/unit/json/block', 'Unit@getjsonblock');
Route::post('/dev/examples/unit/json/block', 'Unit@getjsonblock');
Route::get('/dev/examples/unit/json/upload', 'Unit@uploadFile');
Route::post('/dev/examples/unit/json/upload', 'Unit@uploadFile');

});
