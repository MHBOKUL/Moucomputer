<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order #{{ $order->id }} — MoujaMap</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .land-pattern {
            background-image:
                linear-gradient(rgba(22, 101, 52, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(22, 101, 52, 0.035) 1px, transparent 1px);
            background-size: 28px 28px;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f4f8f3] text-slate-800">

    {{-- ============================================================
         HEADER
    ============================================================= --}}
    <header class="border-b border-green-900/20 bg-[#075e35] text-white">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex min-h-[72px] items-center justify-between">

                <a href="{{ route('home') }}"
                   class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-white/10">

                        <svg class="h-6 w-6 text-white"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 21s7-5.2 7-11a7 7 0 10-14 0c0 5.8 7 11 7 11z"/>

                            <circle cx="12"
                                    cy="10"
                                    r="2.5"/>
                        </svg>

                    </div>

                    <div>

                        <div class="text-xl font-extrabold tracking-tight">
                            Mouja<span class="text-green-200">Map</span>
                        </div>

                        <div class="text-[10px] font-medium uppercase tracking-[0.18em] text-green-100">
                            Digital Land Map Service
                        </div>

                    </div>

                </a>


                <a href="{{ route('home') }}"
                   class="rounded-md border border-white/20 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">

                    Home

                </a>

            </div>

        </div>

    </header>


    {{-- ============================================================
         GOVERNMENT STYLE STRIP
    ============================================================= --}}
    <div class="border-b border-green-900/10 bg-[#e7f2e8]">

        <div class="mx-auto max-w-7xl px-4 py-2 sm:px-6 lg:px-8">

            <p class="text-xs font-medium text-green-900">

                MoujaMap
                <span class="mx-2 text-green-700">›</span>
                Order Confirmation

            </p>

        </div>

    </div>


    {{-- ============================================================
         MAIN
    ============================================================= --}}
    <main class="land-pattern min-h-[calc(100vh-145px)] px-4 py-10 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-4xl">


            {{-- Success Message --}}
            <div class="mb-8 text-center">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-4 border-green-100 bg-white shadow-sm">

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#07883f]">

                        <svg class="h-8 w-8 text-white"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2.5"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                    </div>

                </div>


                <h1 class="mt-5 text-2xl font-extrabold text-[#174b2a] sm:text-3xl">

                    Order Placed Successfully

                </h1>


                <p class="mx-auto mt-2 max-w-xl text-sm leading-6 text-slate-600">

                    Your Mouza Map order has been received successfully.
                    Please keep your Order ID for future reference.

                </p>

            </div>


            {{-- ========================================================
                 ORDER CARD
            ========================================================= --}}
            <section class="overflow-hidden border border-green-900/15 bg-white shadow-sm">


                {{-- Card Header --}}
                <div class="border-b border-green-900/10 bg-[#f0f7f1] px-5 py-5 sm:px-7">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-green-800">
                                Order Reference
                            </p>

                            <p class="mt-1 text-2xl font-extrabold text-[#174b2a]">
                                #{{ $order->id }}
                            </p>

                        </div>


                        @php
                            $statusClass = match ($order->status) {
                                'paid', 'completed' =>
                                    'border-green-200 bg-green-100 text-green-800',

                                'pending' =>
                                    'border-amber-200 bg-amber-100 text-amber-800',

                                'failed', 'cancelled' =>
                                    'border-red-200 bg-red-100 text-red-800',

                                default =>
                                    'border-slate-200 bg-slate-100 text-slate-700',
                            };
                        @endphp


                        <span class="inline-flex w-fit items-center border px-3 py-1.5 text-xs font-bold uppercase tracking-wide {{ $statusClass }}">

                            {{ ucfirst($order->status) }}

                        </span>

                    </div>

                </div>


                {{-- ====================================================
                     ORDER INFORMATION
                ===================================================== --}}
                <div class="px-5 py-7 sm:px-7">

                    <div class="mb-5">

                        <h2 class="text-lg font-extrabold text-[#174b2a]">
                            Order Information
                        </h2>

                        <div class="mt-1 h-0.5 w-12 bg-[#07883f]"></div>

                    </div>


                    <div class="overflow-hidden border border-slate-200">


                        {{-- Map --}}
                        <div class="grid grid-cols-1 gap-1 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Map
                            </span>

                            <span class="text-sm font-bold text-slate-900 sm:text-right">
                                {{ $order->map?->title ?? 'N/A' }}
                            </span>

                        </div>


                        {{-- Division --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 bg-slate-50/50 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Division
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->map?->mouza?->upazila?->district?->division?->name ?? 'N/A' }}

                                @if($order->map?->mouza?->upazila?->district?->division?->name_bn)
                                    <span class="text-slate-500">
                                        — {{ $order->map->mouza->upazila->district->division->name_bn }}
                                    </span>
                                @endif
                            </span>

                        </div>


                        {{-- District --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                District
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->map?->mouza?->upazila?->district?->name ?? 'N/A' }}

                                @if($order->map?->mouza?->upazila?->district?->name_bn)
                                    <span class="text-slate-500">
                                        — {{ $order->map->mouza->upazila->district->name_bn }}
                                    </span>
                                @endif
                            </span>

                        </div>


                        {{-- Upazila --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 bg-slate-50/50 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Upazila / Thana
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->map?->mouza?->upazila?->name ?? 'N/A' }}

                                @if($order->map?->mouza?->upazila?->name_bn)
                                    <span class="text-slate-500">
                                        — {{ $order->map->mouza->upazila->name_bn }}
                                    </span>
                                @endif
                            </span>

                        </div>


                        {{-- Mouza --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Mouza
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->map?->mouza?->name ?? 'N/A' }}

                                @if($order->map?->mouza?->name_bn)
                                    <span class="text-slate-500">
                                        — {{ $order->map->mouza->name_bn }}
                                    </span>
                                @endif
                            </span>

                        </div>


                        {{-- Survey --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 bg-slate-50/50 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Survey Type
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->map?->mouza?->surveyType?->name ?? 'N/A' }}
                            </span>

                        </div>


                        {{-- Customer --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Customer Name
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->customer_name }}
                            </span>

                        </div>


                        {{-- Phone --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 bg-slate-50/50 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Phone Number
                            </span>

                            <span class="text-sm font-semibold text-slate-900 sm:text-right">
                                {{ $order->phone }}
                            </span>

                        </div>


                        {{-- Payment --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-slate-100 px-4 py-4 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-semibold text-slate-600">
                                Payment Method
                            </span>

                            <span class="text-sm font-bold uppercase text-slate-900 sm:text-right">
                                {{ $order->payment_method }}
                            </span>

                        </div>


                        {{-- Amount --}}
                        <div class="grid grid-cols-1 gap-1 border-t border-green-900/10 bg-[#edf7ef] px-4 py-5 sm:grid-cols-2 sm:gap-6">

                            <span class="text-sm font-extrabold text-[#174b2a]">
                                Total Amount
                            </span>

                            <span class="text-xl font-extrabold text-[#07883f] sm:text-right">
                                ৳{{ number_format((float) $order->amount, 2) }}
                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                         PENDING
                    ================================================== --}}
                    @if($order->status === 'pending')

                        <div class="mt-6 border border-amber-200 bg-amber-50 p-5">

                            <div class="flex gap-3">

                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     viewBox="0 0 24 24">

                                    <circle cx="12" cy="12" r="9"/>
                                    <path stroke-linecap="round"
                                          d="M12 7v5l3 2"/>

                                </svg>


                                <div>

                                    <h3 class="font-bold text-amber-900">
                                        Payment Verification Pending
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-amber-800">

                                        Your order has been received and is currently
                                        waiting for payment verification. Once payment
                                        is confirmed, your map download will be enabled.

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         DOWNLOAD AVAILABLE
                    ================================================== --}}
                    @if(
                        in_array($order->status, ['paid', 'completed']) &&
                        $order->download_allowed &&
                        $order->download_token
                    )

                        <div class="mt-6 border border-green-200 bg-[#edf8ef] p-5">

                            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                                <div class="flex-1">

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100">

                                            <svg class="h-5 w-5 text-green-700"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="2"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M5 13l4 4L19 7"/>

                                            </svg>

                                        </div>

                                        <h3 class="font-extrabold text-green-900">
                                            Map Ready for Download
                                        </h3>

                                    </div>


                                    <p class="mt-2 text-sm leading-6 text-green-800">

                                        Payment has been confirmed. Your purchased
                                        Mouza Map PDF is now available.

                                    </p>

                                </div>


                                <a href="{{ route('orders.download', [
                                    'order' => $order->id,
                                    'token' => $order->download_token,
                                ]) }}"
                                   class="inline-flex shrink-0 items-center justify-center gap-2 bg-[#07883f] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#056b31]">

                                    <svg class="h-5 w-5"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M12 10v6m0 0l-3-3m3 3l3-3"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h9l5 5v11a2 2 0 01-2 2z"/>

                                    </svg>

                                    Download PDF

                                </a>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         FAILED / CANCELLED
                    ================================================== --}}
                    @if(in_array($order->status, ['failed', 'cancelled']))

                        <div class="mt-6 border border-red-200 bg-red-50 p-5">

                            <div class="flex gap-3">

                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12"/>

                                </svg>


                                <div>

                                    <h3 class="font-bold text-red-900">
                                        Order {{ ucfirst($order->status) }}
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-red-800">

                                        This order is not currently eligible for
                                        map download. Please contact support if
                                        you believe this is incorrect.

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         ACTION BUTTONS
                    ================================================== --}}
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">

                        @if($order->map)

                            <a href="{{ route('maps.show', $order->map) }}"
                               class="inline-flex items-center justify-center border border-[#07883f] bg-white px-6 py-3 text-sm font-bold text-[#07883f] transition hover:bg-[#edf8ef]">

                                View Map

                            </a>

                        @endif


                        <a href="{{ route('home') }}"
                           class="inline-flex items-center justify-center bg-[#075e35] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#044c2a]">

                            Back to Home

                        </a>

                    </div>

                </div>

            </section>


            {{-- Reference Note --}}
            <div class="mt-5 border border-green-900/10 bg-white px-5 py-4 text-center shadow-sm">

                <p class="text-xs leading-5 text-slate-600">

                    Please keep your Order ID

                    <strong class="text-[#174b2a]">
                        #{{ $order->id }}
                    </strong>

                    for future reference.

                </p>

            </div>

        </div>

    </main>


    {{-- ============================================================
         FOOTER
    ============================================================= --}}
    <footer class="border-t border-green-900/10 bg-[#075e35] py-6">

        <p class="text-center text-xs text-green-100">

            © {{ date('Y') }} MoujaMap.
            Digital Mouza Map Service.

        </p>

    </footer>

</body>
</html>

