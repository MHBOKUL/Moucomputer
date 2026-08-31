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
use App\Models\Division;
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
|
| Loads active divisions for the Mouza Map search section.
|
*/

Route::get('/', function () {

    $divisions = Division::query()
        ->where('status', true)
        ->withCount([
            'districts' => function ($query) {
                $query->where('is_active', true);
            }
        ])
        ->orderBy('name')
        ->get();

    return view('welcome', compact('divisions'));

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
| GET /maps/browse
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
| GET /maps/browse/divisions/{division}/districts
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
| GET /maps/browse/districts/{district}/upazilas
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
| GET /maps/browse/upazilas/{upazila}/mouzas
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
| GET /maps/browse/mouzas/{mouza}/maps
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
| GET /maps/{map}
|
| Only active maps should be publicly accessible.
|
*/

Route::get(
    '/maps/{map}',
    [MapController::class, 'publicShow']
)->name('maps.show');


/*
|--------------------------------------------------------------------------
| Public Order Routes
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
| Create Public Order
|--------------------------------------------------------------------------
*/

Route::get(
    '/orders/create/{map}',
    [OrderController::class, 'createPublic']
)->name('orders.create');


/*
|--------------------------------------------------------------------------
| Store Public Order
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
*/

Route::get(
    '/orders/{order}/download',
    [OrderController::class, 'download']
)->name('orders.download');


/*
|--------------------------------------------------------------------------
| Authenticated User Dashboard
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
|
| All admin routes require:
|
| auth
| admin
|
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
    | Admin Map Management
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Admin Map PDF Download
    |--------------------------------------------------------------------------
    |
    | Keep this route before the Map resource route.
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
    | Admin Order Management
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Admin Order CRUD
    |--------------------------------------------------------------------------
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
|
| Requires authentication.
|
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