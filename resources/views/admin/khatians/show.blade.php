<x-app-layout>

    {{-- ============================================================
         HEADER
    ============================================================ --}}
    <x-slot name="header">

        <div class="khatian-header">

            <div>
                <div class="breadcrumb">
                    Admin Panel
                    <span>›</span>
                    Khatian Management
                    <span>›</span>
                    Details
                </div>

                <h2 class="page-title">
                    Khatian Details
                </h2>

                <p class="page-subtitle">
                    View complete information about this khatian
                </p>
            </div>

            <a href="{{ route('admin.khatians.index') }}"
               class="header-back-btn">
                ← Back to Khatian
            </a>

        </div>

    </x-slot>


    {{-- ============================================================
         MAIN CONTENT
    ============================================================ --}}
    <div class="khatian-page">

        <div class="khatian-container">


            {{-- ====================================================
                 TOP TITLE CARD
            ===================================================== --}}
            <div class="title-card">

                <div class="title-icon">
                    ▤
                </div>

                <div class="title-content">

                    <span class="title-label">
                        KHATIAN RECORD
                    </span>

                    <h1>
                        Khatian No.
                        {{ $khatian->khatian_number }}
                    </h1>

                    <p>
                        Digital Land Record Information
                    </p>

                </div>

                <div class="title-status">

                    @if ($khatian->is_active)

                        <span class="status active">
                            ● Active
                        </span>

                    @else

                        <span class="status inactive">
                            ● Inactive
                        </span>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                 INFORMATION GRID
            ===================================================== --}}
            <div class="section-card">

                <div class="section-heading">

                    <div class="section-icon">
                        ◈
                    </div>

                    <div>
                        <h3>
                            Khatian Information
                        </h3>

                        <p>
                            Basic information of this land record
                        </p>
                    </div>

                </div>


                <div class="information-grid">


                    {{-- Khatian Number --}}
                    <div class="info-box highlight">

                        <span class="info-label">
                            Khatian Number
                        </span>

                        <span class="info-value large">
                            {{ $khatian->khatian_number }}
                        </span>

                    </div>


                    {{-- Mouza --}}
                    <div class="info-box">

                        <span class="info-label">
                            Mouza
                        </span>

                        <span class="info-value">

                            {{ $khatian->mouza->name ?? '—' }}

                            @if ($khatian->mouza?->name_bn)
                                <small>
                                    {{ $khatian->mouza->name_bn }}
                                </small>
                            @endif

                        </span>

                    </div>


                    {{-- Upazila --}}
                    <div class="info-box">

                        <span class="info-label">
                            Upazila / Thana
                        </span>

                        <span class="info-value">

                            {{ $khatian->mouza->upazila->name ?? '—' }}

                        </span>

                    </div>


                    {{-- District --}}
                    <div class="info-box">

                        <span class="info-label">
                            District
                        </span>

                        <span class="info-value">

                            {{ $khatian->mouza->upazila->district->name ?? '—' }}

                        </span>

                    </div>


                    {{-- Division --}}
                    <div class="info-box">

                        <span class="info-label">
                            Division
                        </span>

                        <span class="info-value">

                            {{ $khatian->mouza->upazila->district->division->name ?? '—' }}

                        </span>

                    </div>


                    {{-- Survey Type --}}
                    <div class="info-box">

                        <span class="info-label">
                            Survey Type
                        </span>

                        <span class="info-value">

                            {{ $khatian->surveyType->name ?? '—' }}

                        </span>

                    </div>


                    {{-- Owner --}}
                    <div class="info-box">

                        <span class="info-label">
                            Owner Name
                        </span>

                        <span class="info-value">

                            {{ $khatian->owner_name ?? 'Not specified' }}

                        </span>

                    </div>


                    {{-- Price --}}
                    <div class="info-box price-box">

                        <span class="info-label">
                            Price
                        </span>

                        <span class="info-value price">

                            ৳{{ number_format($khatian->price, 2) }}

                        </span>

                    </div>


                    {{-- Status --}}
                    <div class="info-box">

                        <span class="info-label">
                            Record Status
                        </span>

                        <span class="info-value">

                            @if ($khatian->is_active)

                                <span class="status active">
                                    ● Active
                                </span>

                            @else

                                <span class="status inactive">
                                    ● Inactive
                                </span>

                            @endif

                        </span>

                    </div>


                    {{-- Created --}}
                    <div class="info-box">

                        <span class="info-label">
                            Created At
                        </span>

                        <span class="info-value">

                            {{ $khatian->created_at?->format('d M Y, h:i A') ?? '—' }}

                        </span>

                    </div>


                    {{-- Updated --}}
                    <div class="info-box">

                        <span class="info-label">
                            Last Updated
                        </span>

                        <span class="info-value">

                            {{ $khatian->updated_at?->format('d M Y, h:i A') ?? '—' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 PDF SECTION
            ===================================================== --}}
            <div class="section-card">

                <div class="section-heading">

                    <div class="section-icon pdf-icon">
                        ▧
                    </div>

                    <div>
                        <h3>
                            Khatian Document
                        </h3>

                        <p>
                            Digital PDF document associated with this record
                        </p>
                    </div>

                </div>


                @if ($khatian->pdf_path)

                    <div class="pdf-card">

                        <div class="pdf-left">

                            <div class="pdf-file-icon">
                                PDF
                            </div>

                            <div>

                                <h4>
                                    Khatian Document
                                </h4>

                                <p>
                                    Digital land record PDF is available
                                </p>

                            </div>

                        </div>


                        <div class="pdf-actions">

                            <a href="{{ asset('storage/' . $khatian->pdf_path) }}"
                               target="_blank"
                               class="btn btn-view">

                                👁 View PDF

                            </a>

                            <a href="{{ asset('storage/' . $khatian->pdf_path) }}"
                               download
                               class="btn btn-download">

                                ↓ Download

                            </a>

                        </div>

                    </div>

                @else

                    <div class="no-pdf">

                        <div class="no-pdf-icon">
                            ▧
                        </div>

                        <div>

                            <h4>
                                No PDF Available
                            </h4>

                            <p>
                                No digital document has been uploaded for this khatian yet.
                            </p>

                        </div>

                    </div>

                @endif

            </div>


            {{-- ====================================================
                 LOCATION PATH
            ===================================================== --}}
            <div class="section-card">

                <div class="section-heading">

                    <div class="section-icon">
                        ⌖
                    </div>

                    <div>
                        <h3>
                            Administrative Location
                        </h3>

                        <p>
                            Complete administrative hierarchy
                        </p>
                    </div>

                </div>


                <div class="location-path">

                    <div class="location-item">

                        <span class="location-number">
                            01
                        </span>

                        <div>
                            <span>Division</span>
                            <strong>
                                {{ $khatian->mouza->upazila->district->division->name ?? '—' }}
                            </strong>
                        </div>

                    </div>


                    <div class="location-arrow">
                        →
                    </div>


                    <div class="location-item">

                        <span class="location-number">
                            02
                        </span>

                        <div>
                            <span>District</span>
                            <strong>
                                {{ $khatian->mouza->upazila->district->name ?? '—' }}
                            </strong>
                        </div>

                    </div>


                    <div class="location-arrow">
                        →
                    </div>


                    <div class="location-item">

                        <span class="location-number">
                            03
                        </span>

                        <div>
                            <span>Upazila</span>
                            <strong>
                                {{ $khatian->mouza->upazila->name ?? '—' }}
                            </strong>
                        </div>

                    </div>


                    <div class="location-arrow">
                        →
                    </div>


                    <div class="location-item">

                        <span class="location-number">
                            04
                        </span>

                        <div>
                            <span>Mouza</span>
                            <strong>
                                {{ $khatian->mouza->name ?? '—' }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 ACTIONS
            ===================================================== --}}
            <div class="action-card">

                <a href="{{ route('admin.khatians.index') }}"
                   class="action-btn back">

                    ← Back

                </a>


                <div class="action-right">

                    <a href="{{ route('admin.khatians.edit', $khatian) }}"
                       class="action-btn edit">

                        ✎ Edit Khatian

                    </a>


                    <form method="POST"
                          action="{{ route('admin.khatians.destroy', $khatian) }}"
                          onsubmit="return confirm('Are you sure you want to delete this khatian?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="action-btn delete">

                            🗑 Delete

                        </button>

                    </form>

                </div>

            </div>


        </div>

    </div>


    {{-- ============================================================
         CSS
    ============================================================ --}}
    <style>

        * {
            box-sizing: border-box;
        }

        .khatian-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .breadcrumb {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .breadcrumb span {
            margin: 0 6px;
            color: #94a3b8;
        }

        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }

        .page-subtitle {
            margin-top: 5px;
            color: #64748b;
            font-size: 15px;
        }

        .header-back-btn {
            display: inline-flex;
            align-items: center;
            padding: 11px 18px;
            border-radius: 8px;
            background: #0f766e;
            color: white;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
            white-space: nowrap;
        }

        .header-back-btn:hover {
            background: #115e59;
        }


        /* PAGE */

        .khatian-page {
            background: #f1f5f9;
            min-height: calc(100vh - 80px);
            padding: 32px 20px 60px;
        }

        .khatian-container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }


        /* TITLE CARD */

        .title-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 28px;
            background: linear-gradient(
                135deg,
                #0f766e,
                #115e59
            );
            border-radius: 14px;
            color: white;
            box-shadow: 0 8px 25px rgba(15, 118, 110, .18);
            margin-bottom: 24px;
        }

        .title-icon {
            width: 62px;
            height: 62px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.15);
            font-size: 30px;
            flex-shrink: 0;
        }

        .title-content {
            flex: 1;
        }

        .title-label {
            display: block;
            font-size: 12px;
            letter-spacing: 1.5px;
            font-weight: 800;
            opacity: .8;
            margin-bottom: 4px;
        }

        .title-content h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
        }

        .title-content p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: .85;
        }


        /* STATUS */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status.active {
            background: #dcfce7;
            color: #166534;
        }

        .status.inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .title-status .status {
            background: white;
        }


        /* SECTION */

        .section-card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .05);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px 26px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .section-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 21px;
            font-weight: 800;
        }

        .section-icon.pdf-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .section-heading h3 {
            margin: 0;
            color: #0f172a;
            font-size: 19px;
            font-weight: 800;
        }

        .section-heading p {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }


        /* INFORMATION */

        .information-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            padding: 26px;
        }

        .info-box {
            min-height: 92px;
            padding: 17px 19px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
        }

        .info-box.highlight {
            background: #f0fdfa;
            border-color: #99f6e4;
        }

        .info-label {
            display: block;
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .info-value {
            display: block;
            color: #0f172a;
            font-size: 17px;
            font-weight: 700;
        }

        .info-value.large {
            font-size: 24px;
            color: #0f766e;
        }

        .info-value small {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-top: 3px;
            font-weight: 500;
        }

        .info-value.price {
            color: #0f766e;
            font-size: 22px;
        }

        .price-box {
            background: #f0fdfa;
            border-color: #99f6e4;
        }


        /* PDF */

        .pdf-card {
            margin: 24px 26px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: #f8fafc;
        }

        .pdf-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .pdf-file-icon {
            width: 55px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dc2626;
            color: white;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 900;
        }

        .pdf-left h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
        }

        .pdf-left p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .pdf-actions {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            transition: .2s;
        }

        .btn-view {
            background: #0f766e;
            color: white;
        }

        .btn-view:hover {
            background: #115e59;
        }

        .btn-download {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-download:hover {
            background: #cbd5e1;
        }


        /* NO PDF */

        .no-pdf {
            margin: 24px 26px;
            padding: 25px;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f8fafc;
        }

        .no-pdf-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e2e8f0;
            color: #64748b;
            border-radius: 10px;
            font-size: 20px;
        }

        .no-pdf h4 {
            margin: 0;
            color: #334155;
            font-size: 16px;
            font-weight: 800;
        }

        .no-pdf p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }


        /* LOCATION */

        .location-path {
            padding: 26px;
            display: flex;
            align-items: center;
            gap: 10px;
            overflow-x: auto;
        }

        .location-item {
            min-width: 190px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .location-number {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 11px;
            font-weight: 900;
            flex-shrink: 0;
        }

        .location-item span {
            display: block;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
        }

        .location-item strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            margin-top: 3px;
        }

        .location-arrow {
            color: #94a3b8;
            font-size: 20px;
            font-weight: 800;
        }


        /* ACTIONS */

        .action-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .05);
        }

        .action-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-right form {
            margin: 0;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 10px 17px;
            border: 0;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .action-btn.back {
            background: #e2e8f0;
            color: #334155;
        }

        .action-btn.back:hover {
            background: #cbd5e1;
        }

        .action-btn.edit {
            background: #0f766e;
            color: white;
        }

        .action-btn.edit:hover {
            background: #115e59;
        }

        .action-btn.delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .action-btn.delete:hover {
            background: #fecaca;
        }


        /* ============================================================
           TABLET
        ============================================================ */

        @media (max-width: 900px) {

            .khatian-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-back-btn {
                width: 100%;
                justify-content: center;
            }

            .information-grid {
                grid-template-columns: 1fr;
            }

            .location-path {
                align-items: stretch;
            }

            .location-arrow {
                display: none;
            }

            .location-item {
                min-width: 180px;
            }

        }


        /* ============================================================
           MOBILE
        ============================================================ */

        @media (max-width: 640px) {

            .khatian-page {
                padding: 20px 12px 40px;
            }

            .page-title {
                font-size: 22px;
            }

            .page-subtitle {
                font-size: 13px;
            }

            .breadcrumb {
                font-size: 12px;
            }

            .title-card {
                padding: 20px;
                gap: 14px;
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .title-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .title-content {
                width: calc(100% - 65px);
            }

            .title-content h1 {
                font-size: 22px;
            }

            .title-status {
                width: 100%;
                margin-top: 4px;
            }

            .section-heading {
                padding: 18px;
            }

            .section-heading h3 {
                font-size: 17px;
            }

            .information-grid {
                padding: 16px;
                gap: 12px;
            }

            .info-box {
                min-height: 80px;
                padding: 14px;
            }

            .info-value {
                font-size: 16px;
            }

            .info-value.large {
                font-size: 21px;
            }

            .pdf-card {
                margin: 16px;
                padding: 16px;
                flex-direction: column;
                align-items: stretch;
            }

            .pdf-actions {
                width: 100%;
            }

            .pdf-actions .btn {
                flex: 1;
            }

            .no-pdf {
                margin: 16px;
            }

            .location-path {
                padding: 16px;
                flex-direction: column;
            }

            .location-item {
                width: 100%;
                min-width: 0;
            }

            .action-card {
                flex-direction: column;
                align-items: stretch;
            }

            .action-right {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .action-btn {
                width: 100%;
            }

        }


        /* SMALL MOBILE */

        @media (max-width: 400px) {

            .action-right {
                grid-template-columns: 1fr;
            }

            .pdf-actions {
                flex-direction: column;
            }

            .pdf-actions .btn {
                width: 100%;
            }

        }

    </style>

</x-app-layout>