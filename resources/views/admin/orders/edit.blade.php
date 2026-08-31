<x-app-layout>

    {{-- =========================================================
        CUSTOM CSS
    ========================================================== --}}
    <style>
        .order-page {
            background:
                linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
            min-height: calc(100vh - 70px);
        }

        .order-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow:
                0 2px 5px rgba(15, 23, 42, 0.04),
                0 8px 24px rgba(15, 23, 42, 0.05);
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .order-card:hover {
            box-shadow:
                0 4px 8px rgba(15, 23, 42, 0.05),
                0 12px 30px rgba(15, 23, 42, 0.07);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(
                180deg,
                #ffffff 0%,
                #f8fafc 100%
            );
        }

        .section-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .field-input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 11px;
            background: #fff;
            padding: 12px 14px;
            font-size: 14px;
            color: #111827;
            outline: none;
            transition: all .2s ease;
        }

        .field-input:hover {
            border-color: #9ca3af;
        }

        .field-input:focus {
            border-color: #334155;
            box-shadow: 0 0 0 3px rgba(51, 65, 85, .08);
        }

        .field-input::placeholder {
            color: #9ca3af;
        }

        .field-select {
            appearance: auto;
            cursor: pointer;
        }

        .info-box {
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            background: #f8fafc;
        }

        .map-box {
            border: 1px solid #dbe3ec;
            border-radius: 14px;
            background:
                linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);
        }

        .meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .meta-row:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .meta-label {
            font-size: 13px;
            color: #64748b;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            text-align: right;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 800;
            border: 1px solid transparent;
        }

        .status-pending {
            background: #fff7ed;
            color: #c2410c;
            border-color: #fed7aa;
        }

        .status-paid {
            background: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0;
        }

        .status-completed {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        .status-failed {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .status-cancelled {
            background: #f1f5f9;
            color: #475569;
            border-color: #cbd5e1;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .top-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            padding: 10px 17px;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .btn-cancel {
            color: #374151;
            background: #fff;
            border: 1px solid #d1d5db;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #9ca3af;
        }

        .btn-save {
            color: #fff;
            background: #1e293b;
            border: 1px solid #1e293b;
            box-shadow: 0 2px 5px rgba(15, 23, 42, .15);
        }

        .btn-save:hover {
            background: #0f172a;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(15, 23, 42, .18);
        }

        .btn-save:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 41, 59, .15);
        }

        .alert-box {
            border-radius: 13px;
            padding: 15px 18px;
            margin-bottom: 22px;
        }

        .error-alert {
            background: #fff7f7;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .success-alert {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .map-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
        }

        .location-item {
            padding: 13px 14px;
            border-radius: 10px;
            background: rgba(255,255,255,.75);
            border: 1px solid #e2e8f0;
        }

        .location-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #94a3b8;
        }

        .location-value {
            margin-top: 4px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
        }

        .sidebar-note {
            border-radius: 12px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 14px;
        }

        .custom-checkbox {
            width: 19px;
            height: 19px;
            accent-color: #1e293b;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .card-header {
                padding: 17px;
            }

            .mobile-stack {
                flex-direction: column;
                align-items: stretch !important;
            }

            .mobile-stack .top-action {
                width: 100%;
            }
        }
    </style>


    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-slot name="header">

        @php
            $statusClasses = [
                'pending' => 'status-pending',
                'paid' => 'status-paid',
                'completed' => 'status-completed',
                'failed' => 'status-failed',
                'cancelled' => 'status-cancelled',
            ];

            $statusClass = $statusClasses[$order->status] ?? 'status-cancelled';
        @endphp

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            {{-- LEFT --}}
            <div>
                <div class="flex flex-wrap items-center gap-3">

                    <div>
                        <p class="mb-1 text-xs font-bold uppercase tracking-wider text-slate-400">
                            Order Management
                        </p>

                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                            Edit Order #{{ $order->id }}
                        </h2>
                    </div>

                    <span class="status-badge {{ $statusClass }}">
                        <span class="status-dot"></span>
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

                <p class="mt-1 text-sm text-slate-500">
                    Update customer, payment and order information
                </p>
            </div>


            {{-- ACTIONS --}}
            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('admin.orders.show', $order) }}"
                    class="top-action btn-cancel"
                >
                    <svg class="h-4 w-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>

                    Cancel
                </a>

                <button
                    type="submit"
                    form="order-edit-form"
                    class="top-action btn-save"
                >
                    <svg class="h-4 w-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
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


    {{-- =========================================================
        PAGE
    ========================================================== --}}
    <div class="order-page py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                VALIDATION ERRORS
            ================================================== --}}
            @if($errors->any())

                <div class="alert-box error-alert">

                    <div class="flex gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-600">
                            !
                        </div>

                        <div>

                            <h3 class="font-bold">
                                Please fix the following errors
                            </h3>

                            <ul class="mt-2 list-inside list-disc space-y-1 text-sm">

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


            {{-- =================================================
                SUCCESS
            ================================================== --}}
            @if(session('success'))

                <div class="alert-box success-alert">

                    <div class="flex items-center gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 font-bold text-green-600">
                            ✓
                        </div>

                        <p class="text-sm font-semibold">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =================================================
                FORM
            ================================================== --}}
            <form
                id="order-edit-form"
                method="POST"
                action="{{ route('admin.orders.update', $order) }}"
            >

                @csrf
                @method('PUT')


                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


                    {{-- =================================================
                        LEFT SIDE
                    ================================================== --}}
                    <div class="space-y-6 lg:col-span-2">


                        {{-- =================================================
                            CUSTOMER INFORMATION
                        ================================================== --}}
                        <div class="order-card">

                            <div class="card-header">

                                <div class="flex items-center gap-3">

                                    <div class="section-icon bg-slate-100 text-slate-600">

                                        <svg class="h-5 w-5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-9a4 4 0 100-8 4 4 0 000 8zm8-3a3 3 0 100-6 3 3 0 000 6zm-1 4h1a4 4 0 014 4"
                                            />

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-extrabold text-slate-900">
                                            Customer Information
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Update customer's contact information
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                                    {{-- NAME --}}
                                    <div class="sm:col-span-2">

                                        <label
                                            for="customer_name"
                                            class="field-label"
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
                                            class="field-input"
                                            placeholder="Enter customer name"
                                        >

                                    </div>


                                    {{-- PHONE --}}
                                    <div>

                                        <label
                                            for="phone"
                                            class="field-label"
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
                                            class="field-input"
                                            placeholder="01XXXXXXXXX"
                                        >

                                    </div>


                                    {{-- EMAIL --}}
                                    <div>

                                        <label
                                            for="email"
                                            class="field-label"
                                        >
                                            Email Address
                                        </label>

                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email', $order->email) }}"
                                            class="field-input"
                                            placeholder="customer@example.com"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            PAYMENT INFORMATION
                        ================================================== --}}
                        <div class="order-card">

                            <div class="card-header">

                                <div class="flex items-center gap-3">

                                    <div class="section-icon bg-emerald-50 text-emerald-600">

                                        <svg class="h-5 w-5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 7h18M5 11h2m4 0h2m4 0h2M5 17h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                                            />

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-extrabold text-slate-900">
                                            Payment Information
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Manage order amount and payment method
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                                    {{-- AMOUNT --}}
                                    <div>

                                        <label
                                            for="amount"
                                            class="field-label"
                                        >
                                            Order Amount
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <div class="relative">

                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-500">
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
                                                class="field-input pl-9"
                                                placeholder="0.00"
                                            >

                                        </div>

                                    </div>


                                    {{-- PAYMENT --}}
                                    <div>

                                        <label
                                            for="payment_method"
                                            class="field-label"
                                        >
                                            Payment Method
                                        </label>

                                        <select
                                            id="payment_method"
                                            name="payment_method"
                                            class="field-input field-select"
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


                        {{-- =================================================
                            MAP INFORMATION
                        ================================================== --}}
                        <div class="order-card">

                            <div class="card-header">

                                <div class="flex items-center gap-3">

                                    <div class="section-icon bg-indigo-50 text-indigo-600">

                                        <svg class="h-5 w-5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 20l-5-2V6l5 2 5-2 5 2v12l-5-2-5 2-5-2V6l5 2m0 0v14m5-16v14"
                                            />

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-extrabold text-slate-900">
                                            Map Information
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Map associated with this order
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                @if($order->map)

                                    <div class="map-box p-5">

                                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                            <div>

                                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                                    Purchased Map
                                                </p>

                                                <h4 class="map-title mt-2">
                                                    {{ $order->map->title }}
                                                </h4>

                                            </div>

                                            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-right shadow-sm">

                                                <p class="text-xs text-slate-400">
                                                    Map ID
                                                </p>

                                                <p class="font-extrabold text-slate-900">
                                                    #{{ $order->map->id }}
                                                </p>

                                            </div>

                                        </div>


                                        <div class="mt-5 grid grid-cols-1 gap-3 border-t border-slate-200 pt-5 sm:grid-cols-2 xl:grid-cols-4">


                                            {{-- DIVISION --}}
                                            <div class="location-item">

                                                <p class="location-label">
                                                    Division
                                                </p>

                                                <p class="location-value">
                                                    {{ $order->map->mouza?->upazila?->district?->division?->name_bn
                                                        ?? $order->map->mouza?->upazila?->district?->division?->name
                                                        ?? 'N/A' }}
                                                </p>

                                            </div>


                                            {{-- DISTRICT --}}
                                            <div class="location-item">

                                                <p class="location-label">
                                                    District
                                                </p>

                                                <p class="location-value">
                                                    {{ $order->map->mouza?->upazila?->district?->name_bn
                                                        ?? $order->map->mouza?->upazila?->district?->name
                                                        ?? 'N/A' }}
                                                </p>

                                            </div>


                                            {{-- UPAZILA --}}
                                            <div class="location-item">

                                                <p class="location-label">
                                                    Upazila
                                                </p>

                                                <p class="location-value">
                                                    {{ $order->map->mouza?->upazila?->name_bn
                                                        ?? $order->map->mouza?->upazila?->name
                                                        ?? 'N/A' }}
                                                </p>

                                            </div>


                                            {{-- MOUZA --}}
                                            <div class="location-item">

                                                <p class="location-label">
                                                    Mouza
                                                </p>

                                                <p class="location-value">
                                                    {{ $order->map->mouza?->name_bn
                                                        ?? $order->map->mouza?->name
                                                        ?? 'N/A' }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                @else

                                    <div class="info-box p-7 text-center">

                                        <svg
                                            class="mx-auto h-10 w-10 text-slate-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zm0-14v14m6-16v14"
                                            />
                                        </svg>

                                        <p class="mt-3 text-sm font-semibold text-slate-500">
                                            Map information is unavailable.
                                        </p>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        RIGHT SIDEBAR
                    ================================================== --}}
                    <div class="space-y-6">


                        {{-- =================================================
                            ORDER STATUS
                        ================================================== --}}
                        <div class="order-card">

                            <div class="card-header">

                                <h3 class="text-lg font-extrabold text-slate-900">
                                    Order Status
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Update the current order state
                                </p>

                            </div>


                            <div class="p-6">

                                <label
                                    for="status"
                                    class="field-label"
                                >
                                    Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="field-input field-select"
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


                                <div class="mt-5 info-box p-4">

                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                        Current Status
                                    </p>

                                    <div class="mt-3">

                                        <span class="status-badge {{ $statusClass }}">
                                            <span class="status-dot"></span>
                                            {{ ucfirst($order->status) }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            DOWNLOAD ACCESS
                        ================================================== --}}
                        <div class="order-card">

                            <div class="card-header">

                                <h3 class="text-lg font-extrabold text-slate-900">
                                    Download Access
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
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
                                        class="custom-checkbox mt-1"
                                    >

                                    <span>

                                        <span class="block text-sm font-extrabold text-slate-900">
                                            Allow Download
                                        </span>

                                        <span class="mt-1 block text-xs leading-5 text-slate-500">
                                            Customer will be allowed to download the purchased map.
                                        </span>

                                    </span>

                                </label>


                                <div class="sidebar-note mt-5">

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


                        {{-- =================================================
                            ORDER INFORMATION
                        ================================================== --}}
                        <div class="order-card">

                            <div class="card-header">

                                <div class="flex items-center gap-3">

                                    <div class="section-icon bg-slate-100 text-slate-600">

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
                                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-extrabold text-slate-900">
                                            Order Information
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Basic order metadata
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="p-6">

                                <div class="meta-row">

                                    <span class="meta-label">
                                        Order ID
                                    </span>

                                    <span class="meta-value">
                                        #{{ $order->id }}
                                    </span>

                                </div>


                                <div class="meta-row">

                                    <span class="meta-label">
                                        Downloads
                                    </span>

                                    <span class="meta-value">
                                        {{ $order->download_count }}
                                    </span>

                                </div>


                                <div class="meta-row">

                                    <span class="meta-label">
                                        Created
                                    </span>

                                    <span class="meta-value">
                                        {{ $order->created_at?->format('d M Y') }}
                                    </span>

                                </div>


                                <div class="meta-row">

                                    <span class="meta-label">
                                        Created Time
                                    </span>

                                    <span class="meta-value">
                                        {{ $order->created_at?->format('h:i A') }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            QUICK ACTION
                        ================================================== --}}
                        <div class="rounded-2xl border border-slate-200 bg-slate-900 p-6 shadow-sm">

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Quick Action
                            </p>

                            <h4 class="mt-2 text-lg font-extrabold text-white">
                                Review Order
                            </h4>

                            <p class="mt-1 text-sm leading-6 text-slate-400">
                                Finished editing? Review the complete order before leaving this page.
                            </p>

                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-bold text-slate-900 transition hover:bg-slate-100"
                            >

                                View Order

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>

                            </a>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    BOTTOM SAVE BAR
                ================================================== --}}
                <div class="mt-6 order-card">

                    <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-sm font-extrabold text-slate-900">
                                Ready to save?
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Make sure the customer and order information is correct.
                            </p>

                        </div>


                        <div class="flex flex-wrap gap-3">

                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="top-action btn-cancel"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="top-action btn-save"
                            >
                                <svg
                                    class="h-4 w-4"
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

                </div>

            </form>

        </div>

    </div>

</x-app-layout>