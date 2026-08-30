<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            {{-- Header Left --}}
            <div>
                <div class="flex flex-wrap items-center gap-3">

                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                        Edit Order #{{ $order->id }}
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
                    Update customer, payment and order information
                </p>
            </div>


            {{-- Header Actions --}}
            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('admin.orders.show', $order) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    form="order-edit-form"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-gray-300 px-7 py-3 text-sm font-bold text-black shadow-sm transition hover:bg-gray-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2"
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Save Changes
                </button>

            </div>

        </div>

    </x-slot>


    {{-- ========================================================= --}}
    {{-- PAGE CONTENT --}}
    {{-- ========================================================= --}}

    <div class="bg-gray-50 py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- ================================================= --}}
            {{-- VALIDATION ERRORS --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

                    <div class="flex gap-3">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-600"
                        >
                            !
                        </div>

                        <div>

                            <h3 class="font-bold text-red-800">
                                Please fix the following errors
                            </h3>

                            <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-5">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600"
                        >
                            ✓
                        </div>

                        <p class="text-sm font-semibold text-green-700">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- MAIN FORM --}}
            {{-- ================================================= --}}

            <form
                id="order-edit-form"
                method="POST"
                action="{{ route('admin.orders.update', $order) }}"
            >

                @csrf
                @method('PUT')


                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


                    {{-- ================================================= --}}
                    {{-- LEFT CONTENT --}}
                    {{-- ================================================= --}}

                    <div class="space-y-6 lg:col-span-2">


                        {{-- ================================================= --}}
                        {{-- CUSTOMER INFORMATION --}}
                        {{-- ================================================= --}}

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

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
                                            Update the customer's contact information
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">


                                    {{-- Customer Name --}}
                                    <div class="sm:col-span-2">

                                        <label
                                            for="customer_name"
                                            class="mb-2 block text-sm font-semibold text-gray-700"
                                        >
                                            Customer Name
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            id="customer_name"
                                            name="customer_name"
                                            value="{{ old('customer_name', $order->customer_name) }}"
                                            required
                                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                            placeholder="Enter customer name"
                                        >

                                    </div>


                                    {{-- Phone --}}
                                    <div>

                                        <label
                                            for="phone"
                                            class="mb-2 block text-sm font-semibold text-gray-700"
                                        >
                                            Phone Number
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            value="{{ old('phone', $order->phone) }}"
                                            required
                                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                            placeholder="01XXXXXXXXX"
                                        >

                                    </div>


                                    {{-- Email --}}
                                    <div>

                                        <label
                                            for="email"
                                            class="mb-2 block text-sm font-semibold text-gray-700"
                                        >
                                            Email Address
                                        </label>

                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email', $order->email) }}"
                                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                            placeholder="customer@example.com"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PAYMENT INFORMATION --}}
                        {{-- ================================================= --}}

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-200 px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600"
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

                                    <div>

                                        <h3 class="text-lg font-bold text-gray-900">
                                            Payment Information
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Manage order amount and payment method
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">


                                    {{-- Amount --}}
                                    <div>

                                        <label
                                            for="amount"
                                            class="mb-2 block text-sm font-semibold text-gray-700"
                                        >
                                            Order Amount
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <div class="relative">

                                            <span
                                                class="absolute left-4 top-1/2 -translate-y-1/2 font-semibold text-gray-500"
                                            >
                                                ৳
                                            </span>

                                            <input
                                                type="number"
                                                step="0.01"
                                                min="0"
                                                id="amount"
                                                name="amount"
                                                value="{{ old('amount', $order->amount) }}"
                                                required
                                                class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-9 pr-4 text-sm font-semibold text-gray-900 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                                placeholder="0.00"
                                            >

                                        </div>

                                    </div>


                                    {{-- Payment Method --}}
                                    <div>

                                        <label
                                            for="payment_method"
                                            class="mb-2 block text-sm font-semibold text-gray-700"
                                        >
                                            Payment Method
                                        </label>

                                        <select
                                            id="payment_method"
                                            name="payment_method"
                                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-900 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                        >

                                            <option value="">
                                                Select payment method
                                            </option>

                                            <option
                                                value="cod"
                                                @selected(old('payment_method', $order->payment_method) === 'cod')
                                            >
                                                Cash on Delivery
                                            </option>

                                            <option
                                                value="bkash"
                                                @selected(old('payment_method', $order->payment_method) === 'bkash')
                                            >
                                                bKash
                                            </option>

                                            <option
                                                value="nagad"
                                                @selected(old('payment_method', $order->payment_method) === 'nagad')
                                            >
                                                Nagad
                                            </option>

                                            <option
                                                value="card"
                                                @selected(old('payment_method', $order->payment_method) === 'card')
                                            >
                                                Card
                                            </option>

                                            <option
                                                value="bank"
                                                @selected(old('payment_method', $order->payment_method) === 'bank')
                                            >
                                                Bank Transfer
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- MAP INFORMATION --}}
                        {{-- ================================================= --}}

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

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
                                                d="M9 20l-5-2V6l5 2 5-2 5 2v12l-5-2-5 2-5-2V6l5 2m0 0v14m5-16v14"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-bold text-gray-900">
                                            Map Information
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Map associated with this order
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                @if($order->map)

                                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">

                                        <div
                                            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                                        >

                                            <div>

                                                <p
                                                    class="text-xs font-bold uppercase tracking-wider text-gray-400"
                                                >
                                                    Purchased Map
                                                </p>

                                                <h4 class="mt-2 text-lg font-bold text-gray-900">
                                                    {{ $order->map->title }}
                                                </h4>

                                            </div>


                                            <div
                                                class="rounded-xl bg-white px-4 py-3 text-right shadow-sm"
                                            >

                                                <p class="text-xs text-gray-400">
                                                    Map ID
                                                </p>

                                                <p class="font-bold text-gray-900">
                                                    #{{ $order->map->id }}
                                                </p>

                                            </div>

                                        </div>


                                        <div
                                            class="mt-5 grid grid-cols-2 gap-4 border-t border-gray-200 pt-5 sm:grid-cols-4"
                                        >

                                            {{-- Division --}}
                                            <div>

                                                <p class="text-xs text-gray-400">
                                                    Division
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                                    {{
                                                        $order->map->mouza?->upazila?->district?->division?->name_bn
                                                        ?? $order->map->mouza?->upazila?->district?->division?->name
                                                        ?? 'N/A'
                                                    }}
                                                </p>

                                            </div>


                                            {{-- District --}}
                                            <div>

                                                <p class="text-xs text-gray-400">
                                                    District
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                                    {{
                                                        $order->map->mouza?->upazila?->district?->name_bn
                                                        ?? $order->map->mouza?->upazila?->district?->name
                                                        ?? 'N/A'
                                                    }}
                                                </p>

                                            </div>


                                            {{-- Upazila --}}
                                            <div>

                                                <p class="text-xs text-gray-400">
                                                    Upazila
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                                    {{
                                                        $order->map->mouza?->upazila?->name_bn
                                                        ?? $order->map->mouza?->upazila?->name
                                                        ?? 'N/A'
                                                    }}
                                                </p>

                                            </div>


                                            {{-- Mouza --}}
                                            <div>

                                                <p class="text-xs text-gray-400">
                                                    Mouza
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                                    {{
                                                        $order->map->mouza?->name_bn
                                                        ?? $order->map->mouza?->name
                                                        ?? 'N/A'
                                                    }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                @else

                                    <div class="rounded-xl bg-gray-50 p-6 text-center">

                                        <p class="text-sm font-medium text-gray-500">
                                            Map information is unavailable.
                                        </p>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- RIGHT SIDEBAR --}}
                    {{-- ================================================= --}}

                    <div class="space-y-6">


                        {{-- ================================================= --}}
                        {{-- ORDER STATUS --}}
                        {{-- ================================================= --}}

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-200 px-6 py-5">

                                <h3 class="text-lg font-bold text-gray-900">
                                    Order Status
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Update the current order state
                                </p>

                            </div>


                            <div class="p-6">

                                <label
                                    for="status"
                                    class="mb-2 block text-sm font-semibold text-gray-700"
                                >
                                    Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-900 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                                >

                                    <option
                                        value="pending"
                                        @selected(old('status', $order->status) === 'pending')
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="paid"
                                        @selected(old('status', $order->status) === 'paid')
                                    >
                                        Paid
                                    </option>

                                    <option
                                        value="completed"
                                        @selected(old('status', $order->status) === 'completed')
                                    >
                                        Completed
                                    </option>

                                    <option
                                        value="failed"
                                        @selected(old('status', $order->status) === 'failed')
                                    >
                                        Failed
                                    </option>

                                    <option
                                        value="cancelled"
                                        @selected(old('status', $order->status) === 'cancelled')
                                    >
                                        Cancelled
                                    </option>

                                </select>


                                <div class="mt-4 rounded-xl bg-gray-50 p-4">

                                    <p
                                        class="text-xs font-semibold uppercase tracking-wider text-gray-400"
                                    >
                                        Current Status
                                    </p>

                                    <p class="mt-2 text-sm font-bold capitalize text-gray-900">
                                        {{ $order->status }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- DOWNLOAD ACCESS --}}
                        {{-- ================================================= --}}

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-200 px-6 py-5">

                                <h3 class="text-lg font-bold text-gray-900">
                                    Download Access
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Control customer's map download access
                                </p>

                            </div>


                            <div class="p-6">

                                <label class="flex cursor-pointer items-start gap-4">

                                    <input
                                        type="checkbox"
                                        name="download_allowed"
                                        value="1"
                                        @checked(old('download_allowed', $order->download_allowed))
                                        class="mt-1 h-5 w-5 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                                    >

                                    <span>

                                        <span class="block text-sm font-bold text-gray-900">
                                            Allow Download
                                        </span>

                                        <span class="mt-1 block text-xs leading-5 text-gray-500">
                                            Customer will be allowed to download the purchased map.
                                        </span>

                                    </span>

                                </label>


                                <div class="mt-5 rounded-xl bg-blue-50 p-4">

                                    <div class="flex gap-3">

                                        <svg
                                            class="mt-0.5 h-5 w-5 shrink-0 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                            />
                                        </svg>

                                        <p class="text-xs leading-5 text-blue-700">

                                            Download count currently:

                                            <strong>
                                                {{ $order->download_count }}
                                            </strong>

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ORDER META --}}
                        {{-- ================================================= --}}

                        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                Order Information
                            </p>


                            <div class="mt-4 space-y-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-gray-500">
                                        Order ID
                                    </span>

                                    <span class="text-sm font-bold text-gray-900">
                                        #{{ $order->id }}
                                    </span>

                                </div>


                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-gray-500">
                                        Downloads
                                    </span>

                                    <span class="text-sm font-bold text-gray-900">
                                        {{ $order->download_count }}
                                    </span>

                                </div>


                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-gray-500">
                                        Created
                                    </span>

                                    <span class="text-right text-sm font-semibold text-gray-900">
                                        {{ $order->created_at?->format('d M Y') }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>

