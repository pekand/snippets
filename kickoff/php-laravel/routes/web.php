<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\CarController;
use App\Http\Controllers\PartController;

Route::get('/', function () {
    return Inertia::render('Login', [
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cars', [CarController::class, 'index'])
->middleware(['auth', 'verified'])->name('cars.index');
Route::get('car', function () {
    return Inertia::render('Car');
})->middleware(['auth', 'verified'])->name('car');

Route::get('/car/{id}', [CarController::class, 'edit'])
->middleware(['auth', 'verified'])->name('cars.edit');
Route::post('/car', [CarController::class, 'store'])
->middleware(['auth', 'verified'])->name('cars.create');
Route::put('/car/{id}', [CarController::class, 'update'])
->middleware(['auth', 'verified'])->name('cars.update');
Route::delete('/car/{id}', [CarController::class, 'destroy'])
->middleware(['auth', 'verified'])->name('cars.destroy');

Route::get('/parts', [PartController::class, 'index'])
->middleware(['auth', 'verified'])->name('parts.index');
Route::get('/part/{id}', [PartController::class, 'edit'])
->middleware(['auth', 'verified'])->name('part');
Route::post('/part', [PartController::class, 'store'])
->middleware(['auth', 'verified'])->name('part.create');
Route::put('/part/{id}', [PartController::class, 'update'])
->middleware(['auth', 'verified'])->name('part.update');
Route::delete('/part/{id}', [PartController::class, 'destroy'])
->middleware(['auth', 'verified'])->name('part.destroy');
