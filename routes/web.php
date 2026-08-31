<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\KhatianController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MouzaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\SurveyTypeController;
use App\Http\Controllers\KhatianBrowserController;
use App\Http\Controllers\MapBrowserController;
use App\Http\Controllers\ProfileController;

use App\Models\Division;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
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
| PUBLIC MAP BROWSER
|--------------------------------------------------------------------------
|
| Division
|     ↓
| District
|     ↓
| Upazila
|     ↓
| Mouza
|     ↓
| Maps
|     ↓
| Map Details
|
*/


/*
|--------------------------------------------------------------------------
| Browse Map Divisions
|--------------------------------------------------------------------------
*/

Route::get(
    '/maps/browse',
    [MapBrowserController::class, 'index']
)->name('maps.browse');


/*
|--------------------------------------------------------------------------
| Browse Map Districts
|--------------------------------------------------------------------------
*/

Route::get(
    '/maps/browse/divisions/{division}/districts',
    [MapBrowserController::class, 'districts']
)->name('maps.browse.districts');


/*
|--------------------------------------------------------------------------
| Browse Map Upazilas
|--------------------------------------------------------------------------
*/

Route::get(
    '/maps/browse/districts/{district}/upazilas',
    [MapBrowserController::class, 'upazilas']
)->name('maps.browse.upazilas');


/*
|--------------------------------------------------------------------------
| Browse Map Mouzas
|--------------------------------------------------------------------------
*/

Route::get(
    '/maps/browse/upazilas/{upazila}/mouzas',
    [MapBrowserController::class, 'mouzas']
)->name('maps.browse.mouzas');


/*
|--------------------------------------------------------------------------
| Browse Maps
|--------------------------------------------------------------------------
*/

Route::get(
    '/maps/browse/mouzas/{mouza}/maps',
    [MapBrowserController::class, 'maps']
)->name('maps.browse.maps');


/*
|--------------------------------------------------------------------------
| PUBLIC KHATIAN BROWSER
|--------------------------------------------------------------------------
|
| Division
|     ↓
| District
|     ↓
| Upazila
|     ↓
| Mouza
|     ↓
| Khatians
|     ↓
| Khatian Details
|
*/


/*
|--------------------------------------------------------------------------
| Browse Khatian Divisions
|--------------------------------------------------------------------------
*/

Route::get(
    '/khatians/browse',
    [KhatianBrowserController::class, 'index']
)->name('khatians.browse');


/*
|--------------------------------------------------------------------------
| Browse Khatian Districts
|--------------------------------------------------------------------------
*/

Route::get(
    '/khatians/browse/divisions/{division}/districts',
    [KhatianBrowserController::class, 'districts']
)->name('khatians.browse.districts');


/*
|--------------------------------------------------------------------------
| Browse Khatian Upazilas
|--------------------------------------------------------------------------
*/

Route::get(
    '/khatians/browse/districts/{district}/upazilas',
    [KhatianBrowserController::class, 'upazilas']
)->name('khatians.browse.upazilas');


/*
|--------------------------------------------------------------------------
| Browse Khatian Mouzas
|--------------------------------------------------------------------------
*/

Route::get(
    '/khatians/browse/upazilas/{upazila}/mouzas',
    [KhatianBrowserController::class, 'mouzas']
)->name('khatians.browse.mouzas');


/*
|--------------------------------------------------------------------------
| Browse Khatians
|--------------------------------------------------------------------------
*/

Route::get(
    '/khatians/browse/mouzas/{mouza}/khatians',
    [KhatianBrowserController::class, 'khatians']
)->name('khatians.browse.list');


/*
|--------------------------------------------------------------------------
| Public Khatian Details
|--------------------------------------------------------------------------
*/

Route::get(
    '/khatians/{khatian}',
    [KhatianBrowserController::class, 'show']
)->name('khatians.show');


/*
|--------------------------------------------------------------------------
| Public Map Details
|--------------------------------------------------------------------------
*/

Route::get(
    '/maps/{map}',
    [MapController::class, 'publicShow']
)->name('maps.show');


/*
|--------------------------------------------------------------------------
| PUBLIC ORDER ROUTES
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Public Map Order
|--------------------------------------------------------------------------
*/

Route::get(
    '/orders/create/map/{map}',
    [OrderController::class, 'createPublic']
)->name('orders.map.create');


Route::post(
    '/orders/map',
    [OrderController::class, 'storePublic']
)->name('orders.map.store');


/*
|--------------------------------------------------------------------------
| Public Khatian Order
|--------------------------------------------------------------------------
*/

Route::get(
    '/orders/create/khatian/{khatian}',
    [OrderController::class, 'createKhatian']
)->name('orders.khatian.create');


Route::post(
    '/orders/khatian',
    [OrderController::class, 'storeKhatian']
)->name('orders.khatian.store');


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
| AUTHENTICATED USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
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
    | MAIN ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    |
    | URL:
    | /admin
    |
    | Route:
    | admin.dashboard
    |
    */

    Route::get(
        '/admin',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | MAP MANAGEMENT DASHBOARD
    |--------------------------------------------------------------------------
    |
    | URL:
    | /admin/map-dashboard
    |
    | Route:
    | admin.map.dashboard
    |
    */

    Route::get(
        '/admin/map-dashboard',
        [AdminDashboardController::class, 'mapDashboard']
    )->name('admin.map.dashboard');


    /*
    |--------------------------------------------------------------------------
    | KHATIAN MANAGEMENT DASHBOARD
    |--------------------------------------------------------------------------
    |
    | URL:
    | /admin/khatian-dashboard
    |
    | Route:
    | admin.khatian.dashboard
    |
    */

    Route::get(
        '/admin/khatian-dashboard',
        [AdminDashboardController::class, 'khatianDashboard']
    )->name('admin.khatian.dashboard');


    /*
    |--------------------------------------------------------------------------
    | DIVISION MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/divisions',
        DivisionController::class
    )->names('admin.divisions');


    /*
    |--------------------------------------------------------------------------
    | DISTRICT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/districts',
        DistrictController::class
    )->names('admin.districts');


    /*
    |--------------------------------------------------------------------------
    | UPAZILA MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/upazilas',
        UpazilaController::class
    )->names('admin.upazilas');


    /*
    |--------------------------------------------------------------------------
    | MOUZA MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/mouzas',
        MouzaController::class
    )->names('admin.mouzas');


    /*
    |--------------------------------------------------------------------------
    | KHATIAN MANAGEMENT
    |--------------------------------------------------------------------------
    |
    | URL:
    | /admin/khatians
    |
    */

    Route::resource(
        '/admin/khatians',
        KhatianController::class
    )->names('admin.khatians');


    /*
    |--------------------------------------------------------------------------
    | MAP MANAGEMENT
    |--------------------------------------------------------------------------
    |
    | URL:
    | /admin/maps
    |
    */
/*
|--------------------------------------------------------------------------
| SURVEY TYPE MANAGEMENT
|--------------------------------------------------------------------------
|
| URL:
| /admin/survey-types
|
| Routes:
| admin.survey-types.index
| admin.survey-types.create
| admin.survey-types.store
| admin.survey-types.show
| admin.survey-types.edit
| admin.survey-types.update
| admin.survey-types.destroy
|
*/

Route::resource(
    '/admin/survey-types',
    SurveyTypeController::class
)->names('admin.survey-types');

    /*
    |--------------------------------------------------------------------------
    | Admin Map PDF Download
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | This route stays BEFORE the resource route.
    |
    */

    Route::get(
        '/admin/maps/{map}/download',
        [MapController::class, 'download']
    )->name('admin.maps.download');


    /*
    |--------------------------------------------------------------------------
    | Map Management Resource
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/maps',
        MapController::class
    )->names('admin.maps');


    /*
    |--------------------------------------------------------------------------
    | ORDER MANAGEMENT
    |--------------------------------------------------------------------------
    |
    | Handles:
    |
    | Map Orders
    | Khatian Orders
    |
    */

    Route::resource(
        '/admin/orders',
        OrderController::class
    )->names('admin.orders');


    /*
    |--------------------------------------------------------------------------
    | QUICK ORDER STATUS UPDATE
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/admin/orders/{order}/status',
        [OrderController::class, 'updateStatus']
    )->name('admin.orders.status');

});


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
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
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
