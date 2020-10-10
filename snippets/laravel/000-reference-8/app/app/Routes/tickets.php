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

Route::group(['middleware' => ['auth', 'web']], function()
{
    Route::get('/tickets/', 'Tickets@list');
    Route::get('/tickets/ticket/view/{id}', 'Tickets@view');
    Route::get('/tickets/ticket/create', 'Tickets@create');
    Route::post('/tickets/ticket/insert', 'Tickets@insert');
    Route::post('/tickets/ticket/update/{id}', 'Tickets@update');
    Route::get('/tickets/ticket/delete/{id}', 'Tickets@delete');

});
