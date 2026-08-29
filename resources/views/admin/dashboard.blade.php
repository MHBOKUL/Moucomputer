
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MoujaMap — Admin Dashboard</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --dark: #111827;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f6f8fc;
            --white: #ffffff;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
        }

        body {
            font-family: Inter, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #111827;
            color: white;
            padding: 24px 16px;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 30px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            margin-bottom: 25px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }

        .brand h2 {
            font-size: 19px;
            font-weight: 700;
        }

        .brand span {
            display: block;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6b7280;
            padding: 0 12px;
            margin-bottom: 8px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            color: #d1d5db;
            font-size: 14px;
            transition: .2s;
        }

        .nav a:hover,
        .nav a.active {
            background: #1f2937;
            color: white;
        }

        .nav-icon {
            width: 22px;
            text-align: center;
        }

        .sidebar-bottom {
            position: absolute;
            bottom: 22px;
            left: 16px;
            right: 16px;
        }

        .logout {
            width: 100%;
            padding: 11px;
            border: 1px solid #374151;
            background: transparent;
            color: #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
        }

        .logout:hover {
            background: #1f2937;
        }


        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .topbar-title {
            font-size: 14px;
            color: var(--muted);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .admin-info strong {
            display: block;
            font-size: 13px;
        }

        .admin-info span {
            font-size: 11px;
            color: var(--muted);
        }

        .content {
            padding: 32px 35px;
        }


        /* =========================
           WELCOME
        ========================= */

        .welcome {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 25px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 25px;
            margin-bottom: 6px;
        }

        .welcome p {
            color: var(--muted);
            font-size: 14px;
        }

        .date-box {
            color: var(--muted);
            font-size: 13px;
        }


        /* =========================
           SECTION HEADER
        ========================= */

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .section-header h2 {
            font-size: 18px;
        }

        .section-header span {
            color: var(--muted);
            font-size: 12px;
        }


        /* =========================
           STATISTICS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,.06);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: var(--primary);
            font-size: 18px;
        }

        .stat-number {
            font-size: 27px;
            font-weight: 700;
            margin-top: 14px;
        }

        .stat-note {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
        }


        /* =========================
           PANELS
        ========================= */

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 22px;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 18px;
        }


        /* =========================
           MANAGEMENT
        ========================= */

        .management-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .management-item {
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: .2s;
        }

        .management-item:hover {
            border-color: #bfdbfe;
            background: #f8fbff;
        }

        .management-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .management-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .management-name {
            font-size: 13px;
            font-weight: 600;
        }

        .management-count {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        .manage-btn {
            color: var(--primary);
            font-size: 12px;
            font-weight: 600;
        }


        /* =========================
           QUICK ACTIONS
        ========================= */

        .quick-action {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid var(--border);
            padding: 13px;
            border-radius: 9px;
            transition: .2s;
        }

        .action-btn:hover {
            background: #f8fbff;
            border-color: #bfdbfe;
        }

        .action-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-text strong {
            display: block;
            font-size: 13px;
        }

        .action-text span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-top: 2px;
        }


        /* =========================
           ORDER PANEL
        ========================= */

        .order-table-wrapper {
            overflow-x: auto;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th {
            text-align: left;
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            padding: 12px;
            border-bottom: 1px solid var(--border);
        }

        .order-table td {
            padding: 13px 12px;
            font-size: 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .order-table tr:last-child td {
            border-bottom: none;
        }

        .customer-name {
            font-weight: 600;
        }

        .customer-phone {
            font-size: 10px;
            color: var(--muted);
            margin-top: 3px;
        }

        .badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-warning {
            background: #fef3c7;
            color: #b45309;
        }

        .badge-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .amount {
            font-weight: 700;
        }


        /* =========================
           MAP STATUS
        ========================= */

        .map-status {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .status-box {
            border-radius: 9px;
            padding: 15px;
            background: #f9fafb;
        }

        .status-box span {
            display: block;
            color: var(--muted);
            font-size: 11px;
        }

        .status-box strong {
            display: block;
            font-size: 21px;
            margin-top: 6px;
        }

        .active {
            color: var(--success);
        }

        .inactive {
            color: var(--danger);
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1100px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 750px) {

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .sidebar-bottom {
                position: static;
                margin-top: 25px;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 18px;
            }

            .content {
                padding: 20px 15px;
            }

            .welcome {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .management-list {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


<!-- =========================
     SIDEBAR
========================= -->

<aside class="sidebar">

    <div class="brand">

        <div class="brand-icon">
            M
        </div>

        <div>
            <h2>MoujaMap</h2>
            <span>Administration</span>
        </div>

    </div>


    <div class="menu-title">
        Main Menu
    </div>


    <nav class="nav">

        <a href="{{ route('admin.dashboard') }}" class="active">
            <span class="nav-icon">▦</span>
            Dashboard
        </a>


        <a href="{{ route('admin.divisions.index') }}">
            <span class="nav-icon">◈</span>
            Divisions
        </a>


        <a href="{{ route('admin.districts.index') }}">
            <span class="nav-icon">◇</span>
            Districts
        </a>


        <a href="{{ route('admin.upazilas.index') }}">
            <span class="nav-icon">⌂</span>
            Upazilas
        </a>


        <a href="{{ route('admin.mouzas.index') }}">
            <span class="nav-icon">▤</span>
            Mouzas
        </a>


        <a href="{{ route('admin.maps.index') }}">
            <span class="nav-icon">▧</span>
            Maps / PDFs
        </a>

    </nav>


    <div class="menu-title" style="margin-top:28px;">
        System
    </div>


    <nav class="nav">

        <a href="{{ route('profile.edit') }}">
            <span class="nav-icon">⚙</span>
            Profile Settings
        </a>

    </nav>


    <div class="sidebar-bottom">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button class="logout" type="submit">
                ↪ &nbsp; Logout
            </button>

        </form>

    </div>

</aside>



<!-- =========================
     MAIN
========================= -->

<main class="main">


    <!-- TOPBAR -->

    <header class="topbar">

        <div class="topbar-title">
            Admin Panel / Dashboard
        </div>


        <div class="admin-profile">

            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>


            <div class="admin-info">

                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <span>
                    Administrator
                </span>

            </div>

        </div>

    </header>



    <div class="content">


        <!-- =========================
             WELCOME
        ========================= -->

        <section class="welcome">

            <div>

                <h1>
                    Welcome back, {{ auth()->user()->name }} 👋
                </h1>

                <p>
                    Manage your MoujaMap platform from one place.
                </p>

            </div>


            <div class="date-box">
                {{ now()->format('l, d F Y') }}
            </div>

        </section>



        <!-- =========================
             OVERVIEW
        ========================= -->

        <div class="section-header">

            <h2>
                Overview
            </h2>

            <span>
                Live database statistics
            </span>

        </div>



        <section class="stats">


            <!-- DIVISIONS -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Divisions
                    </div>

                    <div class="stat-icon">
                        ◈
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\Division::count() }}
                </div>

                <div class="stat-note">
                    Administrative divisions
                </div>

            </div>



            <!-- DISTRICTS -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Districts
                    </div>

                    <div class="stat-icon">
                        ◇
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\District::count() }}
                </div>

                <div class="stat-note">
                    Districts registered
                </div>

            </div>



            <!-- UPAZILAS -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Upazilas
                    </div>

                    <div class="stat-icon">
                        ⌂
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\Upazila::count() }}
                </div>

                <div class="stat-note">
                    Upazilas registered
                </div>

            </div>



            <!-- MOUZAS -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Mouzas
                    </div>

                    <div class="stat-icon">
                        ▤
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\Mouza::count() }}
                </div>

                <div class="stat-note">
                    Mouzas registered
                </div>

            </div>



            <!-- SURVEY TYPES -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Survey Types
                    </div>

                    <div class="stat-icon">
                        ≡
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\SurveyType::count() }}
                </div>

                <div class="stat-note">
                    Available survey types
                </div>

            </div>



            <!-- MAPS -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Maps
                    </div>

                    <div class="stat-icon">
                        ▧
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\Map::count() }}
                </div>

                <div class="stat-note">
                    PDF maps uploaded
                </div>

            </div>



            <!-- ORDERS -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Orders
                    </div>

                    <div class="stat-icon">
                        🛒
                    </div>

                </div>

                <div class="stat-number">
                    {{ \App\Models\Order::count() }}
                </div>

                <div class="stat-note">
                    Customer orders
                </div>

            </div>



            <!-- REVENUE -->

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Revenue
                    </div>

                    <div class="stat-icon">
                        ৳
                    </div>

                </div>

                <div class="stat-number">
                    ৳{{ number_format(\App\Models\Order::where('status', 'completed')->sum('amount'), 2) }}
                </div>

                <div class="stat-note">
                    Completed order revenue
                </div>

            </div>


        </section>



        <!-- =========================
             SECONDARY STATS
        ========================= -->

        <section class="panel" style="margin-bottom:30px;">

            <div class="panel-title">
                Sales Overview
            </div>


            <div class="map-status">


                <div class="status-box">

                    <span>
                        Completed Orders
                    </span>

                    <strong class="active">
                        {{ \App\Models\Order::where('status', 'completed')->count() }}
                    </strong>

                </div>



                <div class="status-box">

                    <span>
                        Pending Orders
                    </span>

                    <strong style="color:#d97706;">
                        {{ \App\Models\Order::where('status', 'pending')->count() }}
                    </strong>

                </div>



                <div class="status-box">

                    <span>
                        Downloads
                    </span>

                    <strong>
                        {{ \App\Models\Order::sum('download_count') }}
                    </strong>

                </div>



                <div class="status-box">

                    <span>
                        Paid Order Value
                    </span>

                    <strong>
                        ৳{{ number_format(\App\Models\Order::where('status', 'completed')->sum('amount'), 2) }}
                    </strong>

                </div>


            </div>

        </section>



        <!-- =========================
             MAIN GRID
        ========================= -->

        <section class="dashboard-grid">


            <!-- ADMINISTRATIVE MANAGEMENT -->

            <div class="panel">

                <div class="panel-title">
                    Administrative Management
                </div>


                <div class="management-list">


                    <div class="management-item">

                        <div class="management-left">

                            <div class="management-icon">
                                ◈
                            </div>

                            <div>

                                <div class="management-name">
                                    Divisions
                                </div>

                                <div class="management-count">
                                    {{ \App\Models\Division::count() }} records
                                </div>

                            </div>

                        </div>


                        <a href="{{ route('admin.divisions.index') }}"
                           class="manage-btn">
                            Manage →
                        </a>

                    </div>



                    <div class="management-item">

                        <div class="management-left">

                            <div class="management-icon">
                                ◇
                            </div>

                            <div>

                                <div class="management-name">
                                    Districts
                                </div>

                                <div class="management-count">
                                    {{ \App\Models\District::count() }} records
                                </div>

                            </div>

                        </div>


                        <a href="{{ route('admin.districts.index') }}"
                           class="manage-btn">
                            Manage →
                        </a>

                    </div>



                    <div class="management-item">

                        <div class="management-left">

                            <div class="management-icon">
                                ⌂
                            </div>

                            <div>

                                <div class="management-name">
                                    Upazilas
                                </div>

                                <div class="management-count">
                                    {{ \App\Models\Upazila::count() }} records
                                </div>

                            </div>

                        </div>


                        <a href="{{ route('admin.upazilas.index') }}"
                           class="manage-btn">
                            Manage →
                        </a>

                    </div>



                    <div class="management-item">

                        <div class="management-left">

                            <div class="management-icon">
                                ▤
                            </div>

                            <div>

                                <div class="management-name">
                                    Mouzas
                                </div>

                                <div class="management-count">
                                    {{ \App\Models\Mouza::count() }} records
                                </div>

                            </div>

                        </div>


                        <a href="{{ route('admin.mouzas.index') }}"
                           class="manage-btn">
                            Manage →
                        </a>

                    </div>



                    <div class="management-item">

                        <div class="management-left">

                            <div class="management-icon">
                                ≡
                            </div>

                            <div>

                                <div class="management-name">
                                    Survey Types
                                </div>

                                <div class="management-count">
                                    {{ \App\Models\SurveyType::count() }} types
                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="management-item">

                        <div class="management-left">

                            <div class="management-icon">
                                ▧
                            </div>

                            <div>

                                <div class="management-name">
                                    Maps / PDFs
                                </div>

                                <div class="management-count">
                                    {{ \App\Models\Map::count() }} maps
                                </div>

                            </div>

                        </div>


                        <a href="{{ route('admin.maps.index') }}"
                           class="manage-btn">
                            Manage →
                        </a>

                    </div>



                </div>

            </div>



            <!-- QUICK ACTIONS -->

            <div class="panel">

                <div class="panel-title">
                    Quick Actions
                </div>


                <div class="quick-action">


                    <a href="{{ route('admin.divisions.create') }}"
                       class="action-btn">

                        <div class="action-icon">
                            +
                        </div>

                        <div class="action-text">

                            <strong>
                                Add Division
                            </strong>

                            <span>
                                Create a new division
                            </span>

                        </div>

                    </a>



                    <a href="{{ route('admin.districts.create') }}"
                       class="action-btn">

                        <div class="action-icon">
                            +
                        </div>

                        <div class="action-text">

                            <strong>
                                Add District
                            </strong>

                            <span>
                                Register a district
                            </span>

                        </div>

                    </a>



                    <a href="{{ route('admin.upazilas.create') }}"
                       class="action-btn">

                        <div class="action-icon">
                            +
                        </div>

                        <div class="action-text">

                            <strong>
                                Add Upazila
                            </strong>

                            <span>
                                Register a new upazila
                            </span>

                        </div>

                    </a>



                    <a href="{{ route('admin.mouzas.create') }}"
                       class="action-btn">

                        <div class="action-icon">
                            +
                        </div>

                        <div class="action-text">

                            <strong>
                                Add Mouza
                            </strong>

                            <span>
                                Add mouza information
                            </span>

                        </div>

                    </a>



                    <a href="{{ route('admin.maps.create') }}"
                       class="action-btn">

                        <div class="action-icon">
                            ↑
                        </div>

                        <div class="action-text">

                            <strong>
                                Upload Map PDF
                            </strong>

                            <span>
                                Add a downloadable map
                            </span>

                        </div>

                    </a>


                </div>

            </div>


        </section>



        <!-- =========================
             RECENT ORDERS
        ========================= -->

        <section class="panel" style="margin-bottom:30px;">

            <div class="section-header">

                <h2>
                    Recent Orders
                </h2>

                <span>
                    Latest customer purchases
                </span>

            </div>


            <div class="order-table-wrapper">

                <table class="order-table">

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

                            <th>
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse(
                            \App\Models\Order::with('map')
                                ->latest()
                                ->limit(5)
                                ->get()
                            as $order
                        )

                            <tr>

                                <td>

                                    <div class="customer-name">
                                        {{ $order->customer_name }}
                                    </div>

                                    <div class="customer-phone">
                                        {{ $order->phone }}
                                    </div>

                                </td>


                                <td>

                                    {{ $order->map?->title ?? 'Map unavailable' }}

                                </td>


                                <td>

                                    <span class="amount">
                                        ৳{{ number_format($order->amount, 2) }}
                                    </span>

                                </td>


                                <td>

                                    {{ $order->payment_method }}

                                </td>


                                <td>

                                    @if($order->status === 'completed')

                                        <span class="badge badge-success">
                                            Completed
                                        </span>

                                    @elseif($order->status === 'pending')

                                        <span class="badge badge-warning">
                                            Pending
                                        </span>

                                    @else

                                        <span class="badge badge-danger">
                                            {{ ucfirst($order->status) }}
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    style="text-align:center;color:#6b7280;padding:25px;">

                                    No orders found.

                                </td>

                            </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>

        </section>



        <!-- =========================
             MAP INVENTORY
        ========================= -->

        <section class="panel">

            <div class="panel-title">
                Map Inventory
            </div>


            <div class="map-status">


                <div class="status-box">

                    <span>
                        Active Maps
                    </span>

                    <strong class="active">
                        {{ \App\Models\Map::where('is_active', true)->count() }}
                    </strong>

                </div>



                <div class="status-box">

                    <span>
                        Inactive Maps
                    </span>

                    <strong class="inactive">
                        {{ \App\Models\Map::where('is_active', false)->count() }}
                    </strong>

                </div>



                <div class="status-box">

                    <span>
                        Free Maps
                    </span>

                    <strong>
                        {{ \App\Models\Map::where('price', 0)->count() }}
                    </strong>

                </div>



                <div class="status-box">

                    <span>
                        Paid Maps
                    </span>

                    <strong>
                        {{ \App\Models\Map::where('price', '>', 0)->count() }}
                    </strong>

                </div>


            </div>

        </section>


    </div>

</main>


</body>

</html>

