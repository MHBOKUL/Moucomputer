
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Order Management
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Monitor sales, orders and customer activity
                </p>
            </div>

            <div class="hidden sm:flex items-center gap-2 rounded-lg bg-gray-100 px-3 py-2 text-sm font-medium text-gray-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4h18M3 10h18M3 16h18M3 22h18"/>
                </svg>
                Orders
            </div>
        </div>
    </x-slot>


    <div class="bg-gray-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>

                    {{ session('success') }}
                </div>
            @endif


            {{-- ========================================================= --}}
            {{-- SALES OVERVIEW --}}
            {{-- ========================================================= --}}

            <div class="mb-8">

                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900">
                        Sales Overview
                    </h3>

                    <p class="text-sm text-gray-500">
                        Revenue from paid and completed orders
                    </p>
                </div>


                {{-- 4 CARDS IN ONE ROW --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Today --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Today's Sales
                                </p>

                                <h4 class="mt-3 text-2xl font-bold tracking-tight text-gray-900">
                                    ৳{{ number_format($todaySales, 2) }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Revenue generated today
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-10V6m0 12v-2M6 12a6 6 0 1012 0 6 6 0 00-12 0z"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Yesterday --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Yesterday
                                </p>

                                <h4 class="mt-3 text-2xl font-bold tracking-tight text-gray-900">
                                    ৳{{ number_format($yesterdaySales, 2) }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Previous day's revenue
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v8m-3-3l3 3 3-3M5 5h14"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Week --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    This Week
                                </p>

                                <h4 class="mt-3 text-2xl font-bold tracking-tight text-gray-900">
                                    ৳{{ number_format($weekSales, 2) }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Current week's revenue
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12h18M3 6h18M3 18h18"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Month --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    This Month
                                </p>

                                <h4 class="mt-3 text-2xl font-bold tracking-tight text-gray-900">
                                    ৳{{ number_format($monthSales, 2) }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Current month's revenue
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 19h16M6 16V8m4 8V5m4 11v-6m4 6V9"/>
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>
            </div>


            {{-- ========================================================= --}}
            {{-- ORDER STATISTICS --}}
            {{-- ========================================================= --}}

            <div class="mb-8">

                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900">
                        Order Statistics
                    </h3>

                    <p class="text-sm text-gray-500">
                        Current order and download activity
                    </p>
                </div>


                {{-- 4 CARDS IN ONE ROW --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Total Orders --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Total Orders
                                </p>

                                <h4 class="mt-3 text-2xl font-bold text-gray-900">
                                    {{ $totalOrders }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    All orders
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5h6m-7 4h8m-9 4h10m-8 4h6M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Paid --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Paid Orders
                                </p>

                                <h4 class="mt-3 text-2xl font-bold text-green-600">
                                    {{ $paidOrders }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Payment confirmed
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Pending --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Pending Orders
                                </p>

                                <h4 class="mt-3 text-2xl font-bold text-yellow-600">
                                    {{ $pendingOrders }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Requires attention
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-yellow-50 text-yellow-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6l4 2m4-2a8 8 0 11-16 0 8 8 0 0116 0z"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Downloads --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Total Downloads
                                </p>

                                <h4 class="mt-3 text-2xl font-bold text-blue-600">
                                    {{ $totalDownloads }}
                                </h4>

                                <p class="mt-2 text-xs text-gray-400">
                                    Map downloads
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"/>
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>
            </div>


            {{-- ========================================================= --}}
            {{-- RECENT ORDERS --}}
            {{-- ========================================================= --}}

            <div class="mb-8 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Table Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5">

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">
                            Recent Orders
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Latest customer purchases
                        </p>
                    </div>

                    <div class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-bold text-gray-600">
                        {{ $orders->count() }} Orders
                    </div>

                </div>


                @if($orders->count())

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[900px]">

                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50">

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Customer
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Map
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Amount
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Payment
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Action
                                    </th>

                                </tr>
                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach($orders as $order)

                                    <tr class="transition hover:bg-gray-50">

                                        {{-- Customer --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-900 text-sm font-bold text-white">
                                                    {{ strtoupper(substr($order->customer_name, 0, 1)) }}
                                                </div>

                                                <div>
                                                    <p class="font-semibold text-gray-900">
                                                        {{ $order->customer_name }}
                                                    </p>

                                                    <p class="mt-0.5 text-xs text-gray-500">
                                                        {{ $order->phone }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Map --}}
                                        <td class="px-6 py-5">

                                            <p class="max-w-xs truncate font-semibold text-gray-800">
                                                {{ $order->map?->title ?? 'Map Deleted' }}
                                            </p>

                                            @if($order->map?->mouza)

                                                <p class="mt-1 text-xs text-gray-500">
                                                    {{ $order->map->mouza->name }}
                                                </p>

                                            @endif

                                        </td>


                                        {{-- Amount --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <span class="font-bold text-gray-900">
                                                ৳{{ number_format($order->amount, 2) }}
                                            </span>

                                        </td>


                                        {{-- Payment --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <span class="inline-flex rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-bold uppercase text-gray-600">
                                                {{ $order->payment_method ?? 'N/A' }}
                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
                                                    'paid' => 'bg-green-50 text-green-700 ring-green-600/20',
                                                    'completed' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
                                                    'failed' => 'bg-red-50 text-red-700 ring-red-600/20',
                                                    'cancelled' => 'bg-gray-100 text-gray-600 ring-gray-500/20',
                                                ];

                                                $statusClass = $statusClasses[$order->status]
                                                    ?? 'bg-gray-100 text-gray-600 ring-gray-500/20';
                                            @endphp

                                            <span class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold capitalize ring-1 ring-inset {{ $statusClass }}">
                                                {{ ucfirst($order->status) }}
                                            </span>

                                        </td>


                                        {{-- Action --}}
                                        <td class="px-6 py-5 text-right">

                                            <a
                                                href="{{ route('admin.orders.show', $order) }}"
                                                class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-xs font-bold text-gray-700 shadow-sm transition hover:border-gray-900 hover:bg-gray-900 hover:text-white"
                                            >
                                                View

                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M9 5l7 7-7 7"/>
                                                </svg>

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100">

                            <svg class="h-7 w-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                            </svg>

                        </div>

                        <h4 class="mt-4 text-lg font-bold text-gray-900">
                            No orders yet
                        </h4>

                        <p class="mt-1 text-sm text-gray-500">
                            Customer orders will appear here.
                        </p>

                    </div>

                @endif

            </div>


            {{-- ========================================================= --}}
            {{-- BEST SELLING MAPS --}}
            {{-- ========================================================= --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-200 px-6 py-5">

                    <h3 class="text-lg font-bold text-gray-900">
                        Best Selling Maps
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Top maps based on completed purchases
                    </p>

                </div>


                @if($bestSellingMaps->count())

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[650px]">

                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50">

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Map
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Sales
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Revenue
                                    </th>

                                </tr>
                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach($bestSellingMaps as $item)

                                    <tr class="transition hover:bg-gray-50">

                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 text-gray-600">

                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zm0-12v12m6-14v12"/>
                                                    </svg>

                                                </div>

                                                <div>

                                                    <p class="font-semibold text-gray-900">
                                                        {{ $item->map?->title ?? 'Map Deleted' }}
                                                    </p>

                                                    @if($item->map?->mouza)

                                                        <p class="mt-1 text-xs text-gray-500">
                                                            {{ $item->map->mouza->name }}
                                                        </p>

                                                    @endif

                                                </div>

                                            </div>

                                        </td>


                                        <td class="px-6 py-5 text-center">

                                            <span class="inline-flex min-w-[40px] justify-center rounded-lg bg-gray-100 px-3 py-1.5 text-sm font-bold text-gray-700">
                                                {{ $item->total_sales }}
                                            </span>

                                        </td>


                                        <td class="whitespace-nowrap px-6 py-5 text-right">

                                            <span class="font-bold text-green-600">
                                                ৳{{ number_format($item->total_revenue, 2) }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="px-6 py-12 text-center text-sm text-gray-500">
                        No sales data available yet.
                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>
