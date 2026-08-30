<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Map;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC ORDER
    |--------------------------------------------------------------------------
    */


    /**
     * Show public order form.
     */
    public function createPublic(Map $map)
    {
        /*
        |--------------------------------------------------------------------------
        | Only Active Map
        |--------------------------------------------------------------------------
        */

        if (!$map->is_active) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Map Relationships
        |--------------------------------------------------------------------------
        */

        $map->load([
            'mouza.upazila.district.division',
            'mouza.surveyType',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Public Order Form
        |--------------------------------------------------------------------------
        */

        return view('orders.create', compact('map'));
    }


    /**
     * Store public order.
     */
    public function storePublic(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Customer Information
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'map_id' => [
                'required',
                'exists:maps,id',
            ],

            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'payment_method' => [
                'required',
                'in:cod,bkash,nagad,card,bank',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Find Active Map
        |--------------------------------------------------------------------------
        |
        | Customer cannot order an inactive map.
        |
        */

        $map = Map::where('is_active', true)
            ->findOrFail($validated['map_id']);


        /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Amount is taken directly from database.
        | Customer cannot manipulate the price.
        |
        */

        $order = Order::create([

            'map_id' => $map->id,

            'customer_name' => $validated['customer_name'],

            'phone' => $validated['phone'],

            'email' => $validated['email'] ?? null,

            'amount' => $map->price,

            'payment_method' => $validated['payment_method'],

            'status' => 'pending',

            'download_allowed' => false,

            'download_token' => null,

            'download_count' => 0,

            'downloaded_at' => null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect To Order Success Page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('orders.success', $order)
            ->with(
                'success',
                'Your order has been placed successfully.'
            );
    }


    /**
     * Show order success page.
     */
    public function success(Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Map Information
        |--------------------------------------------------------------------------
        */

        $order->load([
            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Success View
        |--------------------------------------------------------------------------
        */

        return view('orders.success', compact('order'));
    }


    /**
     * Secure customer PDF download.
     */
    public function download(Request $request, Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Check Download Permission
        |--------------------------------------------------------------------------
        */

        if (!$order->download_allowed) {
            abort(403, 'Download is not allowed for this order.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check Payment Status
        |--------------------------------------------------------------------------
        */

        if (!in_array($order->status, ['paid', 'completed'])) {
            abort(403, 'Payment has not been confirmed.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check Map
        |--------------------------------------------------------------------------
        */

        if (!$order->map) {
            abort(404, 'Map not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check Map File
        |--------------------------------------------------------------------------
        */

        if (empty($order->map->file_path)) {
            abort(404, 'Map file not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check PDF Exists
        |--------------------------------------------------------------------------
        */

        if (!Storage::disk('public')->exists($order->map->file_path)) {
            abort(404, 'Map PDF file does not exist.');
        }


        /*
        |--------------------------------------------------------------------------
        | Download Token
        |--------------------------------------------------------------------------
        |
        | Token must exist before download.
        |
        */

        if (!$order->download_token) {
            abort(403, 'Download token is missing.');
        }


        /*
        |--------------------------------------------------------------------------
        | Optional Token Verification
        |--------------------------------------------------------------------------
        */

        $token = $request->query('token');

        if (!$token || !hash_equals(
            $order->download_token,
            $token
        )) {
            abort(403, 'Invalid download token.');
        }


        /*
        |--------------------------------------------------------------------------
        | Physical PDF Path
        |--------------------------------------------------------------------------
        */

        $filePath = Storage::disk('public')
            ->path($order->map->file_path);


        /*
        |--------------------------------------------------------------------------
        | Download File Name
        |--------------------------------------------------------------------------
        */

        $downloadName = $order->map->file_name
            ?: basename($order->map->file_path);


        /*
        |--------------------------------------------------------------------------
        | Update Download Statistics
        |--------------------------------------------------------------------------
        */

        $order->increment('download_count');

        $order->update([
            'downloaded_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Download PDF
        |--------------------------------------------------------------------------
        */

        return response()->download(
            $filePath,
            $downloadName,
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN ORDER MANAGEMENT
    |--------------------------------------------------------------------------
    */


    /**
     * Display order dashboard.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

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
            ->selectRaw(
                'map_id, COUNT(*) as total_sales, SUM(amount) as total_revenue'
            )
            ->groupBy('map_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Admin Order Dashboard
        |--------------------------------------------------------------------------
        */

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
     * Show the order edit form.
     */
    public function edit(Order $order)
    {
        $order->load([
            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',
        ]);

        return view('admin.orders.edit', compact('order'));
    }


    /**
     * Update an order.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([

            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'nullable',
                'string',
                'max:50',
            ],

            'status' => [
                'required',
                'in:pending,paid,failed,cancelled,completed',
            ],

            'download_allowed' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Download Permission
        |--------------------------------------------------------------------------
        */

        $validated['download_allowed'] = $request->boolean(
            'download_allowed'
        );


        /*
        |--------------------------------------------------------------------------
        | Generate Download Token
        |--------------------------------------------------------------------------
        |
        | Token is generated when download permission is enabled.
        |
        */

        if (
            $validated['download_allowed'] === true &&
            in_array($validated['status'], ['paid', 'completed'])
        ) {
            if (!$order->download_token) {
                $validated['download_token'] = Str::random(64);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Download Permission
        |--------------------------------------------------------------------------
        |
        | If download is disabled, remove the token.
        |
        */

        if ($validated['download_allowed'] === false) {
            $validated['download_token'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Order
        |--------------------------------------------------------------------------
        */

        $order->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.orders.show', $order)
            ->with(
                'success',
                'Order updated successfully.'
            );
    }


    /**
     * Update order status only.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([

            'status' => [
                'required',
                'in:pending,paid,failed,cancelled,completed',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Prepare Update Data
        |--------------------------------------------------------------------------
        */

        $data = [
            'status' => $validated['status'],
        ];


        /*
        |--------------------------------------------------------------------------
        | Automatically Enable Download
        |--------------------------------------------------------------------------
        |
        | When admin marks the order as paid/completed,
        | generate token and allow download.
        |
        */

        if (in_array($validated['status'], ['paid', 'completed'])) {

            $data['download_allowed'] = true;

            if (!$order->download_token) {
                $data['download_token'] = Str::random(64);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Disable Download For Failed/Cancelled/Pending
        |--------------------------------------------------------------------------
        */

        if (in_array($validated['status'], [
            'pending',
            'failed',
            'cancelled',
        ])) {

            $data['download_allowed'] = false;

            $data['download_token'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Order
        |--------------------------------------------------------------------------
        */

        $order->update($data);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->back()
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }


    /**
     * Delete an order.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Order deleted successfully.'
            );
    }
}