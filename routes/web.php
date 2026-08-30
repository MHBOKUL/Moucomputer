<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MouzaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\MapBrowserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Public Map Browser
|--------------------------------------------------------------------------
|
| Customer flow:
|
| Division
|     ↓
| District
|     ↓
| Upazila
|     ↓
| Mouza
|     ↓
| Available Maps
|     ↓
| Map Details
|
*/


/*
|--------------------------------------------------------------------------
| Browse Divisions
|--------------------------------------------------------------------------
|
| Example:
| /maps/browse
|
*/

Route::get(
    '/maps/browse',
    [MapBrowserController::class, 'index']
)->name('maps.browse');


/*
|--------------------------------------------------------------------------
| Browse Districts
|--------------------------------------------------------------------------
|
| Example:
| /maps/browse/divisions/1/districts
|
*/

Route::get(
    '/maps/browse/divisions/{division}/districts',
    [MapBrowserController::class, 'districts']
)->name('maps.browse.districts');


/*
|--------------------------------------------------------------------------
| Browse Upazilas
|--------------------------------------------------------------------------
|
| Example:
| /maps/browse/districts/1/upazilas
|
*/

Route::get(
    '/maps/browse/districts/{district}/upazilas',
    [MapBrowserController::class, 'upazilas']
)->name('maps.browse.upazilas');


/*
|--------------------------------------------------------------------------
| Browse Mouzas
|--------------------------------------------------------------------------
|
| Example:
| /maps/browse/upazilas/1/mouzas
|
*/

Route::get(
    '/maps/browse/upazilas/{upazila}/mouzas',
    [MapBrowserController::class, 'mouzas']
)->name('maps.browse.mouzas');


/*
|--------------------------------------------------------------------------
| Browse Maps
|--------------------------------------------------------------------------
|
| Example:
| /maps/browse/mouzas/1/maps
|
*/

Route::get(
    '/maps/browse/mouzas/{mouza}/maps',
    [MapBrowserController::class, 'maps']
)->name('maps.browse.maps');


/*
|--------------------------------------------------------------------------
| Public Map Details
|--------------------------------------------------------------------------
|
| Example:
| /maps/1
|
| Only active maps are publicly accessible.
|
*/

Route::get(
    '/maps/{map}',
    [MapController::class, 'publicShow']
)->name('maps.show');


/*
|--------------------------------------------------------------------------
| Public Order
|--------------------------------------------------------------------------
|
| GET  /orders/create/{map}
| POST /orders
| GET  /orders/{order}/success
| GET  /orders/{order}/download
|
*/


/*
|--------------------------------------------------------------------------
| Create Order
|--------------------------------------------------------------------------
*/

Route::get(
    '/orders/create/{map}',
    [OrderController::class, 'createPublic']
)->name('orders.create');


/*
|--------------------------------------------------------------------------
| Store Order
|--------------------------------------------------------------------------
*/

Route::post(
    '/orders',
    [OrderController::class, 'storePublic']
)->name('orders.store');


/*
|--------------------------------------------------------------------------
| Order Success
|--------------------------------------------------------------------------
*/

Route::get(
    '/orders/{order}/success',
    [OrderController::class, 'success']
)->name('orders.success');


/*
|--------------------------------------------------------------------------
| Customer PDF Download
|--------------------------------------------------------------------------
|
| Download is protected inside OrderController.
|
*/

Route::get(
    '/orders/{order}/download',
    [OrderController::class, 'download']
)->name('orders.download');


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

    Route::get(
        '/admin',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Division Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/divisions',
        DivisionController::class
    )->names('admin.divisions');


    /*
    |--------------------------------------------------------------------------
    | District Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/districts',
        DistrictController::class
    )->names('admin.districts');


    /*
    |--------------------------------------------------------------------------
    | Upazila Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/upazilas',
        UpazilaController::class
    )->names('admin.upazilas');


    /*
    |--------------------------------------------------------------------------
    | Mouza Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/mouzas',
        MouzaController::class
    )->names('admin.mouzas');


    /*
    |--------------------------------------------------------------------------
    | Map Management
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Admin Map PDF Download
    |--------------------------------------------------------------------------
    |
    | Must be before the Map resource route.
    |
    */

    Route::get(
        '/admin/maps/{map}/download',
        [MapController::class, 'download']
    )->name('admin.maps.download');


    /*
    |--------------------------------------------------------------------------
    | Admin Map CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/maps',
        MapController::class
    )->names('admin.maps');


    /*
    |--------------------------------------------------------------------------
    | Order Management
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Admin Order CRUD
    |--------------------------------------------------------------------------
    |
    | GET       /admin/orders
    | POST      /admin/orders
    | GET       /admin/orders/create
    | GET       /admin/orders/{order}
    | PUT/PATCH /admin/orders/{order}
    | DELETE    /admin/orders/{order}
    | GET       /admin/orders/{order}/edit
    |
    */

    Route::resource(
        '/admin/orders',
        OrderController::class
    )->names('admin.orders');


    /*
    |--------------------------------------------------------------------------
    | Quick Order Status Update
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/admin/orders/{order}/status',
        [OrderController::class, 'updateStatus']
    )->name('admin.orders.status');

});


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Profile Edit
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');


    /*
    |--------------------------------------------------------------------------
    | Profile Update
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | Profile Delete
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';