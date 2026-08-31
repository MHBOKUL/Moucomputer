<x-app-layout>

    <style>
        :root {
            --land-green: #166534;
            --land-green-dark: #14532d;
            --land-green-light: #dcfce7;
            --land-green-soft: #f0fdf4;

            --text-main: #172016;
            --text-muted: #5f6b61;
            --border: #dce5dc;
        }

        .khatian-page {
            min-height: 100vh;
            background:
                linear-gradient(
                    180deg,
                    #f4faf4 0%,
                    #ffffff 45%,
                    #f7faf7 100%
                );
            color: var(--text-main);
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        .khatian-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 50px 24px 80px;
        }

        /* =========================================================
           BACK
        ========================================================== */

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--land-green);
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            margin-bottom: 22px;
        }

        .back-link:hover {
            color: var(--land-green-dark);
        }

        /* =========================================================
           MAIN CARD
        ========================================================== */

        .khatian-card {
            overflow: hidden;
            border: 1px solid #d5e2d6;
            border-radius: 22px;
            background: #ffffff;
            box-shadow:
                0 16px 50px rgba(20, 83, 45, .09);
        }

        /* =========================================================
           HEADER
        ========================================================== */

        .khatian-header {
            position: relative;
            overflow: hidden;
            padding: 32px;
            color: white;

            background:
                radial-gradient(
                    circle at 90% 10%,
                    rgba(134, 239, 172, .20),
                    transparent 28%
                ),
                linear-gradient(
                    135deg,
                    #14532d,
                    #166534
                );
        }

        .khatian-header::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -110px;
            top: -170px;
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 50%;
        }

        .survey-badge {
            position: relative;
            z-index: 1;

            display: inline-flex;
            align-items: center;

            padding: 7px 11px;

            border-radius: 999px;

            background: rgba(220,252,231,.16);
            border: 1px solid rgba(220,252,231,.25);

            color: #dcfce7;

            font-size: 11px;
            font-weight: 850;
            letter-spacing: .07em;
        }

        .khatian-title {
            position: relative;
            z-index: 1;

            margin-top: 15px;

            font-size: 34px;
            line-height: 1.15;
            font-weight: 900;
            letter-spacing: -.035em;
        }

        .khatian-subtitle {
            position: relative;
            z-index: 1;

            margin-top: 8px;

            color: #dcfce7;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================================================
           CONTENT
        ========================================================== */

        .khatian-body {
            padding: 32px;
        }

        .section-title {
            color: #18231a;
            font-size: 19px;
            font-weight: 850;
            letter-spacing: -.02em;
        }

        .section-description {
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 13px;
        }

        /* =========================================================
           INFO GRID
        ========================================================== */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 24px;
        }

        .info-box {
            padding: 18px;
            border: 1px solid #dbe4dc;
            border-radius: 14px;
            background: #fafcf9;
        }

        .info-label {
            color: #748075;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .info-value {
            margin-top: 7px;
            color: #18231a;
            font-size: 16px;
            font-weight: 800;
        }

        /* =========================================================
           LOCATION
        ========================================================== */

        .location-section {
            margin-top: 32px;
            padding-top: 28px;
            border-top: 1px solid #edf1ed;
        }

        .location-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .location-box {
            padding: 15px;
            border: 1px solid #dbe4dc;
            border-radius: 12px;
            background: white;
        }

        .location-label {
            color: #748075;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .location-value {
            margin-top: 6px;
            color: #253126;
            font-size: 13px;
            line-height: 1.5;
            font-weight: 750;
        }

        /* =========================================================
           PRICE / ACTION
        ========================================================== */

        .action-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;

            margin-top: 32px;
            padding: 22px;

            border-radius: 16px;
            border: 1px solid #bbf7d0;

            background: #f0fdf4;
        }

        .price-label {
            color: #5f6b61;
            font-size: 12px;
            font-weight: 700;
        }

        .price {
            margin-top: 3px;
            color: var(--land-green-dark);
            font-size: 28px;
            font-weight: 900;
        }

        .order-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 46px;
            padding: 0 22px;

            border-radius: 11px;

            color: white;
            background: var(--land-green);

            font-size: 13px;
            font-weight: 850;

            text-decoration: none;

            transition: .15s ease;
        }

        .order-button:hover {
            background: var(--land-green-dark);
            transform: translateY(-1px);
        }

        /* =========================================================
           PDF
        ========================================================== */

        .pdf-section {
            margin-top: 32px;
            padding-top: 28px;
            border-top: 1px solid #edf1ed;
        }

        .pdf-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-top: 18px;
            padding: 18px;

            border: 1px solid #dbe4dc;
            border-radius: 14px;

            background: #fafcf9;
        }

        .pdf-info {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .pdf-icon {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: #fee2e2;
            color: #b91c1c;
        }

        .pdf-name {
            color: #253126;
            font-size: 13px;
            font-weight: 800;
        }

        .pdf-description {
            margin-top: 3px;
            color: #778178;
            font-size: 11px;
        }

        .pdf-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 40px;
            padding: 0 16px;

            border-radius: 9px;

            color: #166534;
            background: #dcfce7;
            border: 1px solid #bbf7d0;

            font-size: 12px;
            font-weight: 800;

            text-decoration: none;
        }

        .pdf-button:hover {
            background: #bbf7d0;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 768px) {

            .khatian-container {
                padding: 35px 18px 60px;
            }

            .khatian-header {
                padding: 25px 22px;
            }

            .khatian-title {
                font-size: 28px;
            }

            .khatian-body {
                padding: 22px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .location-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-section {
                align-items: flex-start;
                flex-direction: column;
            }

            .order-button {
                width: 100%;
            }

            .pdf-box {
                align-items: flex-start;
                flex-direction: column;
            }

            .pdf-button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {

            .location-grid {
                grid-template-columns: 1fr;
            }

            .khatian-title {
                font-size: 25px;
            }

            .khatian-body {
                padding: 18px;
            }
        }
    </style>


    <div class="khatian-page">

        <div class="khatian-container">

            {{-- BACK --}}

            <a
                href="{{ url('/khatians/browse') }}"
                class="back-link"
            >

                <svg
                    width="16"
                    height="16"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Khatian Search

            </a>


            {{-- MAIN CARD --}}

            <div class="khatian-card">

                {{-- HEADER --}}

                <div class="khatian-header">

                    <span class="survey-badge">

                        {{ strtoupper($khatian->surveyType->name ?? 'Survey') }}

                        SURVEY

                    </span>


                    <h1 class="khatian-title">

                        Khatian No.
                        {{ $khatian->khatian_number }}

                    </h1>


                    <p class="khatian-subtitle">

                        Digital Khatian Record

                        @if($khatian->owner_name)
                            — Owner: {{ $khatian->owner_name }}
                        @endif

                    </p>

                </div>


                {{-- BODY --}}

                <div class="khatian-body">

                    <h2 class="section-title">
                        Khatian Information
                    </h2>

                    <p class="section-description">
                        Review the available information before placing your order.
                    </p>


                    {{-- INFORMATION --}}

                    <div class="info-grid">

                        <div class="info-box">

                            <div class="info-label">
                                Khatian Number
                            </div>

                            <div class="info-value">
                                {{ $khatian->khatian_number }}
                            </div>

                        </div>


                        <div class="info-box">

                            <div class="info-label">
                                Survey Type
                            </div>

                            <div class="info-value">
                                {{ strtoupper($khatian->surveyType->name ?? 'N/A') }}
                            </div>

                        </div>


                        <div class="info-box">

                            <div class="info-label">
                                Owner Name
                            </div>

                            <div class="info-value">
                                {{ $khatian->owner_name ?? 'Not Available' }}
                            </div>

                        </div>


                        <div class="info-box">

                            <div class="info-label">
                                Status
                            </div>

                            <div class="info-value">
                                @if($khatian->is_active)
                                    Available
                                @else
                                    Not Available
                                @endif
                            </div>

                        </div>

                    </div>


                    {{-- LOCATION --}}

                    <div class="location-section">

                        <h2 class="section-title">
                            Location
                        </h2>

                        <p class="section-description">
                            Administrative location of this Khatian.
                        </p>


                        <div class="location-grid">

                            <div class="location-box">

                                <div class="location-label">
                                    Division
                                </div>

                                <div class="location-value">
                                    {{ $khatian->mouza->upazila->district->division->name ?? 'N/A' }}
                                </div>

                            </div>


                            <div class="location-box">

                                <div class="location-label">
                                    District
                                </div>

                                <div class="location-value">
                                    {{ $khatian->mouza->upazila->district->name ?? 'N/A' }}
                                </div>

                            </div>


                            <div class="location-box">

                                <div class="location-label">
                                    Upazila
                                </div>

                                <div class="location-value">
                                    {{ $khatian->mouza->upazila->name ?? 'N/A' }}
                                </div>

                            </div>


                            <div class="location-box">

                                <div class="location-label">
                                    Mouza
                                </div>

                                <div class="location-value">
                                    {{ $khatian->mouza->name ?? 'N/A' }}
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PRICE / ORDER --}}

                    <div class="action-section">

                        <div>

                            <div class="price-label">
                                Khatian Price
                            </div>

                            <div class="price">
                                ৳ {{ number_format((float) $khatian->price, 2) }}
                            </div>

                        </div>


                       <a
    href="{{ route('orders.khatian.create', $khatian) }}"
    class="order-button"
>

    Place Order

    <svg
        width="16"
        height="16"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
    >

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 12h14M13 6l6 6-6 6"
        />

    </svg>

</a>

                    </div>


                    {{-- PDF --}}

                    @if($khatian->pdf_path)

                        <div class="pdf-section">

                            <h2 class="section-title">
                                Digital Record
                            </h2>

                            <p class="section-description">
                                A digital PDF record is available for this Khatian.
                            </p>


                            <div class="pdf-box">

                                <div class="pdf-info">

                                    <div class="pdf-icon">

                                        <svg
                                            width="21"
                                            height="21"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M14 2v6h6"
                                            />

                                        </svg>

                                    </div>


                                    <div>

                                        <div class="pdf-name">
                                            Digital Khatian PDF
                                        </div>

                                        <div class="pdf-description">
                                            PDF record is available.
                                        </div>

                                    </div>

                                </div>


                                {{-- Don't expose direct file yet --}}

                                <span
                                    class="pdf-button"
                                    style="cursor: default;"
                                >
                                    Available after order
                                </span>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>