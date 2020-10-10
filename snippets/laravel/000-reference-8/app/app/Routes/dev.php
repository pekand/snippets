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

Route::get('/info/info', 'Info@info');
Route::get('/info/env', 'Info@env');
Route::get('/info/server', 'Info@server');
Route::get('/info/session', 'Info@session');
Route::get('/info/csfr', 'Info@csfr');
Route::get('/info/token', 'Info@csfr');
Route::get('/info/user', 'Info@user');

/*
    Getting Started
*/

/* Configuration */
Route::get('/dev/configuration', 'Configuration@show');

/*
    Architecture Concepts
*/

/* Services */
Route::get('/dev/services', 'Services@main');


/* Facades */
Route::get('/dev/facades', 'Facades@main');


/* Contracts */
Route::get('/dev/contracts', 'Contracts@main');

/*
    The Basics
*/

/* errors handling */
Route::get('/dev/session', 'Session@main');

/* errors handling */
Route::get('/dev/errors', 'Errors@main');
Route::get('/dev/errors/404', 'Errors@error404');
Route::get('/dev/errors/500', 'Errors@error500');

/* log */
Route::get('/dev/log', 'Logging@main');


/*
    Frontend
*/

/* blade */
Route::get('/dev/blade/comment', 'Blade@comment');
Route::get('/dev/blade/variables', 'Blade@variables');
Route::get('/dev/blade/extend', 'Blade@extend');
Route::get('/dev/blade/include', 'Blade@include');
Route::get('/dev/blade/components', 'Blade@components');
Route::get('/dev/blade/phpblock', 'Blade@phpblock');
Route::get('/dev/blade/json', 'Blade@json');
Route::get('/dev/blade/control', 'Blade@control');
Route::get('/dev/blade/aliasing', 'Blade@aliasing');
Route::get('/dev/blade/collection', 'Blade@collection');
Route::get('/dev/blade/stacks', 'Blade@stacks');
Route::get('/dev/blade/injection', 'Blade@injection');
Route::get('/dev/blade/extending', 'Blade@extending');
Route::get('/dev/blade/form', 'Blade@form');
Route::post('/dev/blade/form', 'Blade@formSave');
Route::post('/dev/blade/form2', 'Blade@form2Save');

/* localization */
Route::get('/dev/localization/{locale}', 'Localization@main');
Route::get('/dev/localization/{locale}/messages', 'Localization@messages');


/* Frontend Scaffolding */
Route::get('/dev/scaffolding/bootstrap', 'Scaffolding@bootstrap');
Route::get('/dev/scaffolding/vue', 'Scaffolding@vue');
Route::get('/dev/scaffolding/react', 'Scaffolding@react');

/* Compiling Assets (Mix) */

/*
    Security
*/

/*
    Digging Deeper
*/

/* Commands */
Route::get('/dev/commands', 'Commands@main');

/* cache */
Route::get('/dev/cache', 'Caching@main');
Route::get('/dev/cache/locks', 'Caching@locks');
Route::get('/dev/cache/tags', 'Caching@tags');


/* Events */
Route::get('/dev/events', 'Events@main');


/* File Storage */
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
Route::get('/dev/file/uploadform', 'File@uploadForm');

/* Packages */
Route::get('/dev/packages', 'Packages@main');

/* Events */
Route::get('/dev/helpers', 'Helpers@main');

/*
    Database
*/

/* Fluent */
Route::get('/dev/db/fluent', 'Fluent@test');

/* Eloquent ORM */

/* Eloquent */
Route::get('/dev/db/eloquent', 'Eloquent@test');

/*
    Testing
*/

/* Unit Tests - tools */
Route::get('/dev/unit/json', 'Unit@getjson');
Route::post('/dev/unit/json', 'Unit@getjson');
Route::get('/dev/unit/json/block', 'Unit@getjsonblock');
Route::post('/dev/unit/json/block', 'Unit@getjsonblock');
Route::get('/dev/unit/json/upload', 'Unit@uploadFile');
Route::post('/dev/unit/json/upload', 'Unit@uploadFile');

});
