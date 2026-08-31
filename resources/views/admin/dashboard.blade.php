
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MoujaMap — Admin Dashboard</title>

    <style>

        /* =========================================================
           ROOT
        ========================================================= */

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;

            --dark: #111827;
            --dark-2: #1f2937;

            --text: #172033;
            --muted: #64748b;

            --bg: #f6f8fc;
            --white: #ffffff;

            --border: #e5e7eb;
            --border-light: #eef2f7;

            --success: #16a34a;
            --success-bg: #dcfce7;

            --warning: #d97706;
            --warning-bg: #fef3c7;

            --danger: #dc2626;
            --danger-bg: #fee2e2;

            --purple: #7c3aed;
            --purple-bg: #f3e8ff;

            --shadow:
                0 1px 2px rgba(15, 23, 42, .03),
                0 6px 20px rgba(15, 23, 42, .04);

            --sidebar-width: 250px;
        }


        /* =========================================================
           RESET
        ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select {
            font-family: inherit;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: var(--sidebar-width);
            height: 100vh;

            background: var(--dark);
            color: #fff;

            padding: 20px 14px;

            z-index: 1000;

            display: flex;
            flex-direction: column;

            overflow-y: auto;

            transition: transform .25s ease;
        }


        /* BRAND */

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 0 10px 22px;

            border-bottom:
                1px solid rgba(255,255,255,.08);
        }

        .brand-logo {
            width: 40px;
            height: 40px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #3b82f6
                );

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            font-weight: 800;

            box-shadow:
                0 8px 20px rgba(37,99,235,.28);
        }

        .brand-name {
            font-size: 17px;
            font-weight: 750;
            letter-spacing: -.3px;
        }

        .brand-subtitle {
            display: block;

            color: #94a3b8;

            font-size: 10px;

            margin-top: 1px;
        }


        /* MENU */

        .menu-title {
            color: #64748b;

            font-size: 9px;
            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .12em;

            padding: 0 12px;

            margin: 25px 0 8px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .nav-link {
            display: flex;
            align-items: center;

            gap: 12px;

            padding: 10px 12px;

            border-radius: 8px;

            color: #cbd5e1;

            font-size: 12px;
            font-weight: 550;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .nav-link:hover {
            background: rgba(255,255,255,.06);
            color: #fff;

            transform: translateX(2px);
        }

        .nav-link.active {
            background: var(--primary);
            color: #fff;

            box-shadow:
                0 6px 18px rgba(37,99,235,.25);
        }

        .nav-icon {
            width: 20px;

            text-align: center;

            font-size: 15px;

            flex-shrink: 0;
        }


        /* SIDEBAR FOOTER */

        .sidebar-footer {
            margin-top: auto;
            padding-top: 20px;
        }

        .admin-mini {
            display: flex;
            align-items: center;

            gap: 9px;

            padding: 10px;
            margin-bottom: 10px;

            background: rgba(255,255,255,.04);

            border:
                1px solid rgba(255,255,255,.06);

            border-radius: 9px;
        }

        .admin-mini-avatar {
            width: 32px;
            height: 32px;

            border-radius: 50%;

            background: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 11px;
            font-weight: 800;
        }

        .admin-mini-info {
            min-width: 0;
        }

        .admin-mini-info strong {
            display: block;

            color: #fff;

            font-size: 10px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .admin-mini-info span {
            display: block;

            color: #94a3b8;

            font-size: 8px;

            margin-top: 1px;
        }

        .logout {
            width: 100%;

            padding: 9px 11px;

            border:
                1px solid #374151;

            border-radius: 8px;

            background: transparent;

            color: #cbd5e1;

            cursor: pointer;

            font-size: 11px;

            transition: .2s;
        }

        .logout:hover {
            background: #1f2937;
            color: #fff;

            border-color: #475569;
        }


        /* =========================================================
           SIDEBAR OVERLAY
        ========================================================= */

        .sidebar-overlay {
            display: none;

            position: fixed;
            inset: 0;

            background: rgba(15,23,42,.48);

            z-index: 900;
        }

        .sidebar-overlay.active {
            display: block;
        }


        /* =========================================================
           MAIN
        ========================================================= */

        .main {
            margin-left: var(--sidebar-width);

            min-height: 100vh;
        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {
            height: 68px;

            background: rgba(255,255,255,.96);

            border-bottom:
                1px solid var(--border);

            padding: 0 30px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            position: sticky;
            top: 0;

            z-index: 800;

            backdrop-filter: blur(10px);
        }

        .topbar-left {
            display: flex;
            align-items: center;

            gap: 13px;
        }

        .mobile-menu {
            display: none;

            width: 37px;
            height: 37px;

            border:
                1px solid var(--border);

            border-radius: 8px;

            background: #fff;

            cursor: pointer;

            font-size: 17px;
        }

        .breadcrumb {
            color: var(--muted);

            font-size: 11px;
        }

        .breadcrumb strong {
            color: var(--text);

            font-weight: 700;
        }

        .breadcrumb-separator {
            padding: 0 5px;

            color: #cbd5e1;
        }


        /* TOP PROFILE */

        .top-profile {
            display: flex;
            align-items: center;

            gap: 10px;
        }

        .top-avatar {
            width: 37px;
            height: 37px;

            border-radius: 50%;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 12px;
            font-weight: 800;
        }

        .top-user strong {
            display: block;

            font-size: 11px;
            font-weight: 750;
        }

        .top-user span {
            display: block;

            color: var(--muted);

            font-size: 9px;

            margin-top: 1px;
        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .content {
            max-width: 1650px;

            margin: 0 auto;

            padding: 27px 30px 45px;
        }


        /* =========================================================
           WELCOME
        ========================================================= */

        .welcome {
            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #f8fbff
                );

            border:
                1px solid var(--border);

            border-radius: 13px;

            padding: 23px 25px;

            margin-bottom: 25px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow: var(--shadow);
        }

        .welcome h1 {
            font-size: 22px;

            line-height: 1.3;

            letter-spacing: -.5px;

            margin-bottom: 5px;
        }

        .welcome p {
            color: var(--muted);

            font-size: 11px;
        }

        .date-box {
            padding: 8px 12px;

            border:
                1px solid var(--border);

            border-radius: 8px;

            background: #fff;

            color: var(--muted);

            font-size: 10px;

            font-weight: 650;
        }


        /* =========================================================
           SECTION
        ========================================================= */

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 13px;
        }

        .section-header h2 {
            font-size: 15px;

            font-weight: 750;

            letter-spacing: -.2px;
        }

        .section-header span {
            color: var(--muted);

            font-size: 9px;
        }


        /* =========================================================
           KPI
        ========================================================= */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;

            margin-bottom: 25px;
        }

        .stat-card {
            background: #fff;

            border:
                1px solid var(--border);

            border-radius: 11px;

            padding: 17px;

            box-shadow: var(--shadow);

            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(15,23,42,.08);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label {
            color: var(--muted);

            font-size: 10px;

            font-weight: 650;
        }

        .stat-icon {
            width: 37px;
            height: 37px;

            border-radius: 9px;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 16px;

            font-weight: 800;
        }

        .stat-icon.green {
            background: var(--success-bg);
            color: var(--success);
        }

        .stat-icon.orange {
            background: var(--warning-bg);
            color: var(--warning);
        }

        .stat-icon.purple {
            background: var(--purple-bg);
            color: var(--purple);
        }

        .stat-number {
            margin-top: 13px;

            font-size: 24px;

            font-weight: 800;

            letter-spacing: -.5px;
        }

        .stat-note {
            color: var(--muted);

            font-size: 9px;

            margin-top: 3px;
        }


        /* =========================================================
           PANEL
        ========================================================= */

        .panel {
            background: #fff;

            border:
                1px solid var(--border);

            border-radius: 11px;

            padding: 19px;

            box-shadow: var(--shadow);
        }

        .panel-title {
            font-size: 14px;

            font-weight: 750;

            margin-bottom: 15px;
        }


        /* =========================================================
           SALES
        ========================================================= */

        .sales-panel {
            margin-bottom: 18px;
        }

        .sales-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 11px;
        }

        .sales-card {
            padding: 15px;

            background: #fafbfc;

            border:
                1px solid var(--border);

            border-radius: 9px;

            transition: .2s;
        }

        .sales-card:hover {
            border-color: #bfdbfe;

            background: #f8fbff;
        }

        .sales-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            color: var(--muted);

            font-size: 9px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .04em;
        }

        .sales-value {
            margin-top: 8px;

            font-size: 21px;

            font-weight: 800;
        }

        .sales-orders {
            color: var(--muted);

            font-size: 9px;

            margin-top: 2px;
        }

        .sales-orders strong {
            color: var(--text);
        }


        /* =========================================================
           TWO COLUMN
        ========================================================= */

        .two-column {
            display: grid;

            grid-template-columns:
                1.5fr 1fr;

            gap: 18px;

            margin-bottom: 18px;
        }


        /* =========================================================
           MANAGEMENT
        ========================================================= */

        .management-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 9px;
        }

        .management-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 10px;

            padding: 11px;

            border:
                1px solid var(--border);

            border-radius: 8px;

            transition: .2s;
        }

        .management-item:hover {
            background: #f8fbff;

            border-color: #bfdbfe;
        }

        .management-left {
            display: flex;
            align-items: center;

            gap: 9px;

            min-width: 0;
        }

        .management-icon {
            width: 32px;
            height: 32px;

            flex-shrink: 0;

            border-radius: 8px;

            background: #f1f5f9;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 14px;
        }

        .management-name {
            font-size: 11px;

            font-weight: 750;
        }

        .management-count {
            color: var(--muted);

            font-size: 8px;

            margin-top: 1px;
        }

        .manage-link {
            color: var(--primary);

            font-size: 9px;

            font-weight: 750;

            white-space: nowrap;
        }


        /* =========================================================
           QUICK ACTIONS
        ========================================================= */

        .quick-actions {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 8px;
        }

        .action {
            display: flex;
            align-items: center;

            gap: 9px;

            padding: 10px;

            border:
                1px solid var(--border);

            border-radius: 8px;

            transition: .2s;
        }

        .action:hover {
            background: #f8fbff;

            border-color: #bfdbfe;

            transform: translateY(-1px);
        }

        .action-icon {
            width: 31px;
            height: 31px;

            flex-shrink: 0;

            border-radius: 8px;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 15px;

            font-weight: 800;
        }

        .action-text strong {
            display: block;

            font-size: 10px;

            font-weight: 750;
        }

        .action-text span {
            display: block;

            color: var(--muted);

            font-size: 8px;

            margin-top: 1px;
        }


        /* =========================================================
           ORDERS
        ========================================================= */

        .orders-panel {
            margin-bottom: 18px;
        }

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        .orders-table {
            width: 100%;

            min-width: 750px;

            border-collapse: collapse;
        }

        .orders-table th {
            text-align: left;

            padding: 9px 10px;

            background: #fafbfc;

            border-bottom:
                1px solid var(--border);

            color: var(--muted);

            font-size: 8px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .05em;
        }

        .orders-table td {
            padding: 11px 10px;

            border-bottom:
                1px solid var(--border-light);

            font-size: 10px;

            vertical-align: middle;
        }

        .orders-table tbody tr:hover {
            background: #fafcff;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .order-id {
            color: var(--primary);

            font-size: 9px;

            font-weight: 800;
        }

        .customer-name {
            font-size: 10px;

            font-weight: 750;
        }

        .customer-phone {
            color: var(--muted);

            font-size: 8px;

            margin-top: 2px;
        }

        .map-title {
            max-width: 180px;

            overflow: hidden;

            white-space: nowrap;

            text-overflow: ellipsis;

            font-size: 9px;
        }

        .amount {
            font-weight: 800;

            white-space: nowrap;
        }

        .payment {
            color: var(--muted);

            font-size: 9px;
        }


        /* =========================================================
           BADGES
        ========================================================= */

        .badge {
            display: inline-flex;

            align-items: center;

            padding: 4px 7px;

            border-radius: 5px;

            font-size: 8px;

            font-weight: 800;
        }

        .badge-success {
            background: var(--success-bg);

            color: #15803d;
        }

        .badge-warning {
            background: var(--warning-bg);

            color: #b45309;
        }

        .badge-danger {
            background: var(--danger-bg);

            color: #b91c1c;
        }


        /* =========================================================
           LOWER SECTION
        ========================================================= */

        .lower-grid {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 18px;
        }


        /* =========================================================
           TOP MAPS
        ========================================================= */

        .top-map {
            display: flex;
            align-items: center;

            gap: 10px;

            padding: 10px 0;

            border-bottom:
                1px solid var(--border-light);
        }

        .top-map:last-child {
            border-bottom: none;
        }

        .rank {
            width: 29px;
            height: 29px;

            flex-shrink: 0;

            border-radius: 7px;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 9px;

            font-weight: 800;
        }

        .map-info {
            flex: 1;

            min-width: 0;
        }

        .map-info strong {
            display: block;

            font-size: 10px;

            font-weight: 750;

            overflow: hidden;

            white-space: nowrap;

            text-overflow: ellipsis;
        }

        .map-info span {
            display: block;

            color: var(--muted);

            font-size: 8px;

            margin-top: 2px;
        }

        .map-sales {
            text-align: right;

            font-size: 10px;

            font-weight: 800;
        }

        .map-sales span {
            display: block;

            color: var(--muted);

            font-size: 7px;

            font-weight: 500;
        }
/* =========================================================
   RECENT ORDERS - 5 ROW SCROLL
========================================================= */

.orders-panel .table-wrapper {
    width: 100%;
    overflow-x: auto;
    overflow-y: auto;

    /* Approximately 5 orders visible */
    max-height: 285px;

    border-radius: 8px;
}

/* Keep table header visible while scrolling */
.orders-table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: #fafbfc;
}

/* Custom scrollbar */
.orders-panel .table-wrapper::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.orders-panel .table-wrapper::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.orders-panel .table-wrapper::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.orders-panel .table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

        /* =========================================================
           INVENTORY
        ========================================================= */

        .inventory-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 9px;
        }

        .inventory-card {
            padding: 13px;

            background: #fafbfc;

            border:
                1px solid var(--border);

            border-radius: 8px;
        }

        .inventory-card span {
            display: block;

            color: var(--muted);

            font-size: 8px;
        }

        .inventory-card strong {
            display: block;

            margin-top: 3px;

            font-size: 19px;

            font-weight: 800;
        }

        .inventory-card.active strong {
            color: var(--success);
        }

        .inventory-card.inactive strong {
            color: var(--danger);
        }


        /* ORDER STATUS */

        .subsection {
            margin-top: 17px;
        }

        .subsection-title {
            font-size: 11px;

            font-weight: 750;

            margin-bottom: 8px;
        }


        /* DOWNLOAD */

        .download-box {
            margin-top: 10px;

            padding: 12px;

            border:
                1px solid #dbeafe;

            border-radius: 8px;

            background: var(--primary-light);
        }

        .download-label {
            color: var(--muted);

            font-size: 8px;
        }

        .download-value {
            color: var(--primary);

            font-size: 20px;

            font-weight: 800;

            margin-top: 2px;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            text-align: center;

            padding: 30px 15px;

            color: var(--muted);

            font-size: 10px;
        }

        .empty-icon {
            font-size: 25px;

            opacity: .45;

            margin-bottom: 6px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1200px) {

            .stats {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .two-column {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 900px) {

            :root {
                --sidebar-width: 250px;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .mobile-menu {
                display: flex;

                align-items: center;
                justify-content: center;
            }

            .topbar {
                padding: 0 18px;
            }

            .content {
                padding: 22px 18px 35px;
            }

        }


        @media (max-width: 650px) {

            .stats {
                grid-template-columns: 1fr;
            }

            .welcome {
                flex-direction: column;

                align-items: flex-start;

                gap: 12px;
            }

            .welcome h1 {
                font-size: 19px;
            }

            .sales-grid {
                grid-template-columns: 1fr;
            }

            .management-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .lower-grid {
                grid-template-columns: 1fr;
            }

            .top-user {
                display: none;
            }

            .topbar {
                height: 62px;
            }

        }


        @media (max-width: 420px) {

            .content {
                padding: 17px 12px 30px;
            }

            .panel {
                padding: 14px;
            }

            .welcome {
                padding: 18px;
            }

            .stat-card {
                padding: 15px;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         SIDEBAR OVERLAY
    ========================================================= -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    <!-- =========================================================
         SIDEBAR
    ========================================================= -->

    <aside
        class="sidebar"
        id="sidebar"
    >


        <!-- BRAND -->

        <div class="brand">

            <div class="brand-logo">
                M
            </div>

            <div>

                <div class="brand-name">
                    MoujaMap
                </div>

                <span class="brand-subtitle">
                    Administration Panel
                </span>

            </div>

        </div>


        <!-- MAIN MENU -->

        <div class="menu-title">
            Main Menu
        </div>


        <nav class="nav">


            <a
                href="{{ route('admin.dashboard') }}"
                class="nav-link active"
            >

                <span class="nav-icon">
                    ▦
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            <a
                href="{{ route('admin.divisions.index') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    ◈
                </span>

                <span>
                    Divisions
                </span>

            </a>


            <a
                href="{{ route('admin.districts.index') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    ◇
                </span>

                <span>
                    Districts
                </span>

            </a>


            <a
                href="{{ route('admin.upazilas.index') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    ⌂
                </span>

                <span>
                    Upazilas
                </span>

            </a>


            <a
                href="{{ route('admin.mouzas.index') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    ▤
                </span>

                <span>
                    Mouzas
                </span>

            </a>


            <a
                href="{{ route('admin.maps.index') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    ▧
                </span>

                <span>
                    Maps / PDFs
                </span>

            </a>


            <a
                href="{{ route('admin.orders.index') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    🛒
                </span>

                <span>
                    Orders
                </span>

            </a>


        </nav>


        <!-- SYSTEM -->

        <div class="menu-title">
            System
        </div>


        <nav class="nav">

            <a
                href="{{ route('profile.edit') }}"
                class="nav-link"
            >

                <span class="nav-icon">
                    ⚙
                </span>

                <span>
                    Profile Settings
                </span>

            </a>

        </nav>


        <!-- SIDEBAR FOOTER -->

        <div class="sidebar-footer">


            <div class="admin-mini">

                <div class="admin-mini-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>


                <div class="admin-mini-info">

                    <strong>

                        {{ auth()->user()->name }}

                    </strong>

                    <span>

                        Administrator

                    </span>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout"
                >

                    ↪ &nbsp; Logout

                </button>

            </form>


        </div>


    </aside>



    <!-- =========================================================
         MAIN
    ========================================================= -->

    <main class="main">


        <!-- =====================================================
             TOPBAR
        ====================================================== -->

        <header class="topbar">


            <div class="topbar-left">


                <button
                    type="button"
                    class="mobile-menu"
                    id="mobileMenuBtn"
                    aria-label="Open navigation"
                >

                    ☰

                </button>


                <div class="breadcrumb">

                    Admin Panel

                    <span class="breadcrumb-separator">
                        /
                    </span>

                    <strong>
                        Dashboard
                    </strong>

                </div>


            </div>


            <!-- PROFILE -->

            <div class="top-profile">


                <div class="top-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>


                <div class="top-user">

                    <strong>

                        {{ auth()->user()->name }}

                    </strong>

                    <span>

                        Administrator

                    </span>

                </div>


            </div>


        </header>



        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <div class="content">


            <!-- =================================================
                 WELCOME
            ================================================== -->

            <section class="welcome">


                <div>

                    <h1>

                        Welcome back,
                        {{ auth()->user()->name }}
                        👋

                    </h1>


                    <p>

                        Here's what's happening with your MoujaMap platform today.

                    </p>

                </div>


                <div class="date-box">

                    {{ now()->format('l, d F Y') }}

                </div>


            </section>



            <!-- =================================================
                 OVERVIEW
            ================================================== -->

            <div class="section-header">

                <h2>
                    Overview
                </h2>

                <span>
                    Live platform statistics
                </span>

            </div>


            <section class="stats">


                <!-- TOTAL SALES -->

                <div class="stat-card">

                    <div class="stat-header">

                        <span class="stat-label">
                            Total Sales
                        </span>

                        <div class="stat-icon green">
                            ৳
                        </div>

                    </div>


                    <div class="stat-number">

                        ৳{{ number_format($totalSales, 2) }}

                    </div>


                    <div class="stat-note">

                        Completed order revenue

                    </div>

                </div>



                <!-- TOTAL ORDERS -->

                <div class="stat-card">

                    <div class="stat-header">

                        <span class="stat-label">
                            Total Orders
                        </span>

                        <div class="stat-icon">
                            🛒
                        </div>

                    </div>


                    <div class="stat-number">

                        {{ number_format($totalOrders) }}

                    </div>


                    <div class="stat-note">

                        All customer orders

                    </div>

                </div>



                <!-- PENDING -->

                <div class="stat-card">

                    <div class="stat-header">

                        <span class="stat-label">
                            Pending Orders
                        </span>

                        <div class="stat-icon orange">
                            ⏳
                        </div>

                    </div>


                    <div class="stat-number">

                        {{ number_format($pendingOrders) }}

                    </div>


                    <div class="stat-note">

                        Orders waiting for processing

                    </div>

                </div>



                <!-- MAPS -->

                <div class="stat-card">

                    <div class="stat-header">

                        <span class="stat-label">
                            Total Maps
                        </span>

                        <div class="stat-icon purple">
                            ▧
                        </div>

                    </div>


                    <div class="stat-number">

                        {{ number_format($totalMaps) }}

                    </div>


                    <div class="stat-note">

                        Maps / PDFs in inventory

                    </div>

                </div>


            </section>



            <!-- =================================================
                 SALES OVERVIEW
            ================================================== -->

            <section class="panel sales-panel">


                <div class="section-header">

                    <h2>
                        Sales Overview
                    </h2>

                    <span>
                        Completed orders only
                    </span>

                </div>


                <div class="sales-grid">


                    <!-- TODAY -->

                    <div class="sales-card">

                        <div class="sales-top">

                            <span>
                                Today
                            </span>

                            <span>
                                📅
                            </span>

                        </div>


                        <div class="sales-value">

                            ৳{{ number_format($todaySales, 2) }}

                        </div>


                        <div class="sales-orders">

                            <strong>
                                {{ number_format($todayOrders) }}
                            </strong>

                            completed orders

                        </div>

                    </div>



                    <!-- WEEK -->

                    <div class="sales-card">

                        <div class="sales-top">

                            <span>
                                This Week
                            </span>

                            <span>
                                📈
                            </span>

                        </div>


                        <div class="sales-value">

                            ৳{{ number_format($weekSales, 2) }}

                        </div>


                        <div class="sales-orders">

                            <strong>
                                {{ number_format($weekOrders) }}
                            </strong>

                            completed orders

                        </div>

                    </div>



                    <!-- MONTH -->

                    <div class="sales-card">

                        <div class="sales-top">

                            <span>
                                This Month
                            </span>

                            <span>
                                📊
                            </span>

                        </div>


                        <div class="sales-value">

                            ৳{{ number_format($monthSales, 2) }}

                        </div>


                        <div class="sales-orders">

                            <strong>
                                {{ number_format($monthOrders) }}
                            </strong>

                            completed orders

                        </div>

                    </div>


                </div>


            </section>



            <!-- =================================================
                 MANAGEMENT + QUICK ACTIONS
            ================================================== -->

            <section class="two-column">


                <!-- MANAGEMENT -->

                <div class="panel">


                    <div class="panel-title">

                        Administrative Management

                    </div>


                    <div class="management-grid">


                        <!-- DIVISIONS -->

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

                                        {{ number_format($totalDivisions) }}
                                        records

                                    </div>

                                </div>

                            </div>


                            <a
                                href="{{ route('admin.divisions.index') }}"
                                class="manage-link"
                            >
                                Manage →
                            </a>

                        </div>



                        <!-- DISTRICTS -->

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

                                        {{ number_format($totalDistricts) }}
                                        records

                                    </div>

                                </div>

                            </div>


                            <a
                                href="{{ route('admin.districts.index') }}"
                                class="manage-link"
                            >
                                Manage →
                            </a>

                        </div>



                        <!-- UPAZILAS -->

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

                                        {{ number_format($totalUpazilas) }}
                                        records

                                    </div>

                                </div>

                            </div>


                            <a
                                href="{{ route('admin.upazilas.index') }}"
                                class="manage-link"
                            >
                                Manage →
                            </a>

                        </div>



                        <!-- MOUZAS -->

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

                                        {{ number_format($totalMouzas) }}
                                        records

                                    </div>

                                </div>

                            </div>


                            <a
                                href="{{ route('admin.mouzas.index') }}"
                                class="manage-link"
                            >
                                Manage →
                            </a>

                        </div>



                        <!-- SURVEY -->

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

                                        {{ number_format($totalSurveyTypes) }}
                                        types

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- MAPS -->

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

                                        {{ number_format($totalMaps) }}
                                        maps

                                    </div>

                                </div>

                            </div>


                            <a
                                href="{{ route('admin.maps.index') }}"
                                class="manage-link"
                            >
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


                    <div class="quick-actions">


                        <a
                            href="{{ route('admin.divisions.create') }}"
                            class="action"
                        >

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



                        <a
                            href="{{ route('admin.districts.create') }}"
                            class="action"
                        >

                            <div class="action-icon">
                                +
                            </div>

                            <div class="action-text">

                                <strong>
                                    Add District
                                </strong>

                                <span>
                                    Register a new district
                                </span>

                            </div>

                        </a>



                        <a
                            href="{{ route('admin.upazilas.create') }}"
                            class="action"
                        >

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



                        <a
                            href="{{ route('admin.mouzas.create') }}"
                            class="action"
                        >

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



                        <a
                            href="{{ route('admin.maps.create') }}"
                            class="action"
                        >

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



                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="action"
                        >

                            <div class="action-icon">
                                🛒
                            </div>

                            <div class="action-text">

                                <strong>
                                    Manage Orders
                                </strong>

                                <span>
                                    View and process orders
                                </span>

                            </div>

                        </a>


                    </div>


                </div>


            </section>



            <!-- =================================================
                 RECENT ORDERS
            ================================================== -->

            <section class="panel orders-panel">


                <div class="section-header">

                    <h2>
                        Recent Orders
                    </h2>

                    <span>
                        Latest 10 customer purchases
                    </span>

                </div>


                <div class="table-wrapper">


                    <table class="orders-table">


                        <thead>

                            <tr>

                                <th>
                                    Order
                                </th>

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


                            @forelse($recentOrders as $order)


                                <tr>


                                    <td>

                                        <div class="order-id">

                                            #{{ $order->id }}

                                        </div>

                                    </td>


                                    <td>

                                        <div class="customer-name">

                                            {{ $order->customer_name }}

                                        </div>

                                        <div class="customer-phone">

                                            {{ $order->phone }}

                                        </div>

                                    </td>


                                    <td>

                                        <div class="map-title">

                                            {{ $order->map?->title ?? 'Map unavailable' }}

                                        </div>

                                    </td>


                                    <td>

                                        <span class="amount">

                                            ৳{{ number_format($order->amount, 2) }}

                                        </span>

                                    </td>


                                    <td>

                                        <span class="payment">

                                            {{ ucfirst($order->payment_method ?? 'N/A') }}

                                        </span>

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

                                        {{ $order->created_at?->format('d M Y') }}

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="7">

                                        <div class="empty-state">

                                            <div class="empty-icon">
                                                🛒
                                            </div>

                                            No orders found yet.

                                        </div>

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>


                    </table>


                </div>


            </section>



            <!-- =================================================
                 TOP MAPS + INVENTORY
            ================================================== -->

            <section class="lower-grid">


                <!-- TOP SELLING -->

                <div class="panel">


                    <div class="section-header">

                        <h2>
                            Top Selling Maps
                        </h2>

                        <span>
                            Completed orders
                        </span>

                    </div>


                    @forelse($topMaps as $index => $topMap)


                        <div class="top-map">


                            <div class="rank">

                                #{{ $index + 1 }}

                            </div>


                            <div class="map-info">

                                <strong>

                                    {{ $topMap->map?->title ?? 'Map unavailable' }}

                                </strong>

                                <span>

                                    {{ number_format($topMap->total_orders) }}

                                    {{ $topMap->total_orders == 1 ? 'order' : 'orders' }}

                                </span>

                            </div>


                            <div class="map-sales">

                                ৳{{ number_format($topMap->total_sales, 2) }}

                                <span>
                                    Total sales
                                </span>

                            </div>


                        </div>


                    @empty


                        <div class="empty-state">

                            <div class="empty-icon">
                                ▧
                            </div>

                            No completed map sales yet.

                        </div>


                    @endforelse


                </div>



                <!-- INVENTORY -->

                <div class="panel">


                    <div class="section-header">

                        <h2>
                            Map Inventory
                        </h2>

                        <span>
                            Current map status
                        </span>

                    </div>


                    <div class="inventory-grid">


                        <div class="inventory-card active">

                            <span>
                                Active Maps
                            </span>

                            <strong>

                                {{ number_format($activeMaps) }}

                            </strong>

                        </div>


                        <div class="inventory-card inactive">

                            <span>
                                Inactive Maps
                            </span>

                            <strong>

                                {{ number_format($inactiveMaps) }}

                            </strong>

                        </div>


                        <div class="inventory-card">

                            <span>
                                Free Maps
                            </span>

                            <strong>

                                {{ number_format($freeMaps) }}

                            </strong>

                        </div>


                        <div class="inventory-card">

                            <span>
                                Paid Maps
                            </span>

                            <strong>

                                {{ number_format($paidMaps) }}

                            </strong>

                        </div>


                    </div>



                    <!-- ORDER STATUS -->

                    <div class="subsection">


                        <div class="subsection-title">

                            Order Status

                        </div>


                        <div class="inventory-grid">


                            <div class="inventory-card">

                                <span>
                                    Completed
                                </span>

                                <strong style="color:var(--success);">

                                    {{ number_format($completedOrders) }}

                                </strong>

                            </div>


                            <div class="inventory-card">

                                <span>
                                    Cancelled
                                </span>

                                <strong style="color:var(--danger);">

                                    {{ number_format($cancelledOrders) }}

                                </strong>

                            </div>


                        </div>


                    </div>



                    <!-- DOWNLOAD -->

                    <div class="download-box">


                        <div class="download-label">

                            Total Downloads

                        </div>


                        <div class="download-value">

                            {{ number_format($totalDownloads) }}

                        </div>


                    </div>


                </div>


            </section>


        </div>


    </main>



    <!-- =========================================================
         MOBILE SIDEBAR SCRIPT
    ========================================================= -->

    <script>

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('sidebarOverlay');

        const menuButton =
            document.getElementById('mobileMenuBtn');


        function openSidebar() {

            sidebar.classList.add('open');

            overlay.classList.add('active');

            document.body.style.overflow = 'hidden';

        }


        function closeSidebar() {

            sidebar.classList.remove('open');

            overlay.classList.remove('active');

            document.body.style.overflow = '';

        }


        menuButton.addEventListener(
            'click',
            openSidebar
        );


        overlay.addEventListener(
            'click',
            closeSidebar
        );


        document
            .querySelectorAll('.sidebar a')
            .forEach(function(link) {

                link.addEventListener(
                    'click',
                    function() {

                        if (window.innerWidth <= 900) {

                            closeSidebar();

                        }

                    }
                );

            });


        window.addEventListener(
            'resize',
            function() {

                if (window.innerWidth > 900) {

                    closeSidebar();

                }

            }
        );

    </script>


</body>

</html>

