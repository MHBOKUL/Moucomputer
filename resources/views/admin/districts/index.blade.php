<x-app-layout>

<x-slot name="header">
    <div class="district-header">
        <div>
            <h2 class="page-title">
                Districts
            </h2>

            <p class="page-subtitle">
                Manage all districts and their divisions
            </p>
        </div>

        <a href="{{ route('admin.districts.create') }}"
           class="add-btn">
            <span>+</span>
            Add District
        </a>
    </div>
</x-slot>


<div class="district-page">

    <div class="district-container">


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="success-alert">
                <div class="success-icon">✓</div>

                <div>
                    <strong>Success</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>

        @endif


        {{-- PAGE INFO --}}
        <div class="page-info">

            <div>
                <h3>District List</h3>

                <p>
                    View and manage all registered districts.
                </p>
            </div>

            <div class="total-badge">
                {{ $districts->count() }}
                {{ $districts->count() == 1 ? 'District' : 'Districts' }}
            </div>

        </div>


        {{-- DESKTOP TABLE --}}
        <div class="district-card">

            <div class="table-wrapper">

                <table class="district-table">

                    <thead>

                        <tr>

                            <th class="number-column">
                                #
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                District
                            </th>

                            <th>
                                বাংলা নাম
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="actions-column">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($districts as $district)

                            <tr>

                                {{-- NUMBER --}}
                                <td class="number-cell">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- DIVISION --}}
                                <td>

                                    <div class="division-name">

                                        <span class="division-icon">
                                            ◈
                                        </span>

                                        <span>
                                            {{ $district->division->name ?? '—' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- DISTRICT --}}
                                <td>

                                    <div class="district-name">
                                        {{ $district->name }}
                                    </div>

                                </td>


                                {{-- BANGLA NAME --}}
                                <td>

                                    <div class="bangla-name">

                                        {{ $district->name_bn ?? '—' }}

                                    </div>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if ($district->is_active)

                                        <span class="status active">
                                            <span class="status-dot"></span>
                                            Active
                                        </span>

                                    @else

                                        <span class="status inactive">
                                            <span class="status-dot"></span>
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="action-buttons">

                                        <a href="{{ route('admin.districts.show', $district) }}"
                                           class="action view">
                                            View
                                        </a>

                                        <a href="{{ route('admin.districts.edit', $district) }}"
                                           class="action edit">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.districts.destroy', $district) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this district?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action delete">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="6">

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            ◇
                                        </div>

                                        <h3>
                                            No districts found
                                        </h3>

                                        <p>
                                            You haven't added any districts yet.
                                        </p>

                                        <a href="{{ route('admin.districts.create') }}"
                                           class="empty-btn">
                                            + Add First District
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


    </div>

</div>


<style>

    /* =========================================================
       DISTRICT PAGE
    ========================================================= */

    .district-page {
        background: #f6f8fc;
        min-height: calc(100vh - 65px);
        padding: 32px 24px 50px;
    }

    .district-container {
        max-width: 1500px;
        margin: 0 auto;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .district-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .page-title {
        font-size: 26px;
        line-height: 1.25;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        margin-top: 5px;
        font-size: 14px;
        color: #64748b;
    }


    /* =========================================================
       ADD BUTTON
    ========================================================= */

    .add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        padding: 11px 17px;

        background: #2563eb;
        color: #fff;

        border-radius: 9px;

        font-size: 14px;
        font-weight: 700;

        text-decoration: none;

        box-shadow: 0 5px 15px rgba(37, 99, 235, .18);

        transition: .2s ease;
    }

    .add-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .add-btn span {
        font-size: 20px;
        line-height: 1;
        font-weight: 400;
    }


    /* =========================================================
       SUCCESS ALERT
    ========================================================= */

    .success-alert {
        display: flex;
        align-items: center;
        gap: 13px;

        background: #f0fdf4;
        border: 1px solid #bbf7d0;

        color: #166534;

        padding: 15px 18px;

        border-radius: 10px;

        margin-bottom: 22px;
    }

    .success-icon {
        width: 35px;
        height: 35px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #dcfce7;

        font-size: 18px;
        font-weight: 800;
    }

    .success-alert strong {
        display: block;
        font-size: 14px;
    }

    .success-alert p {
        margin-top: 2px;
        font-size: 13px;
    }


    /* =========================================================
       PAGE INFO
    ========================================================= */

    .page-info {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 14px;
    }

    .page-info h3 {
        font-size: 19px;
        font-weight: 800;
        color: #172033;
    }

    .page-info p {
        margin-top: 3px;
        font-size: 13px;
        color: #64748b;
    }

    .total-badge {
        padding: 7px 12px;

        background: #eff6ff;
        color: #2563eb;

        border: 1px solid #dbeafe;

        border-radius: 8px;

        font-size: 13px;
        font-weight: 750;
    }


    /* =========================================================
       CARD
    ========================================================= */

    .district-card {
        background: #fff;

        border: 1px solid #e5e7eb;

        border-radius: 13px;

        overflow: hidden;

        box-shadow:
            0 1px 2px rgba(15, 23, 42, .03),
            0 6px 20px rgba(15, 23, 42, .04);
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .district-table {
        width: 100%;
        min-width: 850px;

        border-collapse: collapse;
    }

    .district-table thead {
        background: #f8fafc;
    }

    .district-table th {
        padding: 15px 18px;

        text-align: left;

        color: #64748b;

        font-size: 12px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .04em;

        border-bottom: 1px solid #e5e7eb;

        white-space: nowrap;
    }

    .district-table td {
        padding: 17px 18px;

        border-bottom: 1px solid #eef2f7;

        font-size: 14px;

        color: #334155;

        vertical-align: middle;
    }

    .district-table tbody tr {
        transition: background .15s ease;
    }

    .district-table tbody tr:hover {
        background: #f8fbff;
    }

    .district-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       NUMBER
    ========================================================= */

    .number-column {
        width: 70px;
    }

    .number-cell {
        color: #94a3b8 !important;
        font-size: 13px !important;
        font-weight: 700;
    }


    /* =========================================================
       DIVISION
    ========================================================= */

    .division-name {
        display: flex;
        align-items: center;
        gap: 9px;

        font-weight: 650;
        color: #334155;
    }

    .division-icon {
        width: 31px;
        height: 31px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #eff6ff;
        color: #2563eb;

        font-size: 14px;
    }


    /* =========================================================
       DISTRICT NAME
    ========================================================= */

    .district-name {
        font-size: 15px;
        font-weight: 750;
        color: #172033;
    }

    .bangla-name {
        font-size: 15px;
        color: #475569;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .status {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        padding: 6px 10px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 800;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .status.active {
        background: #dcfce7;
        color: #15803d;
    }

    .status.active .status-dot {
        background: #16a34a;
    }

    .status.inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status.inactive .status-dot {
        background: #dc2626;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .actions-column {
        text-align: right !important;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 7px;
    }

    .action-buttons form {
        margin: 0;
    }

    .action {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 7px 11px;

        border-radius: 7px;

        font-size: 12px;
        font-weight: 750;

        border: 1px solid transparent;

        cursor: pointer;

        transition: .2s ease;
    }

    .action.view {
        background: #f1f5f9;
        color: #475569;
        border-color: #e2e8f0;
    }

    .action.view:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .action.edit {
        background: #eff6ff;
        color: #2563eb;
        border-color: #dbeafe;
    }

    .action.edit:hover {
        background: #dbeafe;
    }

    .action.delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .action.delete:hover {
        background: #fee2e2;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        text-align: center;
        padding: 65px 20px;
    }

    .empty-icon {
        width: 55px;
        height: 55px;

        margin: 0 auto 13px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #eff6ff;
        color: #2563eb;

        border-radius: 12px;

        font-size: 24px;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 800;
        color: #172033;
    }

    .empty-state p {
        margin-top: 4px;
        font-size: 13px;
        color: #64748b;
    }

    .empty-btn {
        display: inline-flex;

        margin-top: 17px;

        padding: 10px 15px;

        background: #2563eb;
        color: #fff;

        border-radius: 8px;

        font-size: 13px;
        font-weight: 750;
    }


    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 900px) {

        .district-page {
            padding: 25px 18px 40px;
        }

        .page-title {
            font-size: 24px;
        }

        .district-table th {
            padding: 13px 15px;
            font-size: 11px;
        }

        .district-table td {
            padding: 15px;
            font-size: 14px;
        }

    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 640px) {

        .district-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 13px;
        }

        .page-title {
            font-size: 23px;
        }

        .page-subtitle {
            font-size: 13px;
        }

        .add-btn {
            width: 100%;
            padding: 12px;
            font-size: 14px;
        }

        .district-page {
            padding: 20px 12px 35px;
        }

        .success-alert {
            padding: 13px;
        }

        .page-info {
            align-items: flex-start;
            gap: 10px;
        }

        .page-info h3 {
            font-size: 17px;
        }

        .page-info p {
            font-size: 12px;
        }

        .total-badge {
            font-size: 11px;
            white-space: nowrap;
        }

        .district-card {
            border-radius: 10px;
        }

        /*
         * Horizontal scrolling is intentional on mobile.
         * This keeps every table column readable instead
         * of crushing the content into tiny text.
         */

        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .district-table {
            min-width: 780px;
        }

        .district-table th {
            padding: 12px 13px;
            font-size: 10px;
        }

        .district-table td {
            padding: 14px 13px;
            font-size: 13px;
        }

        .district-name,
        .bangla-name {
            font-size: 14px;
        }

        .action {
            padding: 7px 10px;
            font-size: 11px;
        }

    }


    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 400px) {

        .district-page {
            padding-left: 10px;
            padding-right: 10px;
        }

        .page-title {
            font-size: 21px;
        }

        .page-info {
            flex-direction: column;
        }

        .total-badge {
            align-self: flex-start;
        }

    }

</style>


</x-app-layout>
