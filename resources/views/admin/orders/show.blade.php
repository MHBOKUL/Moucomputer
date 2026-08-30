<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                        Order #{{ $order->id }}
                    </h2>

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

                    <span
                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold capitalize ring-1 ring-inset {{ $statusClass }}"
                    >
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

                <p class="mt-1 text-sm text-gray-500">
                    Created {{ $order->created_at?->format('d M Y, h:i A') }}
                </p>

            </div>


            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    ← Back to Orders
                </a>

                <a
                    href="{{ route('admin.orders.edit', $order) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-300 px-5 py-2.5 text-sm font-semibold text-black shadow-sm transition hover:bg-gray-800"
                >
                    <span>✎</span>
                    Edit Order
                </a>

            </div>

        </div>

    </x-slot>


    <div class="bg-gray-50 py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- Success Message --}}

            @if(session('success'))

                <div
                    class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700"
                >

                    <svg
                        class="h-5 w-5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    {{ session('success') }}

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- TOP SUMMARY --}}
            {{-- ========================================================= --}}

            <div class="mb-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- Order ID --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Order ID
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900">
                                #{{ $order->id }}
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5h6m-7 4h8m-9 4h10m-8 4h6"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Amount --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Order Amount
                            </p>

                            <p class="mt-2 text-2xl font-bold text-green-600">
                                ৳{{ number_format($order->amount, 2) }}
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-10V6m0 12v-2"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Payment --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Payment Method
                            </p>

                            <p class="mt-2 text-xl font-bold uppercase text-gray-900">
                                {{ $order->payment_method ?? 'N/A' }}
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 7h18M5 11h2m4 0h2m4 0h2M5 17h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Downloads --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Downloads
                            </p>

                            <p class="mt-2 text-2xl font-bold text-blue-600">
                                {{ $order->download_count }}
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- MAIN CONTENT --}}
            {{-- ========================================================= --}}

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


                {{-- ===================================================== --}}
                {{-- CUSTOMER INFORMATION --}}
                {{-- ===================================================== --}}

                <div
                    class="lg:col-span-2 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >

                    <div class="border-b border-gray-200 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-9a4 4 0 100-8 4 4 0 000 8zm8-3a3 3 0 100-6 3 3 0 000 6zm-1 4h1a4 4 0 014 4"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-gray-900">
                                    Customer Information
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Customer details associated with this order
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                            <div>

                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                >
                                    Customer Name
                                </p>

                                <p class="mt-2 font-semibold text-gray-900">
                                    {{ $order->customer_name }}
                                </p>

                            </div>


                            <div>

                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                >
                                    Phone Number
                                </p>

                                <p class="mt-2 font-semibold text-gray-900">
                                    {{ $order->phone }}
                                </p>

                            </div>


                            <div>

                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                >
                                    Email Address
                                </p>

                                <p class="mt-2 font-semibold text-gray-900">
                                    {{ $order->email ?: 'Not provided' }}
                                </p>

                            </div>


                            <div>

                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                >
                                    Payment Method
                                </p>

                                <p class="mt-2 font-semibold uppercase text-gray-900">
                                    {{ $order->payment_method ?? 'N/A' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- ORDER STATUS --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >

                    <div class="border-b border-gray-200 px-6 py-5">

                        <h3 class="text-lg font-bold text-gray-900">
                            Order Status
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Current order state
                        </p>

                    </div>


                    <div class="p-6">

                        <div class="rounded-xl bg-gray-50 p-5">

                            <p
                                class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                            >
                                Current Status
                            </p>

                            <div class="mt-3">

                                <span
                                    class="inline-flex items-center rounded-full px-4 py-2 text-sm font-bold capitalize ring-1 ring-inset {{ $statusClass }}"
                                >
                                    {{ ucfirst($order->status) }}
                                </span>

                            </div>

                        </div>


                        <div class="mt-5">

                            <p
                                class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                            >
                                Created At
                            </p>

                            <p class="mt-2 font-semibold text-gray-900">
                                {{ $order->created_at?->format('d M Y, h:i A') }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- MAP INFORMATION --}}
                {{-- ===================================================== --}}

                <div
                    class="lg:col-span-2 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >

                    <div class="border-b border-gray-200 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-purple-600"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zm0-14v14m6-16v14"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-gray-900">
                                    Map Information
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Map purchased with this order
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        @if($order->map)

                            <div class="mb-6 rounded-xl bg-gray-50 p-5">

                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                >
                                    Map Title
                                </p>

                                <p class="mt-2 text-lg font-bold text-gray-900">
                                    {{ $order->map->title }}
                                </p>

                            </div>


                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                                <div>

                                    <p
                                        class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                    >
                                        Division
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{
                                            $order->map->mouza?->upazila?->district?->division?->name_bn
                                            ?? $order->map->mouza?->upazila?->district?->division?->name
                                            ?? 'N/A'
                                        }}
                                    </p>

                                </div>


                                <div>

                                    <p
                                        class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                    >
                                        District
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{
                                            $order->map->mouza?->upazila?->district?->name_bn
                                            ?? $order->map->mouza?->upazila?->district?->name
                                            ?? 'N/A'
                                        }}
                                    </p>

                                </div>


                                <div>

                                    <p
                                        class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                    >
                                        Upazila
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{
                                            $order->map->mouza?->upazila?->name_bn
                                            ?? $order->map->mouza?->upazila?->name
                                            ?? 'N/A'
                                        }}
                                    </p>

                                </div>


                                <div>

                                    <p
                                        class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                    >
                                        Mouza
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{
                                            $order->map->mouza?->name_bn
                                            ?? $order->map->mouza?->name
                                            ?? 'N/A'
                                        }}
                                    </p>

                                </div>

                            </div>

                        @else

                            <div class="py-8 text-center">

                                <p class="text-sm text-gray-500">
                                    Map information is unavailable.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- DOWNLOAD INFORMATION --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >

                    <div class="border-b border-gray-200 px-6 py-5">

                        <h3 class="text-lg font-bold text-gray-900">
                            Download Information
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Digital map access details
                        </p>

                    </div>


                    <div class="space-y-5 p-6">


                        <div>

                            <p
                                class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                            >
                                Download Access
                            </p>

                            @if($order->download_allowed)

                                <span
                                    class="mt-2 inline-flex items-center gap-2 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                    Allowed

                                </span>

                            @else

                                <span
                                    class="mt-2 inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/20"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                    Not Allowed

                                </span>

                            @endif

                        </div>


                        <div>

                            <p
                                class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                            >
                                Download Count
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900">
                                {{ $order->download_count }}
                            </p>

                        </div>


                        <div>

                            <p
                                class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                            >
                                Last Download
                            </p>

                            <p class="mt-2 text-sm font-semibold text-gray-900">
                                {{
                                    $order->downloaded_at
                                        ? $order->downloaded_at->format('d M Y, h:i A')
                                        : 'Not downloaded yet'
                                }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- ORDER DETAILS --}}
                {{-- ===================================================== --}}

                <div
                    class="lg:col-span-3 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >

                    <div class="border-b border-gray-200 px-6 py-5">

                        <h3 class="text-lg font-bold text-gray-900">
                            Order Details
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Complete information about this order
                        </p>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[700px]">

                            <thead>

                                <tr class="border-b border-gray-200 bg-gray-50">

                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500"
                                    >
                                        Field
                                    </th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500"
                                    >
                                        Information
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">


                                <tr>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                        Order ID
                                    </td>

                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        #{{ $order->id }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                        Customer
                                    </td>

                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                        {{ $order->customer_name }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                        Amount
                                    </td>

                                    <td class="px-6 py-4 text-sm font-bold text-green-600">
                                        ৳{{ number_format($order->amount, 2) }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                        Payment Method
                                    </td>

                                    <td class="px-6 py-4 text-sm font-semibold uppercase text-gray-900">
                                        {{ $order->payment_method ?? 'N/A' }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                        Status
                                    </td>

                                    <td class="px-6 py-4">

                                        <span
                                            class="inline-flex rounded-full px-3 py-1.5 text-xs font-bold capitalize ring-1 ring-inset {{ $statusClass }}"
                                        >
                                            {{ ucfirst($order->status) }}
                                        </span>

                                    </td>

                                </tr>


                                <tr>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                        Created At
                                    </td>

                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                        {{ $order->created_at?->format('d M Y, h:i A') }}
                                    </td>

                                </tr>


                            </tbody>

                        </table>

                    </div>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>