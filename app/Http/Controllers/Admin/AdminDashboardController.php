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
     * Display admin dashboard with statistics.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Date Ranges
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $yesterday = Carbon::yesterday();

        $startOfWeek = Carbon::now()->startOfWeek();

        $endOfWeek = Carbon::now()->endOfWeek();

        $startOfMonth = Carbon::now()->startOfMonth();

        $endOfMonth = Carbon::now()->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | Administrative Statistics
        |--------------------------------------------------------------------------
        */

        $divisionCount = Division::count();

        $districtCount = District::count();

        $upazilaCount = Upazila::count();

        $mouzaCount = Mouza::count();

        $surveyTypeCount = SurveyType::count();

        $mapCount = Map::count();


        /*
        |--------------------------------------------------------------------------
        | Map Statistics
        |--------------------------------------------------------------------------
        */

        $activeMaps = Map::where('is_active', true)->count();

        $inactiveMaps = Map::where('is_active', false)->count();

        $freeMaps = Map::where('price', 0)->count();

        $paidMaps = Map::where('price', '>', 0)->count();


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
        | Yesterday's Statistics
        |--------------------------------------------------------------------------
        */

        $yesterdayOrders = Order::whereDate('created_at', $yesterday)
            ->where('status', 'completed')
            ->count();

        $yesterdaySales = Order::whereDate('created_at', $yesterday)
            ->where('status', 'completed')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | This Week Statistics
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
        | This Month Statistics
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
        | Total Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::where('status', 'completed')
            ->count();

        $totalSales = Order::where('status', 'completed')
            ->sum('amount');

        $totalDownloads = Order::sum('download_count');


        /*
        |--------------------------------------------------------------------------
        | Order Status Statistics
        |--------------------------------------------------------------------------
        */

        $pendingOrders = Order::where('status', 'pending')
            ->count();

        $completedOrders = Order::where('status', 'completed')
            ->count();

        $cancelledOrders = Order::where('status', 'cancelled')
            ->count();


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
        | Dashboard View
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', [

            // Administrative
            'divisionCount' => $divisionCount,
            'districtCount' => $districtCount,
            'upazilaCount' => $upazilaCount,
            'mouzaCount' => $mouzaCount,
            'surveyTypeCount' => $surveyTypeCount,

            // Maps
            'mapCount' => $mapCount,
            'activeMaps' => $activeMaps,
            'inactiveMaps' => $inactiveMaps,
            'freeMaps' => $freeMaps,
            'paidMaps' => $paidMaps,

            // Today
            'todayOrders' => $todayOrders,
            'todaySales' => $todaySales,
            'todayDownloads' => $todayDownloads,

            // Yesterday
            'yesterdayOrders' => $yesterdayOrders,
            'yesterdaySales' => $yesterdaySales,

            // Week
            'weekOrders' => $weekOrders,
            'weekSales' => $weekSales,

            // Month
            'monthOrders' => $monthOrders,
            'monthSales' => $monthSales,

            // Total
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'totalDownloads' => $totalDownloads,

            // Order status
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,

            // Tables
            'recentOrders' => $recentOrders,
            'topMaps' => $topMaps,
        ]);
    }
}