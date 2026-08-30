<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\Models\SurveyType;
use App\Models\Map;
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Date Ranges
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | Administrative Statistics
        |--------------------------------------------------------------------------
        */

        $totalDivisions = Division::count();

        $totalDistricts = District::count();

        $totalUpazilas = Upazila::count();

        $totalMouzas = Mouza::count();

        $totalSurveyTypes = SurveyType::count();


        /*
        |--------------------------------------------------------------------------
        | Map Statistics
        |--------------------------------------------------------------------------
        */

        $totalMaps = Map::count();

        $activeMaps = Map::where('is_active', true)->count();

        $inactiveMaps = Map::where('is_active', false)->count();

        $freeMaps = Map::where('price', 0)->count();

        $paidMaps = Map::where('price', '>', 0)->count();


        /*
        |--------------------------------------------------------------------------
        | Order Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $cancelledOrders = Order::where('status', 'cancelled')->count();


        /*
        |--------------------------------------------------------------------------
        | Revenue Statistics
        |--------------------------------------------------------------------------
        */

        $totalSales = Order::where('status', 'completed')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Today's Statistics
        |--------------------------------------------------------------------------
        */

        $todayOrders = Order::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->count();

        $todaySales = Order::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('amount');

        $todayDownloads = Order::whereDate('downloaded_at', $today)
            ->sum('download_count');


        /*
        |--------------------------------------------------------------------------
        | Weekly Statistics
        |--------------------------------------------------------------------------
        */

        $weekOrders = Order::whereBetween('created_at', [
            $startOfWeek,
            $endOfWeek,
        ])
            ->where('status', 'completed')
            ->count();

        $weekSales = Order::whereBetween('created_at', [
            $startOfWeek,
            $endOfWeek,
        ])
            ->where('status', 'completed')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Monthly Statistics
        |--------------------------------------------------------------------------
        */

        $monthOrders = Order::whereBetween('created_at', [
            $startOfMonth,
            $endOfMonth,
        ])
            ->where('status', 'completed')
            ->count();

        $monthSales = Order::whereBetween('created_at', [
            $startOfMonth,
            $endOfMonth,
        ])
            ->where('status', 'completed')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Download Statistics
        |--------------------------------------------------------------------------
        */

        $totalDownloads = Order::sum('download_count');


        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with('map')
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Top Selling Maps
        |--------------------------------------------------------------------------
        */

        $topMaps = Order::with('map')
            ->where('status', 'completed')
            ->selectRaw(
                'map_id, COUNT(*) as total_orders, SUM(amount) as total_sales'
            )
            ->groupBy('map_id')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard View
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(

            // Administrative
            'totalDivisions',
            'totalDistricts',
            'totalUpazilas',
            'totalMouzas',
            'totalSurveyTypes',

            // Maps
            'totalMaps',
            'activeMaps',
            'inactiveMaps',
            'freeMaps',
            'paidMaps',

            // Orders
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',

            // Revenue
            'totalSales',

            // Today
            'todayOrders',
            'todaySales',
            'todayDownloads',

            // Week
            'weekOrders',
            'weekSales',

            // Month
            'monthOrders',
            'monthSales',

            // Downloads
            'totalDownloads',

            // Tables
            'recentOrders',
            'topMaps'
        ));
    }
}