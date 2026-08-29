<?php
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MouzaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\ProfileController;
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
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


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

Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');
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

    /*
    | PDF Download
    |
    | IMPORTANT:
    | This route must be before the resource route.
    */

    Route::get('/admin/maps/{map}/download', [MapController::class, 'download'])
        ->name('admin.maps.download');


    /*
    | Map CRUD
    */

    Route::resource('/admin/maps', MapController::class)
        ->names('admin.maps');


    /*
    |--------------------------------------------------------------------------
    | Order Management
    |--------------------------------------------------------------------------
    */

    /*
    | Order List
    */

    Route::get('/admin/orders', [OrderController::class, 'index'])
        ->name('admin.orders.index');


    /*
    | Order Details
    */

    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])
        ->name('admin.orders.show');

    /*
    | Update Order Status
    */

    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.status');


    /*
    | Delete Order
    */

    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])
        ->name('admin.orders.destroy');

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
