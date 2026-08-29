<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-2xl font-bold text-gray-800">
                Order Management
            </h2>

            <p class="text-sm text-gray-500">
                Sales, orders and download activity overview
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            {{-- ========================================================= --}}
            {{-- SALES OVERVIEW --}}
            {{-- ========================================================= --}}

            <div class="mb-8">

                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-800">
                        Sales Overview
                    </h3>

                    <p class="text-sm text-gray-500">
                        Revenue from paid and completed orders
                    </p>
                </div>


                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Today --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Today's Sales
                                </p>

                                <h4 class="mt-2 text-3xl font-bold text-gray-900">
                                    ৳{{ number_format($todaySales, 2) }}
                                </h4>
                            </div>

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-xl">
                                ৳
                            </div>

                        </div>
                    </div>


                    {{-- Yesterday --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Yesterday
                                </p>

                                <h4 class="mt-2 text-3xl font-bold text-gray-900">
                                    ৳{{ number_format($yesterdaySales, 2) }}
                                </h4>
                            </div>

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl">
                                ৳
                            </div>

                        </div>
                    </div>


                    {{-- This Week --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    This Week
                                </p>

                                <h4 class="mt-2 text-3xl font-bold text-gray-900">
                                    ৳{{ number_format($weekSales, 2) }}
                                </h4>
                            </div>

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-xl">
                                ৳
                            </div>

                        </div>
                    </div>


                    {{-- This Month --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    This Month
                                </p>

                                <h4 class="mt-2 text-3xl font-bold text-gray-900">
                                    ৳{{ number_format($monthSales, 2) }}
                                </h4>
                            </div>

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-xl">
                                ৳
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            {{-- ========================================================= --}}
            {{-- ORDER STATISTICS --}}
            {{-- ========================================================= --}}

            <div class="mb-8">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Total Orders --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Total Orders
                        </p>

                        <div class="mt-3 flex items-end justify-between">
                            <h4 class="text-3xl font-bold text-gray-900">
                                {{ $totalOrders }}
                            </h4>

                            <span class="text-2xl">
                                📦
                            </span>
                        </div>
                    </div>


                    {{-- Paid Orders --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Paid Orders
                        </p>

                        <div class="mt-3 flex items-end justify-between">
                            <h4 class="text-3xl font-bold text-green-600">
                                {{ $paidOrders }}
                            </h4>

                            <span class="text-2xl">
                                ✓
                            </span>
                        </div>
                    </div>


                    {{-- Pending --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Pending Orders
                        </p>

                        <div class="mt-3 flex items-end justify-between">
                            <h4 class="text-3xl font-bold text-yellow-600">
                                {{ $pendingOrders }}
                            </h4>

                            <span class="text-2xl">
                                ⏳
                            </span>
                        </div>
                    </div>


                    {{-- Downloads --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Total Downloads
                        </p>

                        <div class="mt-3 flex items-end justify-between">
                            <h4 class="text-3xl font-bold text-blue-600">
                                {{ $totalDownloads }}
                            </h4>

                            <span class="text-2xl">
                                ↓
                            </span>
                        </div>
                    </div>

                </div>
            </div>


            {{-- ========================================================= --}}
            {{-- RECENT ORDERS --}}
            {{-- ========================================================= --}}

            <div class="mb-8 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="flex flex-col gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">
                            Recent Orders
                        </h3>

                        <p class="text-sm text-gray-500">
                            Latest customer purchases
                        </p>
                    </div>

                    <span class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-600">
                        {{ $orders->count() }} Orders
                    </span>

                </div>


                @if($orders->count())

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Customer
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Map
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Amount
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Payment
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100 bg-white">

                                @foreach($orders as $order)

                                    <tr class="transition hover:bg-gray-50">

                                        {{-- Customer --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="font-semibold text-gray-800">
                                                {{ $order->customer_name }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $order->phone }}
                                            </div>

                                            @if($order->email)
                                                <div class="text-xs text-gray-400">
                                                    {{ $order->email }}
                                                </div>
                                            @endif

                                        </td>


                                        {{-- Map --}}
                                        <td class="px-6 py-4">

                                            <div class="max-w-xs font-medium text-gray-800">
                                                {{ $order->map?->title ?? 'Map Deleted' }}
                                            </div>

                                            @if($order->map?->mouza)
                                                <div class="text-xs text-gray-500">
                                                    {{ $order->map->mouza->name }}
                                                </div>
                                            @endif

                                        </td>


                                        {{-- Amount --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="font-bold text-gray-900">
                                                ৳{{ number_format($order->amount, 2) }}
                                            </span>

                                        </td>


                                        {{-- Payment --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs font-semibold capitalize text-gray-700">
                                                {{ $order->payment_method ?? 'N/A' }}
                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                                    'paid' => 'bg-green-100 text-green-700',
                                                    'completed' => 'bg-blue-100 text-blue-700',
                                                    'failed' => 'bg-red-100 text-red-700',
                                                    'cancelled' => 'bg-gray-100 text-gray-700',
                                                ];

                                                $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700';
                                            @endphp

                                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">
                                                {{ ucfirst($order->status) }}
                                            </span>

                                        </td>


                                        {{-- Action --}}
                                        <td class="whitespace-nowrap px-6 py-4 text-right">

                                            <a
                                                href="{{ route('admin.orders.show', $order) }}"
                                                class="inline-flex items-center rounded-lg bg-gray-900 px-3 py-2 text-xs font-semibold text-white transition hover:bg-gray-700"
                                            >
                                                View
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 text-2xl">
                            📦
                        </div>

                        <h4 class="text-lg font-bold text-gray-800">
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

                    <h3 class="text-lg font-bold text-gray-800">
                        Best Selling Maps
                    </h3>

                    <p class="text-sm text-gray-500">
                        Top maps based on completed purchases
                    </p>

                </div>


                @if($bestSellingMaps->count())

                    <div class="divide-y divide-gray-100">

                        @foreach($bestSellingMaps as $item)

                            <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <h4 class="font-semibold text-gray-800">
                                        {{ $item->map?->title ?? 'Map Deleted' }}
                                    </h4>

                                    @if($item->map?->mouza)
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $item->map->mouza->name }}
                                        </p>
                                    @endif

                                </div>


                                <div class="flex items-center gap-8">

                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Sales
                                        </p>

                                        <p class="font-bold text-gray-800">
                                            {{ $item->total_sales }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Revenue
                                        </p>

                                        <p class="font-bold text-green-600">
                                            ৳{{ number_format($item->total_revenue, 2) }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        @endforeach

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
