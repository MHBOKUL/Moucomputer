
<x-app-layout>

    {{-- =========================================================
        Khatian Management - MoujaMap
        DLRMS Inspired Admin Design
    ========================================================== --}}

    <x-slot name="header">

        <div class="khatian-header">

            <div>
                <div class="breadcrumb">
                    <span>Admin Panel</span>
                    <span class="separator">/</span>
                    <strong>Khatian Management</strong>
                </div>

                <h1 class="page-title">
                    Khatian Management
                </h1>

                <p class="page-subtitle">
                    Manage digital khatian records and PDF documents
                </p>
            </div>

            <a href="{{ route('admin.khatians.create') }}"
               class="btn-primary">
                <span class="btn-icon">＋</span>
                Add Khatian
            </a>

        </div>

    </x-slot>


    {{-- =========================================================
        PAGE
    ========================================================== --}}

    <div class="khatian-page">

        <div class="khatian-container">


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================== --}}

            @if (session('success'))

                <div class="alert-success">

                    <div class="alert-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Success</strong>
                        <p>{{ session('success') }}</p>
                    </div>

                </div>

            @endif


            {{-- =================================================
                STATISTICS
            ================================================== --}}

            <div class="stats-grid">

                <div class="stat-card">

                    <div class="stat-icon green">
                        <span>▤</span>
                    </div>

                    <div>
                        <p>Total Khatians</p>
                        <h2>{{ $khatians->total() }}</h2>
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon blue">
                        <span>✓</span>
                    </div>

                    <div>
                        <p>Active</p>
                        <h2>
                            {{ $khatians->where('is_active', true)->count() }}
                        </h2>
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon orange">
                        <span>৳</span>
                    </div>

                    <div>
                        <p>Paid Khatians</p>
                        <h2>
                            {{ $khatians->where('price', '>', 0)->count() }}
                        </h2>
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon purple">
                        <span>PDF</span>
                    </div>

                    <div>
                        <p>PDF Documents</p>
                        <h2>
                            {{ $khatians->whereNotNull('pdf_path')->count() }}
                        </h2>
                    </div>

                </div>

            </div>


            {{-- =================================================
                SEARCH / FILTER
            ================================================== --}}

            <div class="filter-card">

                <div class="filter-heading">

                    <div class="filter-title">
                        <span class="filter-symbol">⌕</span>

                        <div>
                            <h3>Search Khatian</h3>
                            <p>Find a khatian by number, owner or location</p>
                        </div>
                    </div>

                </div>


                <form method="GET"
                      action="{{ route('admin.khatians.index') }}"
                      class="search-form">

                    <div class="search-box">

                        <span class="search-icon">
                            ⌕
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search Khatian Number or Owner Name..."
                        >

                    </div>


                    <select name="survey_type_id"
                            class="filter-select">

                        <option value="">
                            All Survey Types
                        </option>

                        @foreach ($surveyTypes ?? [] as $surveyType)

                            <option value="{{ $surveyType->id }}"
                                {{ request('survey_type_id') == $surveyType->id ? 'selected' : '' }}>

                                {{ $surveyType->name }}

                            </option>

                        @endforeach

                    </select>


                    <select name="status"
                            class="filter-select">

                        <option value="">
                            All Status
                        </option>

                        <option value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>


                    <button type="submit"
                            class="search-button">

                        Search

                    </button>


                    @if(request()->hasAny(['search', 'survey_type_id', 'status']))

                        <a href="{{ route('admin.khatians.index') }}"
                           class="reset-button">

                            Reset

                        </a>

                    @endif

                </form>

            </div>


            {{-- =================================================
                KHATIAN TABLE
            ================================================== --}}

            <div class="table-card">

                <div class="table-header">

                    <div>

                        <h3>
                            Khatian Records
                        </h3>

                        <p>
                            Digital land record documents
                        </p>

                    </div>

                    <div class="record-count">

                        {{ $khatians->total() }} Records

                    </div>

                </div>


                <div class="table-wrapper">

                    <table class="khatian-table">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Khatian</th>

                                <th>Location</th>

                                <th>Survey</th>

                                <th>Owner</th>

                                <th>Price</th>

                                <th>Status</th>

                                <th>PDF</th>

                                <th class="action-column">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($khatians as $khatian)

                                <tr>

                                    {{-- Number --}}
                                    <td class="serial">

                                        {{ $khatians->firstItem() + $loop->index }}

                                    </td>


                                    {{-- Khatian --}}
                                    <td>

                                        <div class="khatian-number">

                                            <span class="document-icon">
                                                ▤
                                            </span>

                                            <div>

                                                <strong>
                                                    {{ $khatian->khatian_number }}
                                                </strong>

                                                <small>
                                                    ID #{{ $khatian->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Location --}}
                                    <td>

                                        <div class="location">

                                            <strong>
                                                {{ $khatian->mouza->name ?? '—' }}
                                            </strong>

                                            <small>
                                                {{ $khatian->mouza->upazila->name ?? '—' }}
                                            </small>

                                        </div>

                                    </td>


                                    {{-- Survey --}}
                                    <td>

                                        <span class="survey-badge">

                                            {{ $khatian->surveyType->name ?? '—' }}

                                        </span>

                                    </td>


                                    {{-- Owner --}}
                                    <td>

                                        <span class="owner-name">

                                            {{ $khatian->owner_name ?? 'Not specified' }}

                                        </span>

                                    </td>


                                    {{-- Price --}}
                                    <td>

                                        @if($khatian->price > 0)

                                            <span class="price-paid">

                                                ৳{{ number_format($khatian->price, 2) }}

                                            </span>

                                        @else

                                            <span class="price-free">
                                                FREE
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($khatian->is_active)

                                            <span class="status active">
                                                <span></span>
                                                Active
                                            </span>

                                        @else

                                            <span class="status inactive">
                                                <span></span>
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- PDF --}}
                                    <td>

                                        @if($khatian->pdf_path)

                                            <a href="{{ asset('storage/' . $khatian->pdf_path) }}"
                                               target="_blank"
                                               class="pdf-button">

                                                <span>PDF</span>
                                                View

                                            </a>

                                        @else

                                            <span class="no-pdf">
                                                No PDF
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="actions">

                                            <a href="{{ route('admin.khatians.show', $khatian) }}"
                                               class="action view"
                                               title="View">

                                                👁

                                            </a>


                                            <a href="{{ route('admin.khatians.edit', $khatian) }}"
                                               class="action edit"
                                               title="Edit">

                                                ✎

                                            </a>


                                            <form
                                                method="POST"
                                                action="{{ route('admin.khatians.destroy', $khatian) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this khatian?');">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action delete"
                                                    title="Delete">

                                                    🗑

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="9">

                                        <div class="empty-state">

                                            <div class="empty-icon">
                                                ▤
                                            </div>

                                            <h3>
                                                No Khatian Found
                                            </h3>

                                            <p>
                                                No khatian records match your search.
                                            </p>

                                            <a href="{{ route('admin.khatians.create') }}"
                                               class="btn-primary">

                                                ＋ Add First Khatian

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                    PAGINATION
                ================================================== --}}

                @if($khatians->hasPages())

                    <div class="pagination-area">

                        {{ $khatians->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>

        * {
            box-sizing: border-box;
        }


        body {
            font-family:
                Inter,
                "Noto Sans Bengali",
                Arial,
                sans-serif;
            background: #f4f7f6;
        }


        /* HEADER */

        .khatian-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }


        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 8px;
        }


        .breadcrumb strong {
            color: #166534;
        }


        .separator {
            color: #9ca3af;
        }


        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            color: #17211b;
            letter-spacing: -0.5px;
        }


        .page-subtitle {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }


        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 12px 18px;

            background: linear-gradient(
                135deg,
                #166534,
                #15803d
            );

            color: white;

            border-radius: 9px;

            font-size: 14px;
            font-weight: 700;

            text-decoration: none;

            border: none;

            box-shadow:
                0 4px 12px rgba(22, 101, 52, .18);

            transition: all .2s ease;
        }


        .btn-primary:hover {
            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(22, 101, 52, .25);
        }


        .btn-icon {
            font-size: 19px;
            line-height: 1;
        }


        /* PAGE */

        .khatian-page {
            padding: 30px 20px 60px;
        }


        .khatian-container {
            width: 100%;
            max-width: 1440px;
            margin: auto;
        }


        /* ALERT */

        .alert-success {
            display: flex;
            align-items: flex-start;
            gap: 13px;

            background: #ecfdf3;
            border: 1px solid #bbf7d0;

            padding: 15px 18px;

            border-radius: 10px;

            margin-bottom: 24px;

            color: #166534;
        }


        .alert-icon {
            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #16a34a;
            color: white;

            font-weight: 800;
        }


        .alert-success strong {
            font-size: 14px;
        }


        .alert-success p {
            margin: 2px 0 0;
            font-size: 13px;
        }


        /* STATS */

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 18px;

            margin-bottom: 22px;
        }


        .stat-card {
            background: white;

            border: 1px solid #e5ebe7;

            border-radius: 12px;

            padding: 20px;

            display: flex;
            align-items: center;
            gap: 15px;

            box-shadow:
                0 2px 7px rgba(0,0,0,.035);
        }


        .stat-icon {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            font-size: 18px;
            font-weight: 800;
        }


        .stat-icon.green {
            background: #dcfce7;
            color: #15803d;
        }


        .stat-icon.blue {
            background: #dbeafe;
            color: #1d4ed8;
        }


        .stat-icon.orange {
            background: #ffedd5;
            color: #c2410c;
        }


        .stat-icon.purple {
            background: #f3e8ff;
            color: #7e22ce;
            font-size: 11px;
        }


        .stat-card p {
            margin: 0 0 4px;
            color: #6b7280;
            font-size: 13px;
        }


        .stat-card h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 800;
            color: #17211b;
        }


        /* FILTER */

        .filter-card {
            background: white;

            border: 1px solid #e5ebe7;

            border-radius: 12px;

            padding: 22px;

            margin-bottom: 22px;

            box-shadow:
                0 2px 7px rgba(0,0,0,.035);
        }


        .filter-heading {
            margin-bottom: 17px;
        }


        .filter-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }


        .filter-symbol {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #ecfdf3;
            color: #15803d;

            font-size: 22px;
        }


        .filter-title h3 {
            margin: 0;

            font-size: 16px;
            font-weight: 800;

            color: #17211b;
        }


        .filter-title p {
            margin: 3px 0 0;

            font-size: 12px;
            color: #6b7280;
        }


        .search-form {
            display: grid;

            grid-template-columns:
                minmax(250px, 1fr)
                210px
                170px
                auto
                auto;

            gap: 10px;
        }


        .search-box {
            position: relative;
        }


        .search-icon {
            position: absolute;

            left: 13px;
            top: 50%;

            transform: translateY(-50%);

            color: #9ca3af;
            font-size: 20px;
        }


        .search-box input,
        .filter-select {
            width: 100%;

            height: 45px;

            border: 1px solid #d6dfda;

            border-radius: 8px;

            background: #fff;

            padding: 0 13px;

            color: #17211b;

            font-size: 13px;

            outline: none;

            transition: .2s;
        }


        .search-box input {
            padding-left: 40px;
        }


        .search-box input:focus,
        .filter-select:focus {
            border-color: #15803d;

            box-shadow:
                0 0 0 3px rgba(21,128,61,.09);
        }


        .search-button {
            height: 45px;

            border: none;

            border-radius: 8px;

            padding: 0 21px;

            background: #166534;

            color: white;

            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }


        .search-button:hover {
            background: #14532d;
        }


        .reset-button {
            height: 45px;

            padding: 0 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #f3f4f6;

            color: #374151;

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;
        }


        /* TABLE */

        .table-card {
            background: white;

            border: 1px solid #e5ebe7;

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 2px 7px rgba(0,0,0,.035);
        }


        .table-header {
            padding: 20px 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom: 1px solid #e8eeea;
        }


        .table-header h3 {
            margin: 0;

            font-size: 17px;
            font-weight: 800;

            color: #17211b;
        }


        .table-header p {
            margin: 4px 0 0;

            font-size: 12px;
            color: #6b7280;
        }


        .record-count {
            padding: 7px 11px;

            border-radius: 20px;

            background: #ecfdf3;

            color: #166534;

            font-size: 12px;
            font-weight: 700;
        }


        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }


        .khatian-table {
            width: 100%;
            min-width: 1100px;

            border-collapse: collapse;
        }


        .khatian-table th {
            padding: 13px 15px;

            text-align: left;

            background: #f7faf8;

            color: #64706a;

            font-size: 11px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .5px;

            border-bottom: 1px solid #e2e9e4;
        }


        .khatian-table td {
            padding: 15px;

            border-bottom: 1px solid #edf1ee;

            color: #374151;

            font-size: 13px;

            vertical-align: middle;
        }


        .khatian-table tbody tr {
            transition: background .15s ease;
        }


        .khatian-table tbody tr:hover {
            background: #f8fbf9;
        }


        .serial {
            color: #9ca3af !important;
            font-weight: 700;
        }


        /* KHATIAN */

        .khatian-number {
            display: flex;
            align-items: center;
            gap: 10px;
        }


        .document-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #ecfdf3;

            color: #15803d;

            font-size: 18px;
        }


        .khatian-number strong {
            display: block;

            color: #17211b;

            font-size: 14px;
        }


        .khatian-number small {
            display: block;

            margin-top: 2px;

            color: #9ca3af;

            font-size: 10px;
        }


        /* LOCATION */

        .location strong {
            display: block;

            color: #374151;

            font-size: 13px;
        }


        .location small {
            display: block;

            color: #9ca3af;

            margin-top: 3px;

            font-size: 11px;
        }


        /* SURVEY */

        .survey-badge {
            display: inline-block;

            padding: 5px 9px;

            border-radius: 6px;

            background: #eef2ff;

            color: #4338ca;

            font-size: 11px;

            font-weight: 700;
        }


        /* OWNER */

        .owner-name {
            color: #374151;

            font-size: 13px;
        }


        /* PRICE */

        .price-paid {
            font-weight: 800;
            color: #166534;
        }


        .price-free {
            display: inline-block;

            padding: 4px 8px;

            border-radius: 5px;

            background: #f0fdf4;

            color: #15803d;

            font-size: 10px;

            font-weight: 800;
        }


        /* STATUS */

        .status {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            font-size: 11px;

            font-weight: 700;
        }


        .status span {
            width: 7px;
            height: 7px;

            border-radius: 50%;
        }


        .status.active {
            color: #15803d;
        }


        .status.active span {
            background: #22c55e;
        }


        .status.inactive {
            color: #dc2626;
        }


        .status.inactive span {
            background: #ef4444;
        }


        /* PDF */

        .pdf-button {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 9px;

            border-radius: 6px;

            background: #fff1f2;

            color: #be123c;

            text-decoration: none;

            font-size: 11px;

            font-weight: 700;
        }


        .pdf-button:hover {
            background: #ffe4e6;
        }


        .pdf-button span {
            font-size: 9px;

            padding: 2px 4px;

            border-radius: 3px;

            background: #be123c;

            color: white;
        }


        .no-pdf {
            color: #9ca3af;
            font-size: 11px;
        }


        /* ACTIONS */

        .actions {
            display: flex;

            align-items: center;

            gap: 6px;
        }


        .actions form {
            display: inline;
            margin: 0;
        }


        .action {
            width: 32px;
            height: 32px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 7px;

            border: 1px solid transparent;

            text-decoration: none;

            cursor: pointer;

            font-size: 14px;

            transition: .15s;
        }


        .action.view {
            background: #eff6ff;
            color: #2563eb;
        }


        .action.edit {
            background: #fffbeb;
            color: #d97706;
        }


        .action.delete {
            background: #fff1f2;
            color: #dc2626;
        }


        .action:hover {
            transform: translateY(-1px);
            filter: brightness(.96);
        }


        /* EMPTY */

        .empty-state {
            padding: 65px 20px;

            text-align: center;
        }


        .empty-icon {
            width: 65px;
            height: 65px;

            margin: auto;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: #f0fdf4;

            color: #15803d;

            font-size: 28px;
        }


        .empty-state h3 {
            margin: 17px 0 5px;

            color: #17211b;

            font-size: 18px;
        }


        .empty-state p {
            margin: 0 0 18px;

            color: #6b7280;

            font-size: 13px;
        }


        /* PAGINATION */

        .pagination-area {
            padding: 17px 22px;

            border-top: 1px solid #edf1ee;
        }


        /* ======================================================
           TABLET
        ====================================================== */

        @media (max-width: 1000px) {

            .stats-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .search-form {
                grid-template-columns:
                    1fr 1fr;
            }


            .search-box {
                grid-column: 1 / -1;
            }

        }


        /* ======================================================
           MOBILE
        ====================================================== */

        @media (max-width: 640px) {

            .khatian-header {
                align-items: flex-start;

                flex-direction: column;
            }


            .page-title {
                font-size: 23px;
            }


            .page-subtitle {
                font-size: 12px;
            }


            .khatian-header .btn-primary {
                width: 100%;
            }


            .khatian-page {
                padding: 18px 12px 40px;
            }


            .stats-grid {
                grid-template-columns: 1fr 1fr;

                gap: 10px;
            }


            .stat-card {
                padding: 14px 11px;

                gap: 9px;
            }


            .stat-icon {
                width: 38px;
                height: 38px;

                font-size: 14px;
            }


            .stat-card p {
                font-size: 10px;
            }


            .stat-card h2 {
                font-size: 20px;
            }


            .filter-card {
                padding: 15px;
            }


            .search-form {
                grid-template-columns: 1fr;
            }


            .search-box {
                grid-column: auto;
            }


            .search-button,
            .reset-button {
                width: 100%;
            }


            .table-header {
                padding: 16px;

                align-items: flex-start;

                gap: 10px;

                flex-direction: column;
            }


            .table-wrapper {
                overflow-x: visible;
            }


            .khatian-table {
                min-width: 0;
            }


            .khatian-table thead {
                display: none;
            }


            .khatian-table,
            .khatian-table tbody,
            .khatian-table tr,
            .khatian-table td {
                display: block;
                width: 100%;
            }


            .khatian-table tr {
                padding: 16px;

                border-bottom: 1px solid #e5ebe7;
            }


            .khatian-table td {
                display: flex;

                align-items: center;

                justify-content: space-between;

                gap: 15px;

                padding: 8px 0;

                border: none;

                text-align: right;
            }


            .khatian-table td::before {
                content: attr(data-label);

                color: #6b7280;

                font-size: 11px;

                font-weight: 700;
            }


            .khatian-table td.serial {
                display: none;
            }


            .khatian-table td:nth-child(2)::before {
                content: "Khatian";
            }


            .khatian-table td:nth-child(3)::before {
                content: "Location";
            }


            .khatian-table td:nth-child(4)::before {
                content: "Survey";
            }


            .khatian-table td:nth-child(5)::before {
                content: "Owner";
            }


            .khatian-table td:nth-child(6)::before {
                content: "Price";
            }


            .khatian-table td:nth-child(7)::before {
                content: "Status";
            }


            .khatian-table td:nth-child(8)::before {
                content: "Document";
            }


            .khatian-table td:nth-child(9)::before {
                content: "Actions";
            }


            .khatian-number,
            .location,
            .actions {
                margin-left: auto;
            }


            .empty-state {
                padding: 45px 15px;
            }

        }

    </style>


</x-app-layout>

