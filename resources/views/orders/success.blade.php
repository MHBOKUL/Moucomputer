<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">


<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Order #{{ $order->id }} — MoujaMap</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        font-family: Inter, ui-sans-serif, system-ui, -apple-system,
            BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
</style>


</head>

<body class="min-h-screen bg-slate-50 text-slate-900">


{{-- Header --}}
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

        <a
            href="{{ route('home') }}"
            class="text-xl font-extrabold tracking-tight text-slate-900"
        >
            Mouja<span class="text-emerald-600">Map</span>
        </a>

        <a
            href="{{ route('home') }}"
            class="text-sm font-medium text-slate-600 transition hover:text-slate-900"
        >
            Home
        </a>

    </div>
</header>


{{-- Main --}}
<main class="px-4 py-10 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-3xl">

        {{-- Success Icon --}}
        <div class="text-center">

            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100">

                <svg
                    class="h-10 w-10 text-emerald-600"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

            </div>


            <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                Order Placed Successfully!
            </h1>

            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-slate-600 sm:text-base">
                Thank you for your order. Your order has been received successfully.
            </p>

        </div>


        {{-- Order Card --}}
        <div class="mt-8 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">


            {{-- Order Header --}}
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5 sm:px-8">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Order ID
                        </p>

                        <p class="mt-1 text-2xl font-extrabold text-slate-900">
                            #{{ $order->id }}
                        </p>

                    </div>


                    @php
                        $statusClass = match ($order->status) {
                            'paid', 'completed' =>
                                'bg-emerald-100 text-emerald-700',

                            'pending' =>
                                'bg-amber-100 text-amber-700',

                            'failed', 'cancelled' =>
                                'bg-red-100 text-red-700',

                            default =>
                                'bg-slate-100 text-slate-700',
                        };
                    @endphp


                    <span
                        class="inline-flex w-fit items-center rounded-full px-3 py-1.5 text-xs font-bold uppercase tracking-wide {{ $statusClass }}"
                    >
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

            </div>


            {{-- Information --}}
            <div class="px-6 py-7 sm:px-8">

                <h2 class="text-lg font-bold text-slate-900">
                    Order Information
                </h2>


                <div class="mt-5 overflow-hidden rounded-xl border border-slate-200">


                    {{-- Map --}}
                    <div class="grid grid-cols-1 gap-1 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Map
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->map?->title ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- Division --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Division
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->map?->mouza?->upazila?->district?->division?->name ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- District --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            District
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->map?->mouza?->upazila?->district?->name ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- Upazila --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Upazila
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->map?->mouza?->upazila?->name ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- Mouza --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Mouza
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->map?->mouza?->name ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- Survey --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Survey Type
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->map?->mouza?->surveyType?->name ?? 'N/A' }}
                        </span>

                    </div>


                    {{-- Customer --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Customer
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->customer_name }}
                        </span>

                    </div>


                    {{-- Phone --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Phone
                        </span>

                        <span class="text-sm font-semibold text-slate-900 sm:text-right">
                            {{ $order->phone }}
                        </span>

                    </div>


                    {{-- Payment --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-medium text-slate-500">
                            Payment Method
                        </span>

                        <span class="text-sm font-semibold uppercase text-slate-900 sm:text-right">
                            {{ $order->payment_method }}
                        </span>

                    </div>


                    {{-- Amount --}}
                    <div class="grid grid-cols-1 gap-1 border-t border-slate-100 bg-slate-50 px-4 py-5 sm:grid-cols-2 sm:gap-4">

                        <span class="text-sm font-bold text-slate-700">
                            Amount
                        </span>

                        <span class="text-xl font-extrabold text-slate-900 sm:text-right">
                            ৳{{ number_format((float) $order->amount, 2) }}
                        </span>

                    </div>

                </div>


                {{-- Pending --}}
                @if($order->status === 'pending')

                    <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-5">

                        <div class="flex gap-3">

                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>


                            <div>

                                <h3 class="font-bold text-amber-900">
                                    Payment Verification Pending
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-amber-800">
                                    Your order is currently being reviewed.
                                    Once payment is confirmed, the administrator
                                    will enable your map download permission.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Download Available --}}
                @if(
                    in_array($order->status, ['paid', 'completed']) &&
                    $order->download_allowed &&
                    $order->download_token
                )

                    <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-5">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                            <div class="flex-1">

                                <h3 class="font-bold text-emerald-900">
                                    Your Map Is Ready
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-emerald-800">
                                    Payment has been confirmed.
                                    Your purchased map PDF is ready to download.
                                </p>

                            </div>


                            <a
                                href="{{ route('orders.download', [
                                    'order' => $order->id,
                                    'token' => $order->download_token,
                                ]) }}"
                                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7l-3-3z"
                                    />
                                </svg>

                                Download PDF

                            </a>

                        </div>

                    </div>

                @endif


                {{-- Failed / Cancelled --}}
                @if(in_array($order->status, ['failed', 'cancelled']))

                    <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-5">

                        <div class="flex gap-3">

                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>


                            <div>

                                <h3 class="font-bold text-red-900">
                                    Order {{ ucfirst($order->status) }}
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-red-800">
                                    This order is not currently eligible for map download.
                                    Please contact support if you believe this is incorrect.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Buttons --}}
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">

                    @if($order->map)

                        <a
                            href="{{ route('maps.show', $order->map) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50"
                        >
                            View Map
                        </a>

                    @endif


                    <a
                        href="{{ route('home') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white transition hover:bg-slate-800"
                    >
                        Back to Home
                    </a>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <p class="mt-6 text-center text-xs leading-5 text-slate-500">

            Please keep your Order ID

            <span class="font-bold text-slate-700">
                #{{ $order->id }}
            </span>

            for future reference.

        </p>

    </div>

</main>


{{-- Footer --}}
<footer class="border-t border-slate-200 bg-white py-6">

    <p class="text-center text-xs text-slate-500">
        © {{ date('Y') }} MoujaMap. All rights reserved.
    </p>

</footer>

</body>
</html>
