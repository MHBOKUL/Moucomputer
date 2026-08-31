<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Map;
use App\Models\Khatian;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\Models\SurveyType;

class AdminDashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MAIN ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC OVERVIEW
        |--------------------------------------------------------------------------
        */

        $totalMaps = Map::count();

        $totalKhatians = Khatian::count();

        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $cancelledOrders = Order::where('status', 'cancelled')->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL SALES
        |--------------------------------------------------------------------------
        */

        $totalSales = Order::where('status', 'completed')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | TODAY
        |--------------------------------------------------------------------------
        */

        $todayOrders = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->count();

        $todaySales = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | THIS WEEK
        |--------------------------------------------------------------------------
        */

        $weekOrders = Order::where('status', 'completed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count();

        $weekSales = Order::where('status', 'completed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | THIS MONTH
        |--------------------------------------------------------------------------
        */

        $monthOrders = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $monthSales = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | MAP STATISTICS
        |--------------------------------------------------------------------------
        */

        $activeMaps = Map::where('is_active', true)->count();

        $inactiveMaps = Map::where('is_active', false)->count();

        $freeMaps = Map::where('price', 0)->count();

        $paidMaps = Map::where('price', '>', 0)->count();


        /*
        |--------------------------------------------------------------------------
        | KHATIAN STATISTICS
        |--------------------------------------------------------------------------
        */

        $activeKhatians = Khatian::where('is_active', true)->count();

        $inactiveKhatians = Khatian::where('is_active', false)->count();

        $freeKhatians = Khatian::where('price', 0)->count();

        $paidKhatians = Khatian::where('price', '>', 0)->count();


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD STATISTICS
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | maps table does NOT currently contain download_count.
        |
        | Therefore we do NOT use:
        |
        | Map::sum('download_count')
        |
        | For now downloads are calculated from completed orders.
        |
        */

        $mapDownloads = Order::whereNotNull('map_id')
            ->where('status', 'completed')
            ->where('download_allowed', true)
            ->sum('download_count');


        $khatianDownloads = Order::whereNotNull('khatian_id')
            ->where('status', 'completed')
            ->where('download_allowed', true)
            ->sum('download_count');


        $totalDownloads = $mapDownloads + $khatianDownloads;


        /*
        |--------------------------------------------------------------------------
        | RECENT ORDERS
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with([
            'map',
            'khatian.mouza',
            'khatian.surveyType'
        ])
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOP SELLING MAPS
        |--------------------------------------------------------------------------
        */

        $topMaps = Order::select('map_id')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(amount) as total_sales')
            ->whereNotNull('map_id')
            ->where('status', 'completed')
            ->with('map')
            ->groupBy('map_id')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOP SELLING KHATIANS
        |--------------------------------------------------------------------------
        */

        $topKhatians = Order::select('khatian_id')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(amount) as total_sales')
            ->whereNotNull('khatian_id')
            ->where('status', 'completed')
            ->with([
                'khatian.mouza',
                'khatian.surveyType'
            ])
            ->groupBy('khatian_id')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LOCATION STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalDivisions = Division::count();

        $totalDistricts = District::count();

        $totalUpazilas = Upazila::count();

        $totalMouzas = Mouza::count();

        $totalSurveyTypes = SurveyType::count();


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.management-dashboard', [

            /*
            |--------------------------------------------------------------------------
            | DASHBOARD TYPE
            |--------------------------------------------------------------------------
            */

            'managementType' => 'overview',


            /*
            |--------------------------------------------------------------------------
            | ORDERS
            |--------------------------------------------------------------------------
            */

            'totalOrders' => $totalOrders,

            'pendingOrders' => $pendingOrders,

            'completedOrders' => $completedOrders,

            'cancelledOrders' => $cancelledOrders,


            /*
            |--------------------------------------------------------------------------
            | SALES
            |--------------------------------------------------------------------------
            */

            'totalSales' => $totalSales,

            'todaySales' => $todaySales,

            'todayOrders' => $todayOrders,

            'weekSales' => $weekSales,

            'weekOrders' => $weekOrders,

            'monthSales' => $monthSales,

            'monthOrders' => $monthOrders,


            /*
            |--------------------------------------------------------------------------
            | MAPS
            |--------------------------------------------------------------------------
            */

            'totalMaps' => $totalMaps,

            'activeMaps' => $activeMaps,

            'inactiveMaps' => $inactiveMaps,

            'freeMaps' => $freeMaps,

            'paidMaps' => $paidMaps,


            /*
            |--------------------------------------------------------------------------
            | KHATIANS
            |--------------------------------------------------------------------------
            */

            'totalKhatians' => $totalKhatians,

            'activeKhatians' => $activeKhatians,

            'inactiveKhatians' => $inactiveKhatians,

            'freeKhatians' => $freeKhatians,

            'paidKhatians' => $paidKhatians,


            /*
            |--------------------------------------------------------------------------
            | DOWNLOADS
            |--------------------------------------------------------------------------
            */

            'totalDownloads' => $totalDownloads,

            'mapDownloads' => $mapDownloads,

            'khatianDownloads' => $khatianDownloads,


            /*
            |--------------------------------------------------------------------------
            | RECENT ORDERS
            |--------------------------------------------------------------------------
            */

            'recentOrders' => $recentOrders,


            /*
            |--------------------------------------------------------------------------
            | TOP PRODUCTS
            |--------------------------------------------------------------------------
            */

            'topMaps' => $topMaps,

            'topKhatians' => $topKhatians,


            /*
            |--------------------------------------------------------------------------
            | LOCATION DATA
            |--------------------------------------------------------------------------
            */

            'totalDivisions' => $totalDivisions,

            'totalDistricts' => $totalDistricts,

            'totalUpazilas' => $totalUpazilas,

            'totalMouzas' => $totalMouzas,

            'totalSurveyTypes' => $totalSurveyTypes,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MAP MANAGEMENT DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function mapDashboard()
    {
        /*
        |--------------------------------------------------------------------------
        | MAP ORDERS ONLY
        |--------------------------------------------------------------------------
        */

        $mapOrdersQuery = Order::whereNotNull('map_id');


        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        $totalSales = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->sum('amount');

        $totalOrders = (clone $mapOrdersQuery)
            ->count();

        $pendingOrders = (clone $mapOrdersQuery)
            ->where('status', 'pending')
            ->count();

        $completedOrders = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->count();

        $cancelledOrders = (clone $mapOrdersQuery)
            ->where('status', 'cancelled')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TODAY
        |--------------------------------------------------------------------------
        */

        $todayOrders = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->whereDate('created_at', today())
            ->count();

        $todaySales = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | THIS WEEK
        |--------------------------------------------------------------------------
        */

        $weekOrders = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count();

        $weekSales = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | THIS MONTH
        |--------------------------------------------------------------------------
        */

        $monthOrders = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $monthSales = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | MAP INVENTORY
        |--------------------------------------------------------------------------
        */

        $totalMaps = Map::count();

        $activeMaps = Map::where('is_active', true)->count();

        $inactiveMaps = Map::where('is_active', false)->count();

        $freeMaps = Map::where('price', 0)->count();

        $paidMaps = Map::where('price', '>', 0)->count();


        /*
        |--------------------------------------------------------------------------
        | MAP DOWNLOADS
        |--------------------------------------------------------------------------
        |
        | Do not use Map::sum('download_count')
        | because the maps table does not have that column.
        |
        */

        $totalDownloads = (clone $mapOrdersQuery)
            ->where('status', 'completed')
            ->where('download_allowed', true)
            ->sum('download_count');


        /*
        |--------------------------------------------------------------------------
        | RECENT MAP ORDERS
        |--------------------------------------------------------------------------
        */

        $recentOrders = (clone $mapOrdersQuery)
            ->with('map')
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOP SELLING MAPS
        |--------------------------------------------------------------------------
        */

        $topMaps = Order::select('map_id')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(amount) as total_sales')
            ->whereNotNull('map_id')
            ->where('status', 'completed')
            ->with('map')
            ->groupBy('map_id')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | COMMON ADMIN DATA
        |--------------------------------------------------------------------------
        */

        $totalDivisions = Division::count();

        $totalDistricts = District::count();

        $totalUpazilas = Upazila::count();

        $totalMouzas = Mouza::count();

        $totalSurveyTypes = SurveyType::count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.management-dashboard', [

            'managementType' => 'map',

            'totalSales' => $totalSales,

            'totalOrders' => $totalOrders,

            'pendingOrders' => $pendingOrders,

            'todaySales' => $todaySales,

            'todayOrders' => $todayOrders,

            'weekSales' => $weekSales,

            'weekOrders' => $weekOrders,

            'monthSales' => $monthSales,

            'monthOrders' => $monthOrders,

            'recentOrders' => $recentOrders,

            'completedOrders' => $completedOrders,

            'cancelledOrders' => $cancelledOrders,

            'totalMaps' => $totalMaps,

            'activeMaps' => $activeMaps,

            'inactiveMaps' => $inactiveMaps,

            'freeMaps' => $freeMaps,

            'paidMaps' => $paidMaps,

            'totalDownloads' => $totalDownloads,

            'topMaps' => $topMaps,

            'totalDivisions' => $totalDivisions,

            'totalDistricts' => $totalDistricts,

            'totalUpazilas' => $totalUpazilas,

            'totalMouzas' => $totalMouzas,

            'totalSurveyTypes' => $totalSurveyTypes,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | KHATIAN MANAGEMENT DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function khatianDashboard()
    {
        /*
        |--------------------------------------------------------------------------
        | KHATIAN ORDERS ONLY
        |--------------------------------------------------------------------------
        */

        $khatianOrdersQuery = Order::whereNotNull('khatian_id');


        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        $totalSales = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->sum('amount');

        $totalOrders = (clone $khatianOrdersQuery)
            ->count();

        $pendingOrders = (clone $khatianOrdersQuery)
            ->where('status', 'pending')
            ->count();

        $completedOrders = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->count();

        $cancelledOrders = (clone $khatianOrdersQuery)
            ->where('status', 'cancelled')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TODAY
        |--------------------------------------------------------------------------
        */

        $todayOrders = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->whereDate('created_at', today())
            ->count();

        $todaySales = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | WEEK
        |--------------------------------------------------------------------------
        */

        $weekOrders = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count();

        $weekSales = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | MONTH
        |--------------------------------------------------------------------------
        */

        $monthOrders = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $monthSales = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | KHATIAN INVENTORY
        |--------------------------------------------------------------------------
        */

        $totalKhatians = Khatian::count();

        $activeKhatians = Khatian::where('is_active', true)->count();

        $inactiveKhatians = Khatian::where('is_active', false)->count();

        $freeKhatians = Khatian::where('price', 0)->count();

        $paidKhatians = Khatian::where('price', '>', 0)->count();


        /*
        |--------------------------------------------------------------------------
        | KHATIAN DOWNLOADS
        |--------------------------------------------------------------------------
        */

        $totalDownloads = (clone $khatianOrdersQuery)
            ->where('status', 'completed')
            ->where('download_allowed', true)
            ->sum('download_count');


        /*
        |--------------------------------------------------------------------------
        | RECENT KHATIAN ORDERS
        |--------------------------------------------------------------------------
        */

        $recentOrders = (clone $khatianOrdersQuery)
            ->with([
                'khatian.mouza',
                'khatian.surveyType'
            ])
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOP SELLING KHATIANS
        |--------------------------------------------------------------------------
        */

        $topKhatians = Order::select('khatian_id')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(amount) as total_sales')
            ->whereNotNull('khatian_id')
            ->where('status', 'completed')
            ->with([
                'khatian.mouza',
                'khatian.surveyType'
            ])
            ->groupBy('khatian_id')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | COMMON ADMIN DATA
        |--------------------------------------------------------------------------
        */

        $totalDivisions = Division::count();

        $totalDistricts = District::count();

        $totalUpazilas = Upazila::count();

        $totalMouzas = Mouza::count();

        $totalSurveyTypes = SurveyType::count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.management-dashboard', [

            'managementType' => 'khatian',

            'totalSales' => $totalSales,

            'totalOrders' => $totalOrders,

            'pendingOrders' => $pendingOrders,

            'todaySales' => $todaySales,

            'todayOrders' => $todayOrders,

            'weekSales' => $weekSales,

            'weekOrders' => $weekOrders,

            'monthSales' => $monthSales,

            'monthOrders' => $monthOrders,

            'recentOrders' => $recentOrders,

            'completedOrders' => $completedOrders,

            'cancelledOrders' => $cancelledOrders,

            'totalKhatians' => $totalKhatians,

            'activeKhatians' => $activeKhatians,

            'inactiveKhatians' => $inactiveKhatians,

            'freeKhatians' => $freeKhatians,

            'paidKhatians' => $paidKhatians,

            'totalDownloads' => $totalDownloads,

            'topKhatians' => $topKhatians,

            'totalDivisions' => $totalDivisions,

            'totalDistricts' => $totalDistricts,

            'totalUpazilas' => $totalUpazilas,

            'totalMouzas' => $totalMouzas,

            'totalSurveyTypes' => $totalSurveyTypes,
        ]);
    }
}