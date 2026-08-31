<x-app-layout>

    {{-- =========================================================
        MOUSZA MAP SERVICE
        Professional Land / Agriculture Inspired UI
    ========================================================== --}}

    <style>
        :root {
            --land-green: #166534;
            --land-green-dark: #14532d;
            --land-green-light: #dcfce7;
            --land-green-soft: #f0fdf4;

            --land-brown: #854d0e;
            --land-gold: #ca8a04;

            --text-main: #172016;
            --text-muted: #5f6b61;

            --surface: #ffffff;
            --surface-soft: #f7faf7;
            --border: #dce5dc;
        }

        .land-page {
            color: var(--text-main);
            background:
                linear-gradient(
                    180deg,
                    #f4faf4 0%,
                    #ffffff 38%,
                    #f7faf7 100%
                );
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        .land-container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        .land-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            border-radius: 999px;
            background: var(--land-green-light);
            color: var(--land-green-dark);
            border: 1px solid #bbf7d0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .land-label-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #22c55e;
        }

        .land-hero {
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #dbe7dc;
            background:
                radial-gradient(
                    circle at 85% 25%,
                    rgba(34, 197, 94, .12),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #f0fdf4 0%,
                    #ffffff 60%
                );
        }

        .land-hero-grid {
            position: absolute;
            inset: 0;
            opacity: .28;
            background-image:
                linear-gradient(
                    rgba(22, 101, 52, .08) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(22, 101, 52, .08) 1px,
                    transparent 1px
                );
            background-size: 45px 45px;
            mask-image: linear-gradient(
                to right,
                black,
                transparent 75%
            );
        }

        .land-hero-content {
            position: relative;
            padding-top: 76px;
            padding-bottom: 68px;
        }

        .land-hero-title {
            max-width: 780px;
            margin-top: 20px;
            font-size: clamp(38px, 5vw, 64px);
            line-height: 1.04;
            letter-spacing: -.045em;
            font-weight: 850;
            color: #102015;
        }

        .land-hero-title span {
            color: var(--land-green);
        }

        .land-hero-description {
            max-width: 690px;
            margin-top: 22px;
            color: var(--text-muted);
            font-size: 18px;
            line-height: 1.75;
        }

        .land-feature-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 34px;
            max-width: 720px;
        }

        .land-feature {
            display: flex;
            align-items: center;
            gap: 11px;
            color: #344236;
            font-size: 13px;
            font-weight: 700;
        }

        .land-feature-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: white;
            border: 1px solid #d7e5d8;
            color: var(--land-green);
            box-shadow: 0 3px 12px rgba(20, 83, 45, .06);
        }

        .land-section {
            padding-top: 62px;
            padding-bottom: 10px;
        }

        .land-section-heading {
            margin-bottom: 28px;
        }

        .land-eyebrow {
            color: var(--land-green);
            font-size: 12px;
            font-weight: 850;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .land-section-title {
            margin-top: 7px;
            font-size: 30px;
            line-height: 1.2;
            font-weight: 850;
            letter-spacing: -.025em;
            color: #172016;
        }

        .land-services {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .land-service-card {
            position: relative;
            overflow: hidden;
            min-height: 255px;
            padding: 28px;
            border-radius: 20px;
            border: 1px solid var(--border);
            background: white;
            box-shadow: 0 8px 28px rgba(20, 83, 45, .06);
        }

        .land-service-card.available {
            color: white;
            border-color: var(--land-green-dark);
            background:
                radial-gradient(
                    circle at 100% 0%,
                    rgba(134, 239, 172, .20),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #14532d,
                    #166534
                );
            box-shadow: 0 16px 40px rgba(20, 83, 45, .18);
        }

        .land-service-card.available::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            right: -90px;
            bottom: -130px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 50%;
            pointer-events: none;
        }

        .land-service-card.disabled-card {
            background: #fbfcfb;
        }

        .land-service-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
        }

        .land-service-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: var(--land-green-soft);
            color: var(--land-green);
        }

        .available .land-service-icon {
            background: rgba(255,255,255,.13);
            color: white;
            border: 1px solid rgba(255,255,255,.15);
        }

        .land-status {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .08em;
        }

        .land-status.available-status {
            color: #166534;
            background: #dcfce7;
        }

        .land-status.soon-status {
            color: #713f12;
            background: #fef3c7;
        }

        .land-service-title {
            margin-top: 22px;
            font-size: 23px;
            font-weight: 850;
        }

        .land-service-description {
            max-width: 500px;
            margin-top: 9px;
            color: #647064;
            line-height: 1.65;
            font-size: 14px;
        }

        .available .land-service-description {
            color: #dcfce7;
        }

        .land-service-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 22px;
            padding: 11px 17px;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
        }

        .available .land-service-button {
            color: #14532d;
            background: white;
        }

        .available .land-service-button:hover {
            transform: translateY(-1px);
            background: #f0fdf4;
        }

        .disabled-card .land-service-button {
            color: #899289;
            background: #edf1ed;
            cursor: not-allowed;
        }

        .finder-wrapper {
            margin-top: 62px;
            padding-bottom: 72px;
        }

        .finder-card {
            overflow: hidden;
            border-radius: 22px;
            border: 1px solid #d5e2d6;
            background: white;
            box-shadow:
                0 16px 50px rgba(20, 83, 45, .09);
        }

        .finder-header {
            position: relative;
            overflow: hidden;
            padding: 28px 30px;
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

        .finder-header::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            right: -90px;
            top: -150px;
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 50%;
            pointer-events: none;
        }

        .finder-header-title {
            position: relative;
            z-index: 1;
            font-size: 27px;
            font-weight: 850;
            letter-spacing: -.02em;
        }

        .finder-header-description {
            position: relative;
            z-index: 1;
            margin-top: 7px;
            color: #dcfce7;
            font-size: 14px;
        }

        .finder-body {
            padding: 30px;
        }

        .finder-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }

        .land-field label {
            display: block;
            margin-bottom: 8px;
            color: #334136;
            font-size: 12px;
            font-weight: 800;
        }

        .land-field select {
            width: 100%;
            height: 48px;
            padding: 0 13px;
            border-radius: 11px;
            border: 1px solid #cfdacf;
            outline: none;
            background: #fff;
            color: #1d2b20;
            font-size: 13px;
            font-weight: 650;
            transition: .15s ease;
        }

        .land-field select:hover {
            border-color: #a9bba9;
        }

        .land-field select:focus {
            border-color: var(--land-green);
            box-shadow: 0 0 0 3px rgba(22, 101, 52, .10);
        }

        .land-field select:disabled {
            color: #899289;
            background: #f4f7f4;
            cursor: not-allowed;
        }

        .land-loading {
            margin-top: 22px;
            padding: 14px 16px;
            border-radius: 11px;
            border: 1px solid #dbe8dc;
            background: #f4faf4;
            color: var(--land-green-dark);
            text-align: center;
            font-size: 13px;
            font-weight: 750;
        }

        .land-error {
            margin-top: 22px;
            padding: 14px 16px;
            border-radius: 11px;
            border: 1px solid #fecaca;
            background: #fff7f7;
            color: #991b1b;
            text-align: center;
            font-size: 13px;
            font-weight: 700;
        }

        .maps-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-top: 38px;
            margin-bottom: 20px;
        }

        .maps-title {
            font-size: 22px;
            font-weight: 850;
            letter-spacing: -.02em;
        }

        .maps-description {
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 13px;
        }

        .map-count {
            color: var(--land-green);
            font-size: 12px;
            font-weight: 800;
        }

        .maps-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 17px;
        }

        .map-card {
            padding: 21px;
            border: 1px solid #dbe4dc;
            border-radius: 17px;
            background: white;
            box-shadow: 0 5px 18px rgba(20, 83, 45, .045);
            transition: .2s ease;
        }

        .map-card:hover {
            transform: translateY(-2px);
            border-color: #a8c3ab;
            box-shadow: 0 12px 30px rgba(20, 83, 45, .10);
        }

        .map-card-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--land-green-soft);
            color: var(--land-green);
        }

        .map-card-title {
            margin-top: 16px;
            color: #18231a;
            font-size: 17px;
            line-height: 1.4;
            font-weight: 850;
        }

        .map-meta {
            margin-top: 15px;
            padding-top: 14px;
            border-top: 1px solid #edf1ed;
        }

        .map-meta-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 5px 0;
            font-size: 12px;
        }

        .map-meta-label {
            color: #748075;
        }

        .map-meta-value {
            color: #263329;
            font-weight: 750;
            text-align: right;
        }

        .map-price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 17px;
            padding-top: 15px;
            border-top: 1px solid #edf1ed;
        }

        .map-price-label {
            color: #748075;
            font-size: 12px;
            font-weight: 650;
        }

        .map-price {
            color: var(--land-green-dark);
            font-size: 21px;
            font-weight: 900;
        }

        .map-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 15px;
        }

        .map-action {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            transition: .15s ease;
        }

        .map-action-primary {
            color: white;
            background: var(--land-green);
        }

        .map-action-primary:hover {
            background: var(--land-green-dark);
        }

        .map-action-secondary {
            color: var(--land-green-dark);
            background: white;
            border: 1px solid #b8cbb9;
        }

        .map-action-secondary:hover {
            background: var(--land-green-soft);
        }

        .empty-state {
            margin-top: 30px;
            padding: 48px 20px;
            border: 1px dashed #cfdacf;
            border-radius: 17px;
            background: #fafcf9;
            text-align: center;
        }

        .empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #edf4ed;
            color: var(--land-green);
        }

        .empty-title {
            margin-top: 14px;
            color: #253126;
            font-size: 18px;
            font-weight: 850;
        }

        .empty-description {
            margin-top: 6px;
            color: #778178;
            font-size: 13px;
        }

        @media (max-width: 1024px) {

            .finder-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .maps-container {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 768px) {

            .land-container {
                padding-left: 18px;
                padding-right: 18px;
            }

            .land-hero-content {
                padding-top: 52px;
                padding-bottom: 50px;
            }

            .land-hero-description {
                font-size: 15px;
            }

            .land-feature-row {
                grid-template-columns: 1fr;
            }

            .land-services {
                grid-template-columns: 1fr;
            }

            .finder-body {
                padding: 20px;
            }

            .finder-grid {
                grid-template-columns: 1fr;
            }

            .maps-container {
                grid-template-columns: 1fr;
            }

            .maps-header {
                align-items: flex-start;
                flex-direction: column;
            }

        }

        @media (max-width: 480px) {

            .land-hero-title {
                font-size: 38px;
            }

            .land-service-card {
                padding: 22px;
            }

            .finder-header {
                padding: 23px 20px;
            }

            .finder-header-title {
                font-size: 23px;
            }

            .map-actions {
                grid-template-columns: 1fr;
            }

        }
    </style>


    <div class="land-page min-h-screen">

        {{-- =========================================================
            HERO
        ========================================================== --}}

        <section class="land-hero">

            <div class="land-hero-grid"></div>

            <div class="land-container land-hero-content">

                <span class="land-label">
                    <span class="land-label-dot"></span>
                    Digital Land Map Service
                </span>

                <h1 class="land-hero-title">
                    Find the right
                    <span>Mouza Map</span>
                    for your land.
                </h1>

                <p class="land-hero-description">
                    Select your division, district, upazila and mouza
                    to find available survey maps, view map details
                    and order the required PDF securely.
                </p>


                {{-- Feature Highlights --}}

                <div class="land-feature-row">

                    <div class="land-feature">

                        <div class="land-feature-icon">

                            <svg width="19"
                                 height="19"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M6 2h9l5 5v15H6V2zm9 0v6h5"
                                />

                            </svg>

                        </div>

                        Digital PDF Maps

                    </div>


                    <div class="land-feature">

                        <div class="land-feature-icon">

                            <svg width="19"
                                 height="19"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 21s7-4.5 7-10a7 7 0 10-14 0c0 5.5 7 10 7 10z"
                                />

                                <circle
                                    cx="12"
                                    cy="11"
                                    r="2.2"
                                />

                            </svg>

                        </div>

                        Location Based Search

                    </div>


                    <div class="land-feature">

                        <div class="land-feature-icon">

                            <svg width="19"
                                 height="19"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 12h14M13 6l6 6-6 6"
                                />

                            </svg>

                        </div>

                        Easy Ordering

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            SERVICES
        ========================================================== --}}

        <section class="land-container land-section">

            <div class="land-section-heading">

                <div class="land-eyebrow">
                    Our Services
                </div>

                <h2 class="land-section-title">
                    Choose a service
                </h2>

            </div>


            <div class="land-services">

                {{-- =====================================================
                    MOUZA MAP SERVICE
                ====================================================== --}}

                <button
                    type="button"
                    id="mouzaMapCard"
                    class="land-service-card available text-left"
                >

                    <div class="land-service-top">

                        <div class="land-service-icon">

                            <svg width="26"
                                 height="26"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M9 20l-5-2V6l5 2m0 12l6-2m-6 2V8m6 10l6 2V8l-6-2m0 12V6"
                                />

                            </svg>

                        </div>

                        <span class="land-status available-status">
                            Available
                        </span>

                    </div>


                    <h3 class="land-service-title">
                        Mouza Map
                    </h3>

                    <p class="land-service-description">
                        Search digital Mouza maps by location,
                        check availability and order the required
                        PDF map.
                    </p>


                    <span class="land-service-button">

                        Browse Mouza Maps

                        <svg width="16"
                             height="16"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />

                        </svg>

                    </span>

                </button>


                {{-- =====================================================
                    KHATIAN SERVICE
                ====================================================== --}}

                <button
                    type="button"
                    id="khatianCard"
                    class="land-service-card available text-left"
                >

                    <div class="land-service-top">

                        <div class="land-service-icon">

                            <svg width="25"
                                 height="25"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M6 2h9l5 5v15H6V2zm9 0v6h5"
                                />

                            </svg>

                        </div>

                        <span class="land-status available-status">
                            Available
                        </span>

                    </div>


                    <h3 class="land-service-title">
                        Khatian
                    </h3>

                    <p class="land-service-description">
                        Search digital Khatian records by location,
                        view owner information, survey details and
                        order the required Khatian PDF.
                    </p>


                    <span class="land-service-button">

                        Browse Khatians

                        <svg width="16"
                             height="16"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />

                        </svg>

                    </span>

                </button>

            </div>

        </section>


        {{-- =========================================================
            MAP FINDER
        ========================================================== --}}

        <section
            id="mapSearchSection"
            class="land-container finder-wrapper"
        >

            <div class="finder-card">

                {{-- Finder Header --}}

                <div class="finder-header">

                    <div class="finder-header-title">
                        Search Mouza Map
                    </div>

                    <p class="finder-header-description">
                        Select your location step by step to find
                        available survey maps.
                    </p>

                </div>


                {{-- Finder Body --}}

                <div class="finder-body">

                    <div class="finder-grid">

                        {{-- Division --}}

                        <div class="land-field">

                            <label for="division">
                                Division
                            </label>

                            <select id="division">

                                <option value="">
                                    Select Division
                                </option>

                                @foreach($divisions as $division)

                                    <option value="{{ $division->id }}">

                                        {{ $division->name }}

                                        @if($division->name_bn)
                                            — {{ $division->name_bn }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- District --}}

                        <div class="land-field">

                            <label for="district">
                                District
                            </label>

                            <select
                                id="district"
                                disabled
                            >

                                <option value="">
                                    Select District
                                </option>

                            </select>

                        </div>


                        {{-- Upazila --}}

                        <div class="land-field">

                            <label for="upazila">
                                Upazila / Thana
                            </label>

                            <select
                                id="upazila"
                                disabled
                            >

                                <option value="">
                                    Select Upazila
                                </option>

                            </select>

                        </div>


                        {{-- Mouza --}}

                        <div class="land-field">

                            <label for="mouza">
                                Mouza
                            </label>

                            <select
                                id="mouza"
                                disabled
                            >

                                <option value="">
                                    Select Mouza
                                </option>

                            </select>

                        </div>


                        {{-- Survey Type --}}

                        <div class="land-field">

                            <label for="surveyType">
                                Survey Type
                            </label>

                            <select
                                id="surveyType"
                                disabled
                            >

                                <option value="">
                                    Select Survey Type
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- Loading --}}

                    <div
                        id="mapLoading"
                        class="land-loading hidden"
                    >
                        Loading...
                    </div>


                    {{-- Error --}}

                    <div
                        id="mapError"
                        class="land-error hidden"
                    ></div>


                    {{-- Available Maps --}}

                    <div
                        id="mapsSection"
                        class="hidden"
                    >

                        <div class="maps-header">

                            <div>

                                <h3 class="maps-title">
                                    Available Maps
                                </h3>

                                <p class="maps-description">
                                    Maps available for your selected Mouza.
                                </p>

                            </div>

                            <div
                                id="mapCount"
                                class="map-count"
                            ></div>

                        </div>


                        <div
                            id="mapsContainer"
                            class="maps-container"
                        ></div>

                    </div>


                    {{-- No Maps --}}

                    <div
                        id="noMaps"
                        class="empty-state hidden"
                    >

                        <div class="empty-icon">

                            <svg width="25"
                                 height="25"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"
                                />

                            </svg>

                        </div>

                        <h3 class="empty-title">
                            No maps found
                        </h3>

                        <p class="empty-description">
                            There are no active maps available
                            for this Mouza.
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /*
                |--------------------------------------------------------------------------
                | DOM Elements
                |--------------------------------------------------------------------------
                */

                const division =
                    document.getElementById('division');

                const district =
                    document.getElementById('district');

                const upazila =
                    document.getElementById('upazila');

                const mouza =
                    document.getElementById('mouza');

                const surveyType =
                    document.getElementById('surveyType');

                const mapsSection =
                    document.getElementById('mapsSection');

                const mapsContainer =
                    document.getElementById('mapsContainer');

                const mapCount =
                    document.getElementById('mapCount');

                const noMaps =
                    document.getElementById('noMaps');

                const mapLoading =
                    document.getElementById('mapLoading');

                const mapError =
                    document.getElementById('mapError');

                const mouzaMapCard =
                    document.getElementById('mouzaMapCard');

                const khatianCard =
                    document.getElementById('khatianCard');

                const mapSearchSection =
                    document.getElementById('mapSearchSection');


                /*
                |--------------------------------------------------------------------------
                | Reset Select
                |--------------------------------------------------------------------------
                */

                function resetSelect(
                    select,
                    placeholder
                ) {

                    select.innerHTML = '';

                    const option =
                        document.createElement('option');

                    option.value = '';

                    option.textContent =
                        placeholder;

                    select.appendChild(option);

                    select.disabled = true;
                }


                /*
                |--------------------------------------------------------------------------
                | Hide Results
                |--------------------------------------------------------------------------
                */

                function hideResults()
                {
                    mapsSection.classList.add('hidden');

                    noMaps.classList.add('hidden');

                    mapsContainer.innerHTML = '';

                    mapCount.textContent = '';
                }


                /*
                |--------------------------------------------------------------------------
                | Show Error
                |--------------------------------------------------------------------------
                */

                function showError(message)
                {
                    mapError.textContent = message;

                    mapError.classList.remove('hidden');
                }


                /*
                |--------------------------------------------------------------------------
                | Clear Error
                |--------------------------------------------------------------------------
                */

                function clearError()
                {
                    mapError.textContent = '';

                    mapError.classList.add('hidden');
                }


                /*
                |--------------------------------------------------------------------------
                | Loading
                |--------------------------------------------------------------------------
                */

                function setLoading(status)
                {
                    if (status) {

                        mapLoading.classList.remove(
                            'hidden'
                        );

                    } else {

                        mapLoading.classList.add(
                            'hidden'
                        );

                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Load Districts
                |--------------------------------------------------------------------------
                */

                division.addEventListener(
                    'change',
                    async function ()
                    {

                        const divisionId =
                            this.value;


                        resetSelect(
                            district,
                            'Select District'
                        );

                        resetSelect(
                            upazila,
                            'Select Upazila'
                        );

                        resetSelect(
                            mouza,
                            'Select Mouza'
                        );

                        resetSelect(
                            surveyType,
                            'Select Survey Type'
                        );


                        hideResults();

                        clearError();


                        if (!divisionId) {
                            return;
                        }


                        setLoading(true);


                        try {

                            const response =
                                await fetch(
                                    `/maps/browse/divisions/${divisionId}/districts`
                                );


                            if (!response.ok) {
                                throw new Error(
                                    'Failed to load districts'
                                );
                            }


                            const districts =
                                await response.json();


                            districts.forEach(
                                function (item) {

                                    const option =
                                        document.createElement(
                                            'option'
                                        );

                                    option.value =
                                        item.id;

                                    option.textContent =
                                        item.name_bn
                                            ? `${item.name} — ${item.name_bn}`
                                            : item.name;

                                    district.appendChild(
                                        option
                                    );

                                }
                            );


                            district.disabled = false;


                        } catch (error) {

                            console.error(
                                error
                            );

                            showError(
                                'District data could not be loaded. Please try again.'
                            );

                        } finally {

                            setLoading(false);

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Load Upazilas
                |--------------------------------------------------------------------------
                */

                district.addEventListener(
                    'change',
                    async function ()
                    {

                        const districtId =
                            this.value;


                        resetSelect(
                            upazila,
                            'Select Upazila'
                        );

                        resetSelect(
                            mouza,
                            'Select Mouza'
                        );

                        resetSelect(
                            surveyType,
                            'Select Survey Type'
                        );


                        hideResults();

                        clearError();


                        if (!districtId) {
                            return;
                        }


                        setLoading(true);


                        try {

                            const response =
                                await fetch(
                                    `/maps/browse/districts/${districtId}/upazilas`
                                );


                            if (!response.ok) {
                                throw new Error(
                                    'Failed to load upazilas'
                                );
                            }


                            const upazilas =
                                await response.json();


                            upazilas.forEach(
                                function (item) {

                                    const option =
                                        document.createElement(
                                            'option'
                                        );

                                    option.value =
                                        item.id;

                                    option.textContent =
                                        item.name_bn
                                            ? `${item.name} — ${item.name_bn}`
                                            : item.name;

                                    upazila.appendChild(
                                        option
                                    );

                                }
                            );


                            upazila.disabled = false;


                        } catch (error) {

                            console.error(
                                error
                            );

                            showError(
                                'Upazila data could not be loaded. Please try again.'
                            );

                        } finally {

                            setLoading(false);

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Load Mouzas
                |--------------------------------------------------------------------------
                */

                upazila.addEventListener(
                    'change',
                    async function ()
                    {

                        const upazilaId =
                            this.value;


                        resetSelect(
                            mouza,
                            'Select Mouza'
                        );

                        resetSelect(
                            surveyType,
                            'Select Survey Type'
                        );


                        hideResults();

                        clearError();


                        if (!upazilaId) {
                            return;
                        }


                        setLoading(true);


                        try {

                            const response =
                                await fetch(
                                    `/maps/browse/upazilas/${upazilaId}/mouzas`
                                );


                            if (!response.ok) {
                                throw new Error(
                                    'Failed to load mouzas'
                                );
                            }


                            const mouzas =
                                await response.json();


                            mouzas.forEach(
                                function (item) {

                                    const option =
                                        document.createElement(
                                            'option'
                                        );


                                    option.value =
                                        item.id;


                                    let label =
                                        item.name || '';


                                    if (
                                        item.name_bn
                                    ) {

                                        label +=
                                            ` — ${item.name_bn}`;

                                    }


                                    if (
                                        item.jl_number
                                    ) {

                                        label +=
                                            ` (JL: ${item.jl_number})`;

                                    }


                                    option.textContent =
                                        label;


                                    option.dataset
                                        .surveyTypeId =
                                        item.survey_type_id
                                        ?? '';


                                    option.dataset
                                        .surveyType =
                                        item.survey_type
                                        ?? '';


                                    mouza.appendChild(
                                        option
                                    );

                                }
                            );


                            mouza.disabled = false;


                        } catch (error) {

                            console.error(
                                error
                            );

                            showError(
                                'Mouza data could not be loaded. Please try again.'
                            );

                        } finally {

                            setLoading(false);

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Mouza Change
                |--------------------------------------------------------------------------
                */

                mouza.addEventListener(
                    'change',
                    async function ()
                    {

                        const mouzaId =
                            this.value;


                        resetSelect(
                            surveyType,
                            'Select Survey Type'
                        );


                        hideResults();

                        clearError();


                        if (!mouzaId) {
                            return;
                        }


                        const selectedOption =
                            this.options[
                                this.selectedIndex
                            ];


                        const surveyTypeName =
                            selectedOption.dataset
                                .surveyType;


                        const surveyTypeId =
                            selectedOption.dataset
                                .surveyTypeId;


                        /*
                        |--------------------------------------------------------------------------
                        | Add Survey Type
                        |--------------------------------------------------------------------------
                        */

                        if (surveyTypeName) {

                            const option =
                                document.createElement(
                                    'option'
                                );


                            option.value =
                                surveyTypeId ||
                                surveyTypeName;


                            option.textContent =
                                surveyTypeName;


                            surveyType.appendChild(
                                option
                            );


                            surveyType.disabled =
                                false;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Load Maps
                        |--------------------------------------------------------------------------
                        */

                        await loadMaps(
                            mouzaId
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Load Maps
                |--------------------------------------------------------------------------
                */

                async function loadMaps(
                    mouzaId
                ) {

                    if (!mouzaId) {
                        return;
                    }


                    setLoading(true);

                    clearError();


                    try {

                        const response =
                            await fetch(
                                `/maps/browse/mouzas/${mouzaId}/maps`
                            );


                        if (!response.ok) {
                            throw new Error(
                                'Failed to load maps'
                            );
                        }


                        const maps =
                            await response.json();


                        mapsContainer.innerHTML =
                            '';


                        /*
                        |--------------------------------------------------------------------------
                        | No Maps
                        |--------------------------------------------------------------------------
                        */

                        if (
                            !maps ||
                            !maps.length
                        ) {

                            mapsSection
                                .classList
                                .add('hidden');

                            noMaps
                                .classList
                                .remove('hidden');

                            return;
                        }


                        noMaps
                            .classList
                            .add('hidden');


                        mapsSection
                            .classList
                            .remove('hidden');


                        mapCount.textContent =
                            `${maps.length} map${maps.length > 1 ? 's' : ''} available`;


                        /*
                        |--------------------------------------------------------------------------
                        | Render Maps
                        |--------------------------------------------------------------------------
                        */

                        maps.forEach(
                            function (map) {

                                const card =
                                    document.createElement(
                                        'div'
                                    );


                                card.className =
                                    'map-card';


                                const price =
                                    Number(
                                        map.price || 0
                                    ).toLocaleString(
                                        'en-BD',
                                        {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        }
                                    );


                                const viewUrl =
                                    map.view_url ||
                                    '#';


                                const orderUrl =
                                    map.order_url ||
                                    '#';


                                card.innerHTML = `

                                    <div class="flex items-start justify-between">

                                        <div class="map-card-icon">

                                            <svg
                                                width="22"
                                                height="22"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.7"
                                                    d="M6 2h9l5 5v15H6V2zm9 0v6h5"
                                                />

                                            </svg>

                                        </div>


                                        <span class="land-status available-status">
                                            Available
                                        </span>

                                    </div>


                                    <h4 class="map-card-title">
                                        ${escapeHtml(map.title)}
                                    </h4>


                                    <div class="map-meta">

                                        <div class="map-meta-row">

                                            <span class="map-meta-label">
                                                Mouza
                                            </span>

                                            <span class="map-meta-value">
                                                ${escapeHtml(
                                                    map.mouza || '-'
                                                )}
                                            </span>

                                        </div>


                                        <div class="map-meta-row">

                                            <span class="map-meta-label">
                                                JL Number
                                            </span>

                                            <span class="map-meta-value">
                                                ${escapeHtml(
                                                    map.jl_number || '-'
                                                )}
                                            </span>

                                        </div>


                                        <div class="map-meta-row">

                                            <span class="map-meta-label">
                                                Survey
                                            </span>

                                            <span class="map-meta-value">
                                                ${escapeHtml(
                                                    map.survey_type || '-'
                                                )}
                                            </span>

                                        </div>

                                    </div>


                                    <div class="map-price-row">

                                        <span class="map-price-label">
                                            Map Price
                                        </span>

                                        <span class="map-price">
                                            ৳${price}
                                        </span>

                                    </div>


                                    <div class="map-actions">

                                        <a
                                            href="${escapeAttribute(viewUrl)}"
                                            class="map-action map-action-primary"
                                        >
                                            View Details
                                        </a>


                                        <a
                                            href="${escapeAttribute(orderUrl)}"
                                            class="map-action map-action-secondary"
                                        >
                                            Order Now
                                        </a>

                                    </div>

                                `;


                                mapsContainer.appendChild(
                                    card
                                );

                            }
                        );


                    } catch (error) {

                        console.error(
                            error
                        );

                        showError(
                            'Map data could not be loaded. Please try again.'
                        );

                    } finally {

                        setLoading(false);

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Escape HTML
                |--------------------------------------------------------------------------
                */

                function escapeHtml(value)
                {

                    if (
                        value === null ||
                        value === undefined
                    ) {

                        return '';

                    }


                    return String(value)
                        .replace(
                            /&/g,
                            '&amp;'
                        )
                        .replace(
                            /</g,
                            '&lt;'
                        )
                        .replace(
                            />/g,
                            '&gt;'
                        )
                        .replace(
                            /"/g,
                            '&quot;'
                        )
                        .replace(
                            /'/g,
                            '&#039;'
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Escape Attribute
                |--------------------------------------------------------------------------
                */

                function escapeAttribute(value)
                {

                    if (
                        value === null ||
                        value === undefined
                    ) {

                        return '#';

                    }


                    return String(value)
                        .replace(
                            /"/g,
                            '&quot;'
                        )
                        .replace(
                            /'/g,
                            '&#039;'
                        );

                }


                /*
                |--------------------------------------------------------------------------
                | Scroll To Finder
                |--------------------------------------------------------------------------
                */

                mouzaMapCard.addEventListener(
                    'click',
                    function ()
                    {

                        mapSearchSection.scrollIntoView(
                            {
                                behavior: 'smooth',
                                block: 'start'
                            }
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Khatian Card
                |--------------------------------------------------------------------------
                |
                | Khatian search page route পরে বসানো যাবে।
                | এখন card click করলে কোনো broken URL হবে না।
                |--------------------------------------------------------------------------
                */

                khatianCard.addEventListener(
                    'click',
                    function ()
                    {

                        /*
                         * যদি তোমার Khatian route থাকে,
                         * এখানে ব্যবহার করবে:
                         *
                         * 
                         */
window.location.href =
                             "{{ route('khatians.browse') }}";
                        console.log(
                            'Khatian service selected.'
                        );

                    }
                );

            }
        );

    </script>

</x-app-layout>