<?php

use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MouzaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\UpazilaController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Division Management
    |--------------------------------------------------------------------------
    */

    Route::resource('/admin/divisions', DivisionController::class)
        ->names('admin.divisions');


    /*
    |--------------------------------------------------------------------------
    | District Management
    |--------------------------------------------------------------------------
    */

    Route::resource('/admin/districts', DistrictController::class)
        ->names('admin.districts');


    /*
    |--------------------------------------------------------------------------
    | Upazila Management
    |--------------------------------------------------------------------------
    */

    Route::resource('/admin/upazilas', UpazilaController::class)
        ->names('admin.upazilas');


    /*
    |--------------------------------------------------------------------------
    | Mouza Management
    |--------------------------------------------------------------------------
    */

    Route::resource('/admin/mouzas', MouzaController::class)
        ->names('admin.mouzas');


    /*
    |--------------------------------------------------------------------------
    | Map Management
    |--------------------------------------------------------------------------
    */

    // PDF Download
    // IMPORTANT: This must be BEFORE the resource route
    Route::get('/admin/maps/{map}/download', [MapController::class, 'download'])
        ->name('admin.maps.download');


    // Map CRUD
    Route::resource('/admin/maps', MapController::class)
        ->names('admin.maps');
});


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';