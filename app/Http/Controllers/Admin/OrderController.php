<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display order dashboard.
     */
    public function index()
    {
        $orders = Order::with([
            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',
        ])
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Sales Statistics
        |--------------------------------------------------------------------------
        */

        $todaySales = Order::whereDate('created_at', today())
            ->whereIn('status', ['paid', 'completed'])
            ->sum('amount');

        $yesterdaySales = Order::whereDate(
            'created_at',
            today()->subDay()
        )
            ->whereIn('status', ['paid', 'completed'])
            ->sum('amount');

        $weekSales = Order::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])
            ->whereIn('status', ['paid', 'completed'])
            ->sum('amount');

        $monthSales = Order::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ])
            ->whereIn('status', ['paid', 'completed'])
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Order Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        $paidOrders = Order::whereIn('status', [
            'paid',
            'completed',
        ])->count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $totalDownloads = Order::sum('download_count');

        /*
        |--------------------------------------------------------------------------
        | Best Selling Maps
        |--------------------------------------------------------------------------
        */

        $bestSellingMaps = Order::with('map')
            ->whereIn('status', ['paid', 'completed'])
            ->selectRaw('map_id, COUNT(*) as total_sales, SUM(amount) as total_revenue')
            ->groupBy('map_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();

        return view('admin.orders.index', compact(
            'orders',
            'todaySales',
            'yesterdaySales',
            'weekSales',
            'monthSales',
            'totalOrders',
            'paidOrders',
            'pendingOrders',
            'totalDownloads',
            'bestSellingMaps'
        ));
    }


    /**
     * Display a specific order.
     */
    public function show(Order $order)
    {
        $order->load([
            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',
        ]);

        return view('admin.orders.show', compact('order'));
    }


    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,paid,failed,cancelled,completed',
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Order status updated successfully.');
    }


    /**
     * Delete an order.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
