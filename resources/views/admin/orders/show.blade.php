<x-app-layout>

```
{{-- =========================================================
    PAGE HEADER
========================================================== --}}
<x-slot name="header">
    <div class="order-header">
        <div class="order-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.orders.index') }}">Order Management</a>
                <span>/</span>
                <span>Order #{{ $order->id }}</span>
            </div>

            <div class="title-row">
                <div>
                    <h2 class="page-title">Order #{{ $order->id }}</h2>
                    <p class="page-subtitle">
                        View complete order, customer and digital map information
                    </p>
                </div>

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

                <span class="status-badge {{ $statusClass }}">
                    <span class="status-dot"></span>
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                <svg viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Orders
            </a>

            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4Z"/>
                </svg>
                Edit Order
            </a>
        </div>
    </div>
</x-slot>


{{-- =========================================================
    PAGE CONTENT
========================================================== --}}
<div class="orders-page">

    <div class="orders-container">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success">
                <div class="alert-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </div>

                <div>
                    <strong>Success</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif


        {{-- =================================================
            ORDER OVERVIEW
        ================================================== --}}
        <div class="section-heading">
            <div>
                <span class="section-kicker">ORDER OVERVIEW</span>
                <h3>Order Summary</h3>
                <p>Quick overview of this customer's purchase</p>
            </div>
        </div>


        <div class="summary-grid">

            {{-- ORDER ID --}}
            <div class="summary-card">
                <div class="summary-icon icon-gray">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 5h6"/>
                        <path d="M9 9h6"/>
                        <path d="M9 13h6"/>
                        <path d="M9 17h4"/>
                        <rect x="4" y="3" width="16" height="18" rx="2"/>
                    </svg>
                </div>

                <div>
                    <span class="summary-label">Order ID</span>
                    <strong>#{{ $order->id }}</strong>
                </div>
            </div>


            {{-- AMOUNT --}}
            <div class="summary-card">
                <div class="summary-icon icon-green">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M15 8.5c-.7-.7-1.7-1-3-1-1.7 0-3 .9-3 2.2 0 3.1 6 1.5 6 4.6 0 1.3-1.2 2.2-3 2.2-1.3 0-2.4-.4-3.1-1.1"/>
                        <path d="M12 6v12"/>
                    </svg>
                </div>

                <div>
                    <span class="summary-label">Order Amount</span>
                    <strong class="amount-text">
                        ৳{{ number_format($order->amount, 2) }}
                    </strong>
                </div>
            </div>


            {{-- PAYMENT --}}
            <div class="summary-card">
                <div class="summary-icon icon-blue">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="M3 10h18"/>
                        <path d="M7 15h3"/>
                    </svg>
                </div>

                <div>
                    <span class="summary-label">Payment Method</span>
                    <strong class="uppercase">
                        {{ $order->payment_method ?? 'N/A' }}
                    </strong>
                </div>
            </div>


            {{-- DOWNLOADS --}}
            <div class="summary-card">
                <div class="summary-icon icon-purple">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3v12"/>
                        <path d="m7 10 5 5 5-5"/>
                        <path d="M5 21h14"/>
                    </svg>
                </div>

                <div>
                    <span class="summary-label">Downloads</span>
                    <strong>{{ $order->download_count }}</strong>
                </div>
            </div>

        </div>


        {{-- =================================================
            MAIN GRID
        ================================================== --}}
        <div class="main-grid">

            {{-- =============================================
                LEFT COLUMN
            ============================================== --}}
            <div class="main-left">

                {{-- CUSTOMER INFORMATION --}}
                <div class="portal-card">

                    <div class="card-header">
                        <div class="card-heading">
                            <div class="card-icon icon-gray">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>

                            <div>
                                <h3>Customer Information</h3>
                                <p>Information provided by the customer</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="info-grid">

                            <div class="info-item">
                                <span>Customer Name</span>
                                <strong>{{ $order->customer_name }}</strong>
                            </div>

                            <div class="info-item">
                                <span>Phone Number</span>

                                <a href="tel:{{ $order->phone }}" class="info-link">
                                    {{ $order->phone }}
                                </a>
                            </div>

                            <div class="info-item">
                                <span>Email Address</span>

                                @if($order->email)
                                    <a href="mailto:{{ $order->email }}" class="info-link">
                                        {{ $order->email }}
                                    </a>
                                @else
                                    <strong class="muted-value">
                                        Not provided
                                    </strong>
                                @endif
                            </div>

                            <div class="info-item">
                                <span>Payment Method</span>
                                <strong class="uppercase">
                                    {{ $order->payment_method ?? 'N/A' }}
                                </strong>
                            </div>

                        </div>

                    </div>
                </div>


                {{-- MAP INFORMATION --}}
                <div class="portal-card">

                    <div class="card-header">
                        <div class="card-heading">

                            <div class="card-icon icon-purple">
                                <svg viewBox="0 0 24 24">
                                    <path d="m9 20-5-2V6l5 2 6-2 5 2v12l-6-2-5 2Z"/>
                                    <path d="M9 6v14"/>
                                    <path d="M15 4v14"/>
                                </svg>
                            </div>

                            <div>
                                <h3>Purchased Map</h3>
                                <p>Digital map associated with this order</p>
                            </div>

                        </div>
                    </div>


                    <div class="card-body">

                        @if($order->map)

                            <div class="map-title-box">

                                <div>
                                    <span class="field-label">MAP TITLE</span>

                                    <h4>
                                        {{ $order->map->title }}
                                    </h4>
                                </div>

                                <div class="map-id">
                                    <span>Map ID</span>
                                    <strong>#{{ $order->map->id }}</strong>
                                </div>

                            </div>


                            <div class="location-grid">

                                <div class="location-item">
                                    <span>Division</span>
                                    <strong>
                                        {{
                                            $order->map->mouza?->upazila?->district?->division?->name_bn
                                            ??
                                            $order->map->mouza?->upazila?->district?->division?->name
                                            ??
                                            'N/A'
                                        }}
                                    </strong>
                                </div>


                                <div class="location-item">
                                    <span>District</span>
                                    <strong>
                                        {{
                                            $order->map->mouza?->upazila?->district?->name_bn
                                            ??
                                            $order->map->mouza?->upazila?->district?->name
                                            ??
                                            'N/A'
                                        }}
                                    </strong>
                                </div>


                                <div class="location-item">
                                    <span>Upazila</span>
                                    <strong>
                                        {{
                                            $order->map->mouza?->upazila?->name_bn
                                            ??
                                            $order->map->mouza?->upazila?->name
                                            ??
                                            'N/A'
                                        }}
                                    </strong>
                                </div>


                                <div class="location-item">
                                    <span>Mouza</span>
                                    <strong>
                                        {{
                                            $order->map->mouza?->name_bn
                                            ??
                                            $order->map->mouza?->name
                                            ??
                                            'N/A'
                                        }}
                                    </strong>
                                </div>

                            </div>

                        @else

                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 8v4"/>
                                        <path d="M12 16h.01"/>
                                    </svg>
                                </div>

                                <h4>Map Information Unavailable</h4>
                                <p>The map associated with this order could not be found.</p>
                            </div>

                        @endif

                    </div>

                </div>


                {{-- ORDER DETAILS --}}
                <div class="portal-card">

                    <div class="card-header">
                        <div class="card-heading">

                            <div class="card-icon icon-blue">
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 5h16"/>
                                    <path d="M4 9h16"/>
                                    <path d="M4 13h16"/>
                                    <path d="M4 17h10"/>
                                </svg>
                            </div>

                            <div>
                                <h3>Order Details</h3>
                                <p>Complete order information</p>
                            </div>

                        </div>
                    </div>


                    <div class="details-table-wrap">

                        <table class="details-table">

                            <tbody>

                                <tr>
                                    <td>Order ID</td>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                </tr>

                                <tr>
                                    <td>Customer</td>
                                    <td><strong>{{ $order->customer_name }}</strong></td>
                                </tr>

                                <tr>
                                    <td>Phone</td>
                                    <td><strong>{{ $order->phone }}</strong></td>
                                </tr>

                                <tr>
                                    <td>Amount</td>
                                    <td>
                                        <strong class="amount-text">
                                            ৳{{ number_format($order->amount, 2) }}
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Payment Method</td>
                                    <td>
                                        <strong class="uppercase">
                                            {{ $order->payment_method ?? 'N/A' }}
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <span class="status-badge small {{ $statusClass }}">
                                            <span class="status-dot"></span>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Created At</td>
                                    <td>
                                        <strong>
                                            {{ $order->created_at?->format('d M Y, h:i A') }}
                                        </strong>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- =============================================
                RIGHT SIDEBAR
            ============================================== --}}
            <div class="sidebar">


                {{-- STATUS CARD --}}
                <div class="portal-card">

                    <div class="card-header">
                        <div class="card-heading">
                            <div class="card-icon icon-orange">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </div>

                            <div>
                                <h3>Order Status</h3>
                                <p>Current order state</p>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">

                        <div class="current-status-box">

                            <span class="field-label">CURRENT STATUS</span>

                            <div class="current-status">
                                <span class="status-badge {{ $statusClass }}">
                                    <span class="status-dot"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                        </div>


                        <div class="sidebar-info">

                            <div>
                                <span>Created At</span>
                                <strong>
                                    {{ $order->created_at?->format('d M Y, h:i A') }}
                                </strong>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- DOWNLOAD CARD --}}
                <div class="portal-card">

                    <div class="card-header">
                        <div class="card-heading">

                            <div class="card-icon icon-green">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 3v12"/>
                                    <path d="m7 10 5 5 5-5"/>
                                    <path d="M5 21h14"/>
                                </svg>
                            </div>

                            <div>
                                <h3>Download Access</h3>
                                <p>Digital map access control</p>
                            </div>

                        </div>
                    </div>


                    <div class="card-body">

                        <div class="download-access">

                            <span class="field-label">ACCESS STATUS</span>

                            @if($order->download_allowed)

                                <div class="access-status allowed">
                                    <span class="access-dot"></span>
                                    Download Allowed
                                </div>

                            @else

                                <div class="access-status denied">
                                    <span class="access-dot"></span>
                                    Download Restricted
                                </div>

                            @endif

                        </div>


                        <div class="download-stat">

                            <span>Download Count</span>

                            <strong>
                                {{ $order->download_count }}
                            </strong>

                        </div>


                        <div class="download-stat">

                            <span>Last Download</span>

                            <strong>
                                {{
                                    $order->downloaded_at
                                        ? $order->downloaded_at->format('d M Y, h:i A')
                                        : 'Not downloaded yet'
                                }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- QUICK INFORMATION --}}
                <div class="quick-info-card">

                    <div class="quick-info-header">
                        <span class="field-label">ORDER INFORMATION</span>
                    </div>

                    <div class="quick-info-row">
                        <span>Order ID</span>
                        <strong>#{{ $order->id }}</strong>
                    </div>

                    <div class="quick-info-row">
                        <span>Downloads</span>
                        <strong>{{ $order->download_count }}</strong>
                    </div>

                    <div class="quick-info-row">
                        <span>Amount</span>
                        <strong class="amount-text">
                            ৳{{ number_format($order->amount, 2) }}
                        </strong>
                    </div>

                    <div class="quick-info-row">
                        <span>Created</span>
                        <strong>
                            {{ $order->created_at?->format('d M Y') }}
                        </strong>
                    </div>

                </div>


                {{-- ACTION CARD --}}
                <div class="action-card">

                    <div class="action-card-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 3v12"/>
                            <path d="m7 10 5 5 5-5"/>
                            <path d="M5 21h14"/>
                        </svg>
                    </div>

                    <h3>Manage This Order</h3>

                    <p>
                        Need to change customer, payment or access information?
                    </p>

                    <a href="{{ route('admin.orders.edit', $order) }}" class="action-button">
                        Edit Order
                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    PAGE CSS
========================================================== --}}
<style>

    /* =====================================================
       ROOT
    ====================================================== */

    .orders-page {
        min-height: calc(100vh - 80px);
        background:
            linear-gradient(
                180deg,
                #f4f7fa 0%,
                #eef2f6 100%
            );
        padding: 30px 0 60px;
        color: #172033;
    }

    .orders-container {
        width: min(1400px, calc(100% - 32px));
        margin: 0 auto;
    }


    /* =====================================================
       HEADER
    ====================================================== */

    .order-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
    }

    .order-header-left {
        min-width: 0;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
        color: #8a94a6;
        font-size: 12px;
        font-weight: 600;
    }

    .breadcrumb a {
        color: #276749;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-title {
        margin: 0;
        color: #111827;
        font-size: 25px;
        line-height: 1.25;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .page-subtitle {
        margin: 6px 0 0;
        color: #7a8494;
        font-size: 13px;
    }

    .header-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }


    /* =====================================================
       BUTTONS
    ====================================================== */

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 0 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }

    .btn svg {
        width: 17px;
        height: 17px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .btn-secondary {
        color: #344054;
        background: #fff;
        border: 1px solid #d8dee8;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #b9c2cf;
    }

    .btn-primary {
        color: #fff;
        background: #166534;
        border: 1px solid #166534;
        box-shadow: 0 3px 8px rgba(22, 101, 52, .16);
    }

    .btn-primary:hover {
        background: #14532d;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(22, 101, 52, .18);
    }


    /* =====================================================
       SECTION HEADING
    ====================================================== */

    .section-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin: 8px 0 16px;
    }

    .section-kicker {
        display: block;
        margin-bottom: 5px;
        color: #6b7280;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .13em;
    }

    .section-heading h3 {
        margin: 0;
        color: #1f2937;
        font-size: 18px;
        font-weight: 800;
    }

    .section-heading p {
        margin: 4px 0 0;
        color: #7c8798;
        font-size: 12px;
    }


    /* =====================================================
       ALERT
    ====================================================== */

    .alert {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        padding: 14px 17px;
        border-radius: 9px;
        border: 1px solid;
    }

    .alert-success {
        color: #166534;
        background: #f0fdf4;
        border-color: #bbf7d0;
    }

    .alert-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        border-radius: 50%;
        background: #dcfce7;
    }

    .alert-icon svg {
        width: 18px;
        height: 18px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .alert strong {
        display: block;
        font-size: 13px;
    }

    .alert p {
        margin: 2px 0 0;
        font-size: 12px;
    }


    /* =====================================================
       SUMMARY CARDS
    ====================================================== */

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 25px;
    }

    .summary-card {
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 102px;
        padding: 18px;
        background: #fff;
        border: 1px solid #e1e6ed;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(31, 41, 55, .035);
        transition: .2s ease;
    }

    .summary-card:hover {
        transform: translateY(-2px);
        border-color: #d4dbe5;
        box-shadow: 0 8px 22px rgba(31, 41, 55, .07);
    }

    .summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        border-radius: 9px;
    }

    .summary-icon svg,
    .card-icon svg,
    .action-card-icon svg {
        width: 21px;
        height: 21px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.7;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .icon-gray {
        color: #475467;
        background: #f1f3f5;
    }

    .icon-green {
        color: #15803d;
        background: #ecfdf3;
    }

    .icon-blue {
        color: #2563eb;
        background: #eff6ff;
    }

    .icon-purple {
        color: #7c3aed;
        background: #f5f3ff;
    }

    .icon-orange {
        color: #c2410c;
        background: #fff7ed;
    }

    .summary-label {
        display: block;
        margin-bottom: 5px;
        color: #8a94a6;
        font-size: 11px;
        font-weight: 700;
    }

    .summary-card strong {
        display: block;
        color: #172033;
        font-size: 20px;
        line-height: 1.1;
        font-weight: 800;
    }

    .summary-card .amount-text {
        color: #15803d;
    }

    .uppercase {
        text-transform: uppercase;
    }


    /* =====================================================
       MAIN GRID
    ====================================================== */

    .main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 350px;
        gap: 20px;
        align-items: start;
    }

    .main-left,
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }


    /* =====================================================
       PORTAL CARD
    ====================================================== */

    .portal-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e0e5eb;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(31, 41, 55, .035);
    }

    .card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e9edf2;
    }

    .card-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 8px;
    }

    .card-heading h3 {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 800;
    }

    .card-heading p {
        margin: 3px 0 0;
        color: #8a94a6;
        font-size: 11px;
    }

    .card-body {
        padding: 20px;
    }


    /* =====================================================
       INFO GRID
    ====================================================== */

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px 35px;
    }

    .info-item span,
    .location-item span,
    .sidebar-info span,
    .download-stat span,
    .quick-info-row span {
        display: block;
        color: #929baa;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .info-item strong {
        display: block;
        margin-top: 6px;
        color: #202938;
        font-size: 13px;
        font-weight: 700;
    }

    .info-link {
        display: inline-block;
        margin-top: 6px;
        color: #166534;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .info-link:hover {
        text-decoration: underline;
    }

    .muted-value {
        color: #98a2b3 !important;
    }


    /* =====================================================
       MAP
    ====================================================== */

    .map-title-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px;
        background: #f7f9fb;
        border: 1px solid #e5e9ef;
        border-radius: 9px;
    }

    .field-label {
        display: block;
        color: #929baa;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .1em;
    }

    .map-title-box h4 {
        margin: 6px 0 0;
        color: #172033;
        font-size: 16px;
        font-weight: 800;
    }

    .map-id {
        min-width: 85px;
        padding: 9px 12px;
        text-align: center;
        background: #fff;
        border: 1px solid #e1e6ed;
        border-radius: 7px;
    }

    .map-id span {
        display: block;
        color: #9aa3b1;
        font-size: 9px;
    }

    .map-id strong {
        display: block;
        margin-top: 2px;
        color: #273142;
        font-size: 13px;
    }

    .location-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: 20px;
        border-top: 1px solid #edf0f3;
    }

    .location-item {
        padding: 17px 14px 3px 0;
    }

    .location-item:not(:last-child) {
        border-right: 1px solid #edf0f3;
        padding-right: 15px;
        margin-right: 15px;
    }

    .location-item strong {
        display: block;
        margin-top: 6px;
        color: #303948;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.5;
    }


    /* =====================================================
       STATUS BADGES
    ====================================================== */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-badge.small {
        padding: 5px 9px;
        font-size: 10px;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending {
        color: #a16207;
        background: #fefce8;
        border: 1px solid #fde68a;
    }

    .status-paid {
        color: #15803d;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .status-completed {
        color: #1d4ed8;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
    }

    .status-failed {
        color: #b91c1c;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .status-cancelled {
        color: #667085;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }


    /* =====================================================
       TABLE
    ====================================================== */

    .details-table-wrap {
        overflow-x: auto;
    }

    .details-table {
        width: 100%;
        border-collapse: collapse;
    }

    .details-table td {
        padding: 14px 20px;
        border-bottom: 1px solid #edf0f3;
        font-size: 12px;
        vertical-align: middle;
    }

    .details-table tr:last-child td {
        border-bottom: 0;
    }

    .details-table td:first-child {
        width: 38%;
        color: #7f8998;
        font-weight: 600;
        background: #fafbfc;
    }

    .details-table td:last-child {
        color: #202938;
    }

    .details-table strong {
        font-weight: 700;
    }

    .amount-text {
        color: #15803d !important;
    }


    /* =====================================================
       SIDEBAR
    ====================================================== */

    .current-status-box {
        padding: 15px;
        background: #f8fafc;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
    }

    .current-status {
        margin-top: 10px;
    }

    .sidebar-info {
        margin-top: 18px;
        padding-top: 17px;
        border-top: 1px solid #edf0f3;
    }

    .sidebar-info strong {
        display: block;
        margin-top: 6px;
        color: #273142;
        font-size: 12px;
    }


    /* =====================================================
       DOWNLOAD
    ====================================================== */

    .download-access {
        padding-bottom: 17px;
        border-bottom: 1px solid #edf0f3;
    }

    .access-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 10px;
        font-size: 12px;
        font-weight: 800;
    }

    .access-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .allowed {
        color: #15803d;
    }

    .allowed .access-dot {
        background: #22c55e;
        box-shadow: 0 0 0 3px #dcfce7;
    }

    .denied {
        color: #b91c1c;
    }

    .denied .access-dot {
        background: #ef4444;
        box-shadow: 0 0 0 3px #fee2e2;
    }

    .download-stat {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #edf0f3;
    }

    .download-stat:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .download-stat strong {
        max-width: 150px;
        color: #273142;
        font-size: 12px;
        font-weight: 700;
        text-align: right;
    }


    /* =====================================================
       QUICK INFO
    ====================================================== */

    .quick-info-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e0e5eb;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(31, 41, 55, .035);
    }

    .quick-info-header {
        padding: 16px 18px;
        background: #f7f9fb;
        border-bottom: 1px solid #e5e9ef;
    }

    .quick-info-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 13px 18px;
        border-bottom: 1px solid #edf0f3;
    }

    .quick-info-row:last-child {
        border-bottom: 0;
    }

    .quick-info-row strong {
        color: #273142;
        font-size: 12px;
        font-weight: 700;
        text-align: right;
    }


    /* =====================================================
       ACTION CARD
    ====================================================== */

    .action-card {
        padding: 22px;
        color: #fff;
        background:
            linear-gradient(
                135deg,
                #14532d 0%,
                #166534 55%,
                #15803d 100%
            );
        border-radius: 10px;
        box-shadow: 0 8px 22px rgba(22, 101, 52, .18);
    }

    .action-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 39px;
        height: 39px;
        margin-bottom: 15px;
        border-radius: 8px;
        background: rgba(255,255,255,.12);
    }

    .action-card-icon svg {
        color: #fff;
    }

    .action-card h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
    }

    .action-card p {
        margin: 7px 0 17px;
        color: rgba(255,255,255,.76);
        font-size: 11px;
        line-height: 1.6;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-height: 40px;
        color: #14532d;
        background: #fff;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: .2s ease;
    }

    .action-button:hover {
        background: #f0fdf4;
        transform: translateY(-1px);
    }

    .action-button svg {
        width: 15px;
        height: 15px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* =====================================================
       EMPTY STATE
    ====================================================== */

    .empty-state {
        padding: 30px 15px;
        text-align: center;
    }

    .empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        color: #98a2b3;
        background: #f2f4f7;
        border-radius: 50%;
    }

    .empty-icon svg {
        width: 22px;
        height: 22px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.7;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .empty-state h4 {
        margin: 0;
        color: #344054;
        font-size: 14px;
        font-weight: 800;
    }

    .empty-state p {
        margin: 5px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width: 1100px) {

        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .main-grid {
            grid-template-columns: minmax(0, 1fr) 310px;
        }

        .location-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .location-item:nth-child(2) {
            border-right: 0;
        }

    }


    @media (max-width: 900px) {

        .order-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-actions {
            width: 100%;
        }

        .main-grid {
            grid-template-columns: 1fr;
        }

        .sidebar {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            align-items: start;
        }

        .action-card {
            grid-column: span 2;
        }

    }


    @media (max-width: 640px) {

        .orders-page {
            padding-top: 20px;
        }

        .orders-container {
            width: min(100% - 20px, 1400px);
        }

        .page-title {
            font-size: 21px;
        }

        .page-subtitle {
            font-size: 11px;
        }

        .header-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .btn {
            width: 100%;
            padding: 0 10px;
            font-size: 11px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .summary-card {
            min-height: 85px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .map-title-box {
            align-items: flex-start;
            flex-direction: column;
        }

        .map-id {
            width: 100%;
            text-align: left;
        }

        .location-grid {
            grid-template-columns: 1fr;
        }

        .location-item {
            padding: 13px 0;
            border-right: 0 !important;
            border-bottom: 1px solid #edf0f3;
            margin: 0 !important;
        }

        .location-item:last-child {
            border-bottom: 0;
        }

        .sidebar {
            display: flex;
        }

        .action-card {
            grid-column: auto;
        }

        .card-header {
            padding: 15px;
        }

        .card-body {
            padding: 15px;
        }

        .details-table td {
            padding: 12px 14px;
            font-size: 11px;
        }

        .details-table td:first-child {
            width: 42%;
        }

        .section-heading {
            margin-top: 0;
        }

    }

</style>
```

</x-app-layout>
