<x-app-layout>

<x-slot name="header">

    <div class="district-header">

        <div>
            <h2 class="page-title">
                District Details
            </h2>

            <p class="page-subtitle">
                View complete information about this district
            </p>
        </div>

        <a href="{{ route('admin.districts.index') }}"
           class="back-btn">
            ← Back to Districts
        </a>

    </div>

</x-slot>


<div class="details-page">

    <div class="details-container">


        {{-- =====================================================
             MAIN CARD
        ====================================================== --}}

        <div class="details-card">


            {{-- CARD HEADER --}}

            <div class="details-card-header">

                <div class="district-avatar">
                    ◇
                </div>

                <div class="district-heading">

                    <h1>
                        {{ $district->name }}
                    </h1>

                    <p>
                        {{ $district->name_bn ?? 'বাংলা নাম নেই' }}
                    </p>

                </div>


                {{-- STATUS --}}

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

            </div>


            {{-- =================================================
                 INFORMATION GRID
            ================================================== --}}

            <div class="information-grid">


                {{-- DIVISION --}}

                <div class="information-box">

                    <div class="information-icon division-icon">
                        ◈
                    </div>

                    <div class="information-content">

                        <span class="information-label">
                            Division
                        </span>

                        <strong>

                            {{ $district->division->name ?? '—' }}

                        </strong>

                        @if ($district->division?->name_bn)

                            <small>
                                {{ $district->division->name_bn }}
                            </small>

                        @endif

                    </div>

                </div>


                {{-- DISTRICT NAME --}}

                <div class="information-box">

                    <div class="information-icon district-icon">
                        ◇
                    </div>

                    <div class="information-content">

                        <span class="information-label">
                            District Name
                        </span>

                        <strong>
                            {{ $district->name }}
                        </strong>

                    </div>

                </div>


                {{-- BANGLA NAME --}}

                <div class="information-box">

                    <div class="information-icon bangla-icon">
                        ব
                    </div>

                    <div class="information-content">

                        <span class="information-label">
                            বাংলা নাম
                        </span>

                        <strong>
                            {{ $district->name_bn ?? '—' }}
                        </strong>

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="information-box">

                    <div class="information-icon status-icon">
                        ✓
                    </div>

                    <div class="information-content">

                        <span class="information-label">
                            Current Status
                        </span>

                        @if ($district->is_active)

                            <strong class="status-text-active">
                                Active
                            </strong>

                            <small>
                                This district is currently available
                            </small>

                        @else

                            <strong class="status-text-inactive">
                                Inactive
                            </strong>

                            <small>
                                This district is currently disabled
                            </small>

                        @endif

                    </div>

                </div>


            </div>


            {{-- =================================================
                 RECORD INFORMATION
            ================================================== --}}

            <div class="record-section">

                <div class="section-title">
                    Record Information
                </div>


                <div class="record-grid">


                    <div class="record-item">

                        <span>
                            District ID
                        </span>

                        <strong>
                            #{{ $district->id }}
                        </strong>

                    </div>


                    <div class="record-item">

                        <span>
                            Created
                        </span>

                        <strong>
                            {{ $district->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </strong>

                    </div>


                    <div class="record-item">

                        <span>
                            Last Updated
                        </span>

                        <strong>
                            {{ $district->updated_at?->format('d M Y, h:i A') ?? '—' }}
                        </strong>

                    </div>


                </div>

            </div>


            {{-- =================================================
                 ACTIONS
            ================================================== --}}

            <div class="details-actions">

                <a href="{{ route('admin.districts.index') }}"
                   class="secondary-btn">
                    ← Back
                </a>

                <a href="{{ route('admin.districts.edit', $district) }}"
                   class="primary-btn">
                    ✎ Edit District
                </a>

            </div>


        </div>

    </div>

</div>


<style>

    /* =========================================================
       PAGE
    ========================================================= */

    .details-page {
        min-height: calc(100vh - 65px);

        background: #f6f8fc;

        padding: 32px 24px 50px;
    }

    .details-container {
        max-width: 1050px;
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

        letter-spacing: -.5px;
    }

    .page-subtitle {
        margin-top: 5px;

        font-size: 14px;

        color: #64748b;
    }


    /* =========================================================
       BACK BUTTON
    ========================================================= */

    .back-btn {
        display: inline-flex;
        align-items: center;

        padding: 10px 15px;

        border: 1px solid #e2e8f0;

        border-radius: 8px;

        background: #fff;

        color: #475569;

        font-size: 13px;
        font-weight: 700;

        transition: .2s ease;
    }

    .back-btn:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }


    /* =========================================================
       MAIN CARD
    ========================================================= */

    .details-card {
        background: #fff;

        border: 1px solid #e5e7eb;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 1px 2px rgba(15,23,42,.03),
            0 8px 25px rgba(15,23,42,.05);
    }


    /* =========================================================
       CARD HEADER
    ========================================================= */

    .details-card-header {
        display: flex;
        align-items: center;

        gap: 15px;

        padding: 25px;

        border-bottom: 1px solid #eef2f7;

        background:
            linear-gradient(
                135deg,
                #ffffff,
                #f8fbff
            );
    }

    .district-avatar {
        width: 52px;
        height: 52px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: #eff6ff;

        color: #2563eb;

        font-size: 24px;
        font-weight: 800;

        border: 1px solid #dbeafe;
    }

    .district-heading {
        flex: 1;
        min-width: 0;
    }

    .district-heading h1 {
        font-size: 21px;

        font-weight: 800;

        color: #172033;
    }

    .district-heading p {
        margin-top: 3px;

        font-size: 15px;

        color: #64748b;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .status {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        padding: 7px 12px;

        border-radius: 20px;

        font-size: 12px;

        font-weight: 800;

        white-space: nowrap;
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
       INFORMATION GRID
    ========================================================= */

    .information-grid {
        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 14px;

        padding: 24px;
    }

    .information-box {
        display: flex;
        align-items: center;

        gap: 13px;

        min-height: 105px;

        padding: 17px;

        border: 1px solid #e5e7eb;

        border-radius: 10px;

        background: #fff;

        transition: .2s ease;
    }

    .information-box:hover {
        background: #f8fbff;

        border-color: #bfdbfe;

        transform: translateY(-1px);
    }


    /* =========================================================
       INFORMATION ICON
    ========================================================= */

    .information-icon {
        width: 42px;
        height: 42px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        font-size: 18px;
        font-weight: 800;
    }

    .division-icon {
        background: #eff6ff;
        color: #2563eb;
    }

    .district-icon {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .bangla-icon {
        background: #ecfdf5;
        color: #059669;

        font-size: 17px;
    }

    .status-icon {
        background: #fff7ed;
        color: #ea580c;
    }


    /* =========================================================
       INFORMATION TEXT
    ========================================================= */

    .information-content {
        min-width: 0;
    }

    .information-label {
        display: block;

        color: #64748b;

        font-size: 12px;

        font-weight: 700;

        margin-bottom: 4px;
    }

    .information-content strong {
        display: block;

        color: #172033;

        font-size: 16px;

        font-weight: 800;

        overflow-wrap: anywhere;
    }

    .information-content small {
        display: block;

        margin-top: 3px;

        color: #94a3b8;

        font-size: 12px;
    }

    .status-text-active {
        color: #15803d !important;
    }

    .status-text-inactive {
        color: #dc2626 !important;
    }


    /* =========================================================
       RECORD SECTION
    ========================================================= */

    .record-section {
        margin: 0 24px;

        padding: 20px 0;

        border-top: 1px solid #eef2f7;
    }

    .section-title {
        margin-bottom: 13px;

        color: #172033;

        font-size: 15px;

        font-weight: 800;
    }

    .record-grid {
        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 10px;
    }

    .record-item {
        padding: 13px;

        background: #f8fafc;

        border: 1px solid #eef2f7;

        border-radius: 8px;
    }

    .record-item span {
        display: block;

        color: #64748b;

        font-size: 11px;

        font-weight: 650;
    }

    .record-item strong {
        display: block;

        margin-top: 4px;

        color: #334155;

        font-size: 13px;

        font-weight: 750;

        overflow-wrap: anywhere;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .details-actions {
        display: flex;

        align-items: center;
        justify-content: flex-end;

        gap: 9px;

        padding: 18px 24px;

        border-top: 1px solid #eef2f7;

        background: #fafbfc;
    }

    .secondary-btn,
    .primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 10px 15px;

        border-radius: 8px;

        font-size: 13px;

        font-weight: 750;

        transition: .2s ease;
    }

    .secondary-btn {
        background: #fff;

        color: #475569;

        border: 1px solid #dbe1e8;
    }

    .secondary-btn:hover {
        background: #f1f5f9;
    }

    .primary-btn {
        background: #2563eb;

        color: #fff;

        box-shadow:
            0 4px 12px rgba(37,99,235,.18);
    }

    .primary-btn:hover {
        background: #1d4ed8;

        transform: translateY(-1px);
    }


    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 800px) {

        .details-page {
            padding: 25px 18px 40px;
        }

        .information-grid {
            grid-template-columns: 1fr;
        }

        .record-grid {
            grid-template-columns: 1fr;
        }

    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 600px) {

        .district-header {
            align-items: flex-start;

            flex-direction: column;

            gap: 12px;
        }

        .page-title {
            font-size: 23px;
        }

        .page-subtitle {
            font-size: 13px;
        }

        .back-btn {
            width: 100%;
            justify-content: center;
        }

        .details-page {
            padding: 20px 12px 35px;
        }

        .details-card {
            border-radius: 11px;
        }

        .details-card-header {
            align-items: flex-start;

            padding: 18px;

            flex-wrap: wrap;
        }

        .district-avatar {
            width: 45px;
            height: 45px;

            font-size: 20px;
        }

        .district-heading h1 {
            font-size: 18px;
        }

        .district-heading p {
            font-size: 14px;
        }

        .details-card-header .status {
            width: 100%;

            justify-content: center;

            margin-top: 4px;
        }

        .information-grid {
            padding: 15px;

            gap: 10px;
        }

        .information-box {
            min-height: 90px;

            padding: 14px;
        }

        .information-content strong {
            font-size: 15px;
        }

        .record-section {
            margin: 0 15px;
        }

        .details-actions {
            padding: 14px 15px;

            flex-direction: column-reverse;
        }

        .secondary-btn,
        .primary-btn {
            width: 100%;
        }

    }


    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 380px) {

        .details-page {
            padding-left: 9px;
            padding-right: 9px;
        }

        .details-card-header {
            padding: 15px;
        }

        .information-grid {
            padding: 12px;
        }

        .information-box {
            gap: 10px;
        }

        .information-icon {
            width: 38px;
            height: 38px;
        }

    }

</style>

</x-app-layout>
