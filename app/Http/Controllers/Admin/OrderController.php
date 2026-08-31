<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Khatian;
use App\Models\Map;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC MAP ORDER
    |--------------------------------------------------------------------------
    */


    /**
     * Show public Map order form.
     */
    public function createPublic(Map $map)
    {
        /*
        |--------------------------------------------------------------------------
        | Only Active Map
        |--------------------------------------------------------------------------
        */

        abort_unless($map->is_active, 404);


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
        | Order Form
        |--------------------------------------------------------------------------
        */

        return view('orders.create', compact('map'));
    }


    /**
     * Store public Map order.
     */
    public function storePublic(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
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
        */

        $map = Map::where('is_active', true)
            ->findOrFail($validated['map_id']);


        /*
        |--------------------------------------------------------------------------
        | Create Map Order
        |--------------------------------------------------------------------------
        */

        $order = Order::create([

            'map_id' => $map->id,

            'khatian_id' => null,

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
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('orders.success', $order)
            ->with(
                'success',
                'Your order has been placed successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PUBLIC KHATIAN ORDER
    |--------------------------------------------------------------------------
    */


    /**
     * Show public Khatian order form.
     */
    public function createKhatian(Khatian $khatian)
    {
        /*
        |--------------------------------------------------------------------------
        | Only Active Khatian
        |--------------------------------------------------------------------------
        */

        abort_unless($khatian->is_active, 404);


        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */

        $khatian->load([
            'mouza.upazila.district.division',
            'surveyType',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Khatian Order Form
        |--------------------------------------------------------------------------
        */

        return view(
            'orders.khatian-create',
            compact('khatian')
        );
    }


    /**
     * Store public Khatian order.
     */
    public function storeKhatian(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'khatian_id' => [
                'required',
                'exists:khatians,id',
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
        | Find Active Khatian
        |--------------------------------------------------------------------------
        */

        $khatian = Khatian::where('is_active', true)
            ->findOrFail($validated['khatian_id']);


        /*
        |--------------------------------------------------------------------------
        | Create Khatian Order
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Price comes from database.
        | Customer cannot manipulate amount.
        |
        */

        $order = Order::create([

            'map_id' => null,

            'khatian_id' => $khatian->id,

            'customer_name' => $validated['customer_name'],

            'phone' => $validated['phone'],

            'email' => $validated['email'] ?? null,

            'amount' => $khatian->price,

            'payment_method' => $validated['payment_method'],

            'status' => 'pending',

            'download_allowed' => false,

            'download_token' => null,

            'download_count' => 0,

            'downloaded_at' => null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect To Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('orders.success', $order)
            ->with(
                'success',
                'Your Khatian order has been placed successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ORDER SUCCESS
    |--------------------------------------------------------------------------
    */


    /**
     * Show order success page.
     */
    public function success(Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */

        $order->load([

            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',

            'khatian.mouza.upazila.district.division',
            'khatian.surveyType',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Success View
        |--------------------------------------------------------------------------
        */

        return view(
            'orders.success',
            compact('order')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER PDF DOWNLOAD
    |--------------------------------------------------------------------------
    */


    /**
     * Secure customer PDF download.
     */
    public function download(Request $request, Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Download Permission
        |--------------------------------------------------------------------------
        */

        if (!$order->download_allowed) {

            abort(
                403,
                'Download is not allowed for this order.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Payment Status
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $order->status,
            ['paid', 'completed']
        )) {

            abort(
                403,
                'Payment has not been confirmed.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Download Token
        |--------------------------------------------------------------------------
        */

        if (!$order->download_token) {

            abort(
                403,
                'Download token is missing.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Verify Token
        |--------------------------------------------------------------------------
        */

        $token = $request->query('token');

        if (
            !$token ||
            !hash_equals(
                $order->download_token,
                $token
            )
        ) {

            abort(
                403,
                'Invalid download token.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Determine PDF
        |--------------------------------------------------------------------------
        */

        $filePath = null;
        $downloadName = null;


        /*
        |--------------------------------------------------------------------------
        | Map Order
        |--------------------------------------------------------------------------
        */

        if ($order->map_id) {

            $order->load('map');

            if (!$order->map) {

                abort(
                    404,
                    'Map not found.'
                );

            }


            if (empty($order->map->file_path)) {

                abort(
                    404,
                    'Map file not found.'
                );

            }


            $filePath = $order->map->file_path;

            $downloadName =
                $order->map->file_name
                ?: basename($filePath);

        }


        /*
        |--------------------------------------------------------------------------
        | Khatian Order
        |--------------------------------------------------------------------------
        */

        elseif ($order->khatian_id) {

            $order->load('khatian');

            if (!$order->khatian) {

                abort(
                    404,
                    'Khatian not found.'
                );

            }


            if (empty($order->khatian->pdf_path)) {

                abort(
                    404,
                    'Khatian PDF file not found.'
                );

            }


            $filePath = $order->khatian->pdf_path;

            $downloadName =
                'Khatian-' .
                $order->khatian->khatian_number .
                '.pdf';

        }


        /*
        |--------------------------------------------------------------------------
        | Invalid Order
        |--------------------------------------------------------------------------
        */

        else {

            abort(
                404,
                'Order document not found.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Check Physical File
        |--------------------------------------------------------------------------
        */

        if (
            !Storage::disk('public')
                ->exists($filePath)
        ) {

            abort(
                404,
                'PDF file does not exist.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Physical Path
        |--------------------------------------------------------------------------
        */

        $physicalPath =
            Storage::disk('public')
                ->path($filePath);


        /*
        |--------------------------------------------------------------------------
        | Download Statistics
        |--------------------------------------------------------------------------
        */

        $order->increment(
            'download_count'
        );

        $order->update([
            'downloaded_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */

        return response()->download(

            $physicalPath,

            $downloadName,

            [
                'Content-Type' =>
                    'application/pdf',
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
        | Orders
        |--------------------------------------------------------------------------
        */

        $orders = Order::with([

            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',

            'khatian.mouza.upazila.district.division',
            'khatian.surveyType',

        ])
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Sales Statistics
        |--------------------------------------------------------------------------
        */

        $todaySales = Order::whereDate(
            'created_at',
            today()
        )
            ->whereIn(
                'status',
                ['paid', 'completed']
            )
            ->sum('amount');


        $yesterdaySales = Order::whereDate(
            'created_at',
            today()->subDay()
        )
            ->whereIn(
                'status',
                ['paid', 'completed']
            )
            ->sum('amount');


        $weekSales = Order::whereBetween(
            'created_at',
            [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ]
        )
            ->whereIn(
                'status',
                ['paid', 'completed']
            )
            ->sum('amount');


        $monthSales = Order::whereBetween(
            'created_at',
            [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ]
        )
            ->whereIn(
                'status',
                ['paid', 'completed']
            )
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Order Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders =
            Order::count();


        $paidOrders =
            Order::whereIn(
                'status',
                ['paid', 'completed']
            )->count();


        $pendingOrders =
            Order::where(
                'status',
                'pending'
            )->count();


        $totalDownloads =
            Order::sum('download_count');


        /*
        |--------------------------------------------------------------------------
        | Best Selling Maps
        |--------------------------------------------------------------------------
        */

        $bestSellingMaps = Order::with('map')
            ->whereNotNull('map_id')
            ->whereIn(
                'status',
                ['paid', 'completed']
            )
            ->selectRaw(
                'map_id, COUNT(*) as total_sales, SUM(amount) as total_revenue'
            )
            ->groupBy('map_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Best Selling Khatians
        |--------------------------------------------------------------------------
        */

        $bestSellingKhatians = Order::with('khatian')
            ->whereNotNull('khatian_id')
            ->whereIn(
                'status',
                ['paid', 'completed']
            )
            ->selectRaw(
                'khatian_id, COUNT(*) as total_sales, SUM(amount) as total_revenue'
            )
            ->groupBy('khatian_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.orders.index',
            compact(

                'orders',

                'todaySales',

                'yesterdaySales',

                'weekSales',

                'monthSales',

                'totalOrders',

                'paidOrders',

                'pendingOrders',

                'totalDownloads',

                'bestSellingMaps',

                'bestSellingKhatians',

            )
        );
    }


    /**
     * Display specific order.
     */
    public function show(Order $order)
    {
        $order->load([

            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',

            'khatian.mouza.upazila.district.division',
            'khatian.surveyType',

        ]);


        return view(
            'admin.orders.show',
            compact('order')
        );
    }


    /**
     * Show order edit form.
     */
    public function edit(Order $order)
    {
        $order->load([

            'map.mouza.upazila.district.division',
            'map.mouza.surveyType',

            'khatian.mouza.upazila.district.division',
            'khatian.surveyType',

        ]);


        return view(
            'admin.orders.edit',
            compact('order')
        );
    }


    /**
     * Update order.
     */
    public function update(
        Request $request,
        Order $order
    ) {

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

        $validated['download_allowed'] =
            $request->boolean(
                'download_allowed'
            );


        /*
        |--------------------------------------------------------------------------
        | Generate Download Token
        |--------------------------------------------------------------------------
        */

        if (
            $validated['download_allowed'] === true &&
            in_array(
                $validated['status'],
                ['paid', 'completed']
            )
        ) {

            if (!$order->download_token) {

                $validated['download_token'] =
                    Str::random(64);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Remove Download Permission
        |--------------------------------------------------------------------------
        */

        if (
            $validated['download_allowed'] === false
        ) {

            $validated['download_token'] = null;

        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $order->update(
            $validated
        );


        return redirect()
            ->route(
                'admin.orders.show',
                $order
            )
            ->with(
                'success',
                'Order updated successfully.'
            );
    }


    /**
     * Update order status.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {

        $validated = $request->validate([

            'status' => [
                'required',
                'in:pending,paid,failed,cancelled,completed',
            ],

        ]);


        $data = [

            'status' =>
                $validated['status'],

        ];


        /*
        |--------------------------------------------------------------------------
        | Paid / Completed
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $validated['status'],
                ['paid', 'completed']
            )
        ) {

            $data['download_allowed'] = true;


            if (!$order->download_token) {

                $data['download_token'] =
                    Str::random(64);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Pending / Failed / Cancelled
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $validated['status'],
                [
                    'pending',
                    'failed',
                    'cancelled',
                ]
            )
        ) {

            $data['download_allowed'] =
                false;

            $data['download_token'] =
                null;

        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $order->update($data);


        return redirect()
            ->back()
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }


    /**
     * Delete order.
     */
    public function destroy(Order $order)
    {
        $order->delete();


        return redirect()
            ->route(
                'admin.orders.index'
            )
            ->with(
                'success',
                'Order deleted successfully.'
            );
    }
}