<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Order #{{ $order->id }}
                        </h2>

                        @if($order->status === 'completed')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                Completed
                            </span>
                        @elseif($order->status === 'pending')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        @elseif($order->status === 'cancelled')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                Cancelled
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">
                                {{ ucfirst($order->status) }}
                            </span>
                        @endif
                    </div>

                    <p class="text-sm text-gray-500 mt-1">
                        Created {{ $order->created_at?->format('d M Y, h:i A') }}
                    </p>
                </div>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition"
                >
                    ← Back to Orders
                </a>

            </div>


            {{-- Main Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Customer Information --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Customer Information
                        </h3>
                    </div>

                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Customer Name
                                </p>

                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $order->customer_name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Phone
                                </p>

                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $order->phone }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Email
                                </p>

                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $order->email ?: 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Payment Method
                                </p>

                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ strtoupper($order->payment_method) }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>


                {{-- Amount --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="p-6">

                        <p class="text-sm text-gray-500">
                            Order Amount
                        </p>

                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            ৳{{ number_format($order->amount, 2) }}
                        </p>

                        <div class="mt-6 pt-5 border-t border-gray-200">

                            <p class="text-sm text-gray-500">
                                Payment
                            </p>

                            <p class="mt-1 font-semibold">
                                {{ strtoupper($order->payment_method) }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Map Information --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Map Information
                        </h3>
                    </div>

                    <div class="p-6">

                        @if($order->map)

                            <div class="space-y-5">

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Map Title
                                    </p>

                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $order->map->title }}
                                    </p>
                                </div>


                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Division
                                        </p>

                                        <p class="mt-1 font-medium">
                                            {{ $order->map->mouza?->upazila?->district?->division?->name_bn
                                                ?? $order->map->mouza?->upazila?->district?->division?->name
                                                ?? 'N/A' }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-sm text-gray-500">
                                            District
                                        </p>

                                        <p class="mt-1 font-medium">
                                            {{ $order->map->mouza?->upazila?->district?->name_bn
                                                ?? $order->map->mouza?->upazila?->district?->name
                                                ?? 'N/A' }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Upazila
                                        </p>

                                        <p class="mt-1 font-medium">
                                            {{ $order->map->mouza?->upazila?->name_bn
                                                ?? $order->map->mouza?->upazila?->name
                                                ?? 'N/A' }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Mouza
                                        </p>

                                        <p class="mt-1 font-medium">
                                            {{ $order->map->mouza?->name_bn
                                                ?? $order->map->mouza?->name
                                                ?? 'N/A' }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        @else

                            <p class="text-gray-500">
                                Map information unavailable.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Download Information --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Download Information
                        </h3>
                    </div>

                    <div class="p-6 space-y-5">

                        <div>
                            <p class="text-sm text-gray-500">
                                Download Allowed
                            </p>

                            @if($order->download_allowed)

                                <span class="inline-block mt-1 px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                    Yes
                                </span>

                            @else

                                <span class="inline-block mt-1 px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                    No
                                </span>

                            @endif
                        </div>


                        <div>
                            <p class="text-sm text-gray-500">
                                Download Count
                            </p>

                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $order->download_count }}
                            </p>
                        </div>


                        <div>
                            <p class="text-sm text-gray-500">
                                Last Download
                            </p>

                            <p class="mt-1 font-medium text-gray-900">
                                {{ $order->downloaded_at
                                    ? $order->downloaded_at->format('d M Y, h:i A')
                                    : 'Not downloaded yet' }}
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Order Details --}}
                <div class="lg:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-200">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Order Details
                        </h3>
                    </div>

                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Order ID
                                </p>

                                <p class="mt-1 font-bold text-gray-900">
                                    #{{ $order->id }}
                                </p>
                            </div>


                            <div>
                                <p class="text-sm text-gray-500">
                                    Amount
                                </p>

                                <p class="mt-1 font-bold text-gray-900">
                                    ৳{{ number_format($order->amount, 2) }}
                                </p>
                            </div>


                            <div>
                                <p class="text-sm text-gray-500">
                                    Status
                                </p>

                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ ucfirst($order->status) }}
                                </p>
                            </div>


                            <div>
                                <p class="text-sm text-gray-500">
                                    Created At
                                </p>

                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $order->created_at?->format('d M Y, h:i A') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>