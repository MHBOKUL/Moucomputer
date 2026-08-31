<x-app-layout>

    {{-- =========================================================
        PAGE STYLES
    ========================================================== --}}
    <style>
        /* -----------------------------------------------------
           DLRMS INSPIRED ADMIN ORDER PAGE
        ----------------------------------------------------- */

        .orders-page {
            --primary: #075e54;
            --primary-dark: #064e46;
            --primary-light: #e8f5f2;
            --secondary: #0f766e;
            --accent: #d4a72c;

            background:
                linear-gradient(
                    180deg,
                    #f3f8f6 0%,
                    #f8faf9 35%,
                    #f5f7f8 100%
                );

            min-height: calc(100vh - 70px);
        }

        /* Top Government-style Banner */
        .portal-banner {
            background:
                linear-gradient(
                    135deg,
                    #064e46 0%,
                    #075e54 45%,
                    #0f766e 100%
                );

            color: white;
            position: relative;
            overflow: hidden;
        }

        .portal-banner::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            right: -80px;
            top: -160px;
        }

        .portal-banner::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 50%;
            right: 80px;
            bottom: -150px;
        }

        .portal-banner-inner {
            position: relative;
            z-index: 2;
        }

        .portal-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .portal-title {
            font-size: 22px;
            line-height: 1.3;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .portal-subtitle {
            color: rgba(255,255,255,.72);
            font-size: 13px;
            margin-top: 4px;
        }

        /* Breadcrumb */
        .portal-breadcrumb {
            background: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .breadcrumb-item {
            font-size: 13px;
            color: #6b7280;
        }

        .breadcrumb-active {
            color: var(--primary);
            font-weight: 700;
        }

        /* Main Container */
        .orders-container {
            max-width: 1400px;
            margin: auto;
            padding: 28px 20px 50px;
        }

        /* Section Header */
        .section-heading {
            margin-bottom: 16px;
        }

        .section-title {
            color: #17201e;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.01em;
        }

        .section-description {
            margin-top: 4px;
            color: #6b7280;
            font-size: 13px;
        }

        /* Cards */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .stat-card {
            position: relative;
            background: #fff;
            border: 1px solid #e2e8e6;
            border-radius: 12px;
            padding: 20px;
            overflow: hidden;
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: #cbded9;
            box-shadow: 0 12px 30px rgba(15, 118, 110, .10);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .stat-card.green::before {
            background: #059669;
        }

        .stat-card.blue::before {
            background: #2563eb;
        }

        .stat-card.purple::before {
            background: #7c3aed;
        }

        .stat-card.orange::before {
            background: #d97706;
        }

        .stat-card.yellow::before {
            background: #ca8a04;
        }

        .stat-card-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .stat-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .stat-value {
            margin-top: 8px;
            color: #111827;
            font-size: 24px;
            line-height: 1.2;
            font-weight: 800;
        }

        .stat-value.green-text {
            color: #059669;
        }

        .stat-value.blue-text {
            color: #2563eb;
        }

        .stat-value.yellow-text {
            color: #ca8a04;
        }

        .stat-note {
            margin-top: 7px;
            font-size: 11px;
            color: #9ca3af;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-green {
            background: #ecfdf5;
            color: #059669;
        }

        .icon-blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .icon-purple {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .icon-orange {
            background: #fff7ed;
            color: #ea580c;
        }

        .icon-yellow {
            background: #fefce8;
            color: #ca8a04;
        }

        .icon-gray {
            background: #f3f4f6;
            color: #4b5563;
        }

        /* Panel */
        .data-panel {
            background: white;
            border: 1px solid #e1e7e5;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
        }

        .panel-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .panel-title {
            font-size: 17px;
            font-weight: 800;
            color: #17201e;
        }

        .panel-description {
            margin-top: 3px;
            font-size: 12px;
            color: #6b7280;
        }

        .count-badge {
            background: #edf6f4;
            color: var(--primary);
            border: 1px solid #d5e9e5;
            padding: 7px 11px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* Table */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .orders-table thead {
            background: #f5f8f7;
        }

        .orders-table th {
            padding: 13px 18px;
            text-align: left;
            font-size: 10px;
            color: #66716e;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 1px solid #e3e8e6;
            white-space: nowrap;
        }

        .orders-table td {
            padding: 16px 18px;
            border-bottom: 1px solid #edf0ef;
            vertical-align: middle;
        }

        .orders-table tbody tr {
            transition: background .15s ease;
        }

        .orders-table tbody tr:hover {
            background: #f7fbfa;
        }

        .orders-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Customer */
        .customer-wrapper {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .customer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #075e54, #0f766e);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .customer-name {
            color: #17201e;
            font-size: 13px;
            font-weight: 700;
        }

        .customer-phone {
            margin-top: 3px;
            color: #89938f;
            font-size: 11px;
        }

        /* Map */
        .map-title {
            color: #293330;
            font-size: 13px;
            font-weight: 700;
            max-width: 260px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .map-location {
            margin-top: 4px;
            color: #89938f;
            font-size: 11px;
        }

        /* Amount */
        .amount {
            color: #111827;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* Payment */
        .payment-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 7px;
            padding: 6px 9px;
            background: #f3f4f6;
            color: #59615f;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        /* Status */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-pending {
            background: #fffbeb;
            color: #a16207;
            border: 1px solid #fde68a;
        }

        .status-pending .status-dot {
            background: #eab308;
        }

        .status-paid {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .status-paid .status-dot {
            background: #10b981;
        }

        .status-completed {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .status-completed .status-dot {
            background: #3b82f6;
        }

        .status-failed {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .status-failed .status-dot {
            background: #ef4444;
        }

        .status-cancelled {
            background: #f3f4f6;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .status-cancelled .status-dot {
            background: #6b7280;
        }

        /* Action */
        .view-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 8px;
            background: white;
            border: 1px solid #d9dfdd;
            color: #45504c;
            font-size: 11px;
            font-weight: 800;
            transition: all .15s ease;
        }

        .view-button:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Best Selling */
        .best-table {
            width: 100%;
            min-width: 600px;
            border-collapse: collapse;
        }

        .best-table th {
            padding: 13px 20px;
            background: #f5f8f7;
            text-align: left;
            font-size: 10px;
            font-weight: 800;
            color: #66716e;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 1px solid #e3e8e6;
        }

        .best-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #edf0ef;
        }

        .best-table tbody tr:last-child td {
            border-bottom: none;
        }

        .best-table tbody tr:hover {
            background: #f7fbfa;
        }

        .map-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #edf6f4;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .map-cell {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .sales-number {
            display: inline-flex;
            min-width: 36px;
            justify-content: center;
            background: #f3f4f6;
            color: #374151;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 800;
        }

        .revenue {
            color: #059669;
            font-size: 13px;
            font-weight: 800;
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #f1f5f4;
            color: #9aa5a1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .empty-title {
            margin-top: 15px;
            font-size: 16px;
            font-weight: 800;
            color: #293330;
        }

        .empty-text {
            margin-top: 5px;
            font-size: 12px;
            color: #89938f;
        }

        /* Success Alert */
        .success-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            padding: 13px 16px;
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            color: #047857;
            font-size: 13px;
            font-weight: 700;
        }

        .success-icon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #d1fae5;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .orders-container {
                padding: 20px 12px 40px;
            }

            .portal-banner {
                padding: 18px 0;
            }

            .portal-title {
                font-size: 18px;
            }

            .portal-subtitle {
                font-size: 11px;
            }

            .portal-icon {
                width: 45px;
                height: 45px;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 17px;
            }

            .panel-header {
                padding: 16px;
            }

            .section-title {
                font-size: 16px;
            }
        }
    </style>


    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#075e54] text-white shadow-sm">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4h18M3 10h18M3 16h18M3 22h18"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-xl font-bold tracking-tight text-gray-900">
                        Order Management
                    </h2>

                    <p class="text-xs text-gray-500">
                        Sales & customer order administration
                    </p>

                </div>

            </div>

            <div class="hidden sm:flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 shadow-sm">

                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                Admin Portal

            </div>

        </div>

    </x-slot>


    {{-- =========================================================
        PAGE
    ========================================================== --}}

    <div class="orders-page">


        {{-- =====================================================
            GOVERNMENT PORTAL STYLE BANNER
        ====================================================== --}}

        <div class="portal-banner">

            <div class="orders-container !py-5">

                <div class="portal-banner-inner flex items-center gap-4">

                    <div class="portal-icon">

                        <svg class="h-7 w-7"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.7"
                                  d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zm0-14v14m6-16v14"/>

                        </svg>

                    </div>

                    <div>

                        <div class="portal-title">
                            MoujaMap Digital Map Portal
                        </div>

                        <div class="portal-subtitle">
                            Land map order management and digital service administration
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            BREADCRUMB
        ====================================================== --}}

        <div class="portal-breadcrumb">

            <div class="orders-container !py-3">

                <div class="flex items-center gap-2">

                    <span class="breadcrumb-item">
                        Dashboard
                    </span>

                    <svg class="h-3.5 w-3.5 text-gray-400"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>

                    </svg>

                    <span class="breadcrumb-active">
                        Orders
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            MAIN CONTENT
        ====================================================== --}}

        <div class="orders-container">


            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="success-alert">

                    <div class="success-icon">

                        <svg class="h-4 w-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2.5"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                    </div>

                    {{ session('success') }}

                </div>

            @endif


            {{-- =================================================
                SALES OVERVIEW
            ================================================== --}}

            <div class="mb-9">

                <div class="section-heading">

                    <div class="section-title">
                        Sales Overview
                    </div>

                    <div class="section-description">
                        Revenue generated from paid and completed orders
                    </div>

                </div>


                <div class="stat-grid">


                    {{-- TODAY --}}

                    <div class="stat-card green">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    Today's Sales
                                </div>

                                <div class="stat-value green-text">
                                    ৳{{ number_format($todaySales, 2) }}
                                </div>

                                <div class="stat-note">
                                    Revenue generated today
                                </div>

                            </div>

                            <div class="stat-icon icon-green">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.5 3 2.5S13.657 18 12 18m0-10V6m0 12v-2"/>

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- YESTERDAY --}}

                    <div class="stat-card blue">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    Yesterday
                                </div>

                                <div class="stat-value">
                                    ৳{{ number_format($yesterdaySales, 2) }}
                                </div>

                                <div class="stat-note">
                                    Previous day's revenue
                                </div>

                            </div>

                            <div class="stat-icon icon-blue">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 8v8m-3-3l3 3 3-3M5 5h14"/>

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- WEEK --}}

                    <div class="stat-card purple">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    This Week
                                </div>

                                <div class="stat-value">
                                    ৳{{ number_format($weekSales, 2) }}
                                </div>

                                <div class="stat-note">
                                    Current week's revenue
                                </div>

                            </div>

                            <div class="stat-icon icon-purple">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M3 12h18M3 6h18M3 18h18"/>

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- MONTH --}}

                    <div class="stat-card orange">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    This Month
                                </div>

                                <div class="stat-value">
                                    ৳{{ number_format($monthSales, 2) }}
                                </div>

                                <div class="stat-note">
                                    Current month's revenue
                                </div>

                            </div>

                            <div class="stat-icon icon-orange">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M4 19h16M6 16V8m4 8V5m4 11v-6m4 6V9"/>

                                </svg>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                ORDER STATISTICS
            ================================================== --}}

            <div class="mb-9">

                <div class="section-heading">

                    <div class="section-title">
                        Order Statistics
                    </div>

                    <div class="section-description">
                        Current order status and digital download activity
                    </div>

                </div>


                <div class="stat-grid">


                    {{-- TOTAL ORDERS --}}

                    <div class="stat-card">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    Total Orders
                                </div>

                                <div class="stat-value">
                                    {{ $totalOrders }}
                                </div>

                                <div class="stat-note">
                                    All customer orders
                                </div>

                            </div>

                            <div class="stat-icon icon-gray">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 5h6m-7 4h8m-9 4h10m-8 4h6M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"/>

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- PAID --}}

                    <div class="stat-card green">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    Paid Orders
                                </div>

                                <div class="stat-value green-text">
                                    {{ $paidOrders }}
                                </div>

                                <div class="stat-note">
                                    Payment confirmed
                                </div>

                            </div>

                            <div class="stat-icon icon-green">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 13l4 4L19 7"/>

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- PENDING --}}

                    <div class="stat-card yellow">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    Pending Orders
                                </div>

                                <div class="stat-value yellow-text">
                                    {{ $pendingOrders }}
                                </div>

                                <div class="stat-note">
                                    Requires attention
                                </div>

                            </div>

                            <div class="stat-icon icon-yellow">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 6v6l4 2m4-2a8 8 0 11-16 0 8 8 0 0116 0z"/>

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- DOWNLOADS --}}

                    <div class="stat-card blue">

                        <div class="stat-card-content">

                            <div>

                                <div class="stat-label">
                                    Total Downloads
                                </div>

                                <div class="stat-value blue-text">
                                    {{ $totalDownloads }}
                                </div>

                                <div class="stat-note">
                                    Digital map downloads
                                </div>

                            </div>

                            <div class="stat-icon icon-blue">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"/>

                                </svg>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                RECENT ORDERS
            ================================================== --}}

            <div class="data-panel mb-9">


                <div class="panel-header">

                    <div>

                        <div class="panel-title">
                            Recent Orders
                        </div>

                        <div class="panel-description">
                            Latest customer purchases and order activity
                        </div>

                    </div>

                    <div class="count-badge">
                        {{ $orders->count() }} Orders
                    </div>

                </div>


                @if($orders->count())


                    <div class="table-wrapper">

                        <table class="orders-table">

                            <thead>

                                <tr>

                                    <th>
                                        Customer
                                    </th>

                                    <th>
                                        Map
                                    </th>

                                    <th>
                                        Amount
                                    </th>

                                    <th>
                                        Payment
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th class="text-right">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($orders as $order)

                                    @php

                                        $statusClass = match($order->status) {

                                            'pending' => 'status-pending',

                                            'paid' => 'status-paid',

                                            'completed' => 'status-completed',

                                            'failed' => 'status-failed',

                                            'cancelled' => 'status-cancelled',

                                            default => 'status-cancelled',

                                        };

                                    @endphp


                                    <tr>


                                        {{-- CUSTOMER --}}

                                        <td>

                                            <div class="customer-wrapper">

                                                <div class="customer-avatar">

                                                    {{ strtoupper(substr($order->customer_name, 0, 1)) }}

                                                </div>

                                                <div>

                                                    <div class="customer-name">
                                                        {{ $order->customer_name }}
                                                    </div>

                                                    <div class="customer-phone">
                                                        {{ $order->phone }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- MAP --}}

                                        <td>

                                            <div class="map-title">

                                                {{ $order->map?->title ?? 'Map Deleted' }}

                                            </div>

                                            @if($order->map?->mouza)

                                                <div class="map-location">

                                                    {{ $order->map->mouza->name }}

                                                </div>

                                            @endif

                                        </td>


                                        {{-- AMOUNT --}}

                                        <td>

                                            <span class="amount">

                                                ৳{{ number_format($order->amount, 2) }}

                                            </span>

                                        </td>


                                        {{-- PAYMENT --}}

                                        <td>

                                            <span class="payment-badge">

                                                {{ $order->payment_method ?? 'N/A' }}

                                            </span>

                                        </td>


                                        {{-- STATUS --}}

                                        <td>

                                            <span class="status-badge {{ $statusClass }}">

                                                <span class="status-dot"></span>

                                                {{ ucfirst($order->status) }}

                                            </span>

                                        </td>


                                        {{-- ACTION --}}

                                        <td class="text-right">

                                            <a href="{{ route('admin.orders.show', $order) }}"
                                               class="view-button">

                                                View

                                                <svg class="h-3.5 w-3.5"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
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


                    <div class="empty-state">

                        <div class="empty-icon">

                            <svg class="h-7 w-7"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.7"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>

                            </svg>

                        </div>

                        <div class="empty-title">
                            No orders yet
                        </div>

                        <div class="empty-text">
                            Customer orders will appear here.
                        </div>

                    </div>

                @endif

            </div>


            {{-- =================================================
                BEST SELLING MAPS
            ================================================== --}}

            <div class="data-panel">


                <div class="panel-header">

                    <div>

                        <div class="panel-title">
                            Best Selling Maps
                        </div>

                        <div class="panel-description">
                            Top maps based on completed purchases
                        </div>

                    </div>

                    <div class="count-badge">
                        Top Maps
                    </div>

                </div>


                @if($bestSellingMaps->count())


                    <div class="table-wrapper">

                        <table class="best-table">

                            <thead>

                                <tr>

                                    <th>
                                        Map
                                    </th>

                                    <th class="text-center">
                                        Sales
                                    </th>

                                    <th class="text-right">
                                        Revenue
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($bestSellingMaps as $item)

                                    <tr>


                                        {{-- MAP --}}

                                        <td>

                                            <div class="map-cell">

                                                <div class="map-icon">

                                                    <svg class="h-5 w-5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="1.7"
                                                              d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zm0-14v14m6-16v14"/>

                                                    </svg>

                                                </div>


                                                <div>

                                                    <div class="customer-name">

                                                        {{ $item->map?->title ?? 'Map Deleted' }}

                                                    </div>

                                                    @if($item->map?->mouza)

                                                        <div class="map-location">

                                                            {{ $item->map->mouza->name }}

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </td>


                                        {{-- SALES --}}

                                        <td class="text-center">

                                            <span class="sales-number">

                                                {{ $item->total_sales }}

                                            </span>

                                        </td>


                                        {{-- REVENUE --}}

                                        <td class="text-right">

                                            <span class="revenue">

                                                ৳{{ number_format($item->total_revenue, 2) }}

                                            </span>

                                        </td>


                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                @else


                    <div class="empty-state">

                        <div class="empty-icon">

                            <svg class="h-7 w-7"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.7"
                                      d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zm0-14v14m6-16v14"/>

                            </svg>

                        </div>

                        <div class="empty-title">
                            No sales data available
                        </div>

                        <div class="empty-text">
                            Best selling maps will appear after completed purchases.
                        </div>

                    </div>

                @endif


            </div>


        </div>

    </div>

</x-app-layout>