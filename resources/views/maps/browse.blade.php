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

        .land-page {
            min-height: 100vh;
            color: var(--text-main);
            background:
                linear-gradient(
                    180deg,
                    #f4faf4 0%,
                    #ffffff 40%,
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

        /* =========================================================
           HERO
        ========================================================== */

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
            padding-top: 64px;
            padding-bottom: 58px;
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

        .land-hero-title {
            max-width: 800px;
            margin-top: 20px;
            font-size: clamp(38px, 5vw, 58px);
            line-height: 1.05;
            letter-spacing: -.045em;
            font-weight: 850;
            color: #102015;
        }

        .land-hero-title span {
            color: var(--land-green);
        }

        .land-hero-description {
            max-width: 680px;
            margin-top: 18px;
            color: var(--text-muted);
            font-size: 17px;
            line-height: 1.7;
        }

        /* =========================================================
           SEARCH SECTION
        ========================================================== */

        .finder-wrapper {
            padding-top: 48px;
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

        /*
        =========================================================
        FINDER GRID
        =========================================================
        5 columns because Survey Type is now added
        */

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

        /* Survey type selected */
        .land-field select.survey-selected {
            border-color: var(--land-green);
            background: #f0fdf4;
        }

        /* =========================================================
           LOADING
        ========================================================== */

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

        /* =========================================================
           RESULTS
        ========================================================== */

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

        .selected-survey {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 999px;
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            font-size: 11px;
            font-weight: 850;
        }

        .selected-survey-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #22c55e;
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

        .map-status {
            padding: 6px 10px;
            border-radius: 999px;
            color: #166534;
            background: #dcfce7;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .08em;
        }

        .map-survey {
            display: inline-flex;
            margin-top: 12px;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            color: #166534;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .05em;
        }

        .map-card-title {
            margin-top: 13px;
            color: #18231a;
            font-size: 17px;
            line-height: 1.4;
            font-weight: 850;
        }

        .map-file {
            margin-top: 5px;
            color: #748075;
            font-size: 12px;
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

        .map-action {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            margin-top: 15px;
            border-radius: 10px;
            color: white;
            background: var(--land-green);
            font-size: 12px;
            font-weight: 800;
            transition: .15s ease;
        }

        .map-action:hover {
            background: var(--land-green-dark);
        }

        /* =========================================================
           NO MAPS
        ========================================================== */

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

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1100px) {

            .finder-grid {
                grid-template-columns: repeat(3, 1fr);
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
                padding-top: 48px;
                padding-bottom: 45px;
            }

            .land-hero-description {
                font-size: 15px;
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

            .finder-header {
                padding: 23px 20px;
            }

            .finder-header-title {
                font-size: 23px;
            }
        }
    </style>


    <div class="land-page">

        {{-- =========================================================
            HERO
        ========================================================== --}}

        <section class="land-hero">

            <div class="land-hero-grid"></div>

            <div class="land-container land-hero-content">

                <span class="land-label">

                    <span class="land-label-dot"></span>

                    Mouza Map Service

                </span>


                <h1 class="land-hero-title">

                    Find your

                    <span>Mouza Map</span>

                    easily.

                </h1>


                <p class="land-hero-description">

                    Select your survey type, division, district,
                    upazila and mouza step by step to find available
                    digital maps and view the details of your required map.

                </p>

            </div>

        </section>


        {{-- =========================================================
            SEARCH
        ========================================================== --}}

        <section class="land-container finder-wrapper">

            <div class="finder-card">

                {{-- Finder Header --}}

                <div class="finder-header">

                    <div class="finder-header-title">
                        Search Mouza Map
                    </div>

                    <p class="finder-header-description">
                        Select survey type and location to find available maps.
                    </p>

                </div>


                {{-- Finder Body --}}

                <div class="finder-body">

                    <div class="finder-grid">

                        {{-- =================================================
                            SURVEY TYPE
                        ================================================== --}}

                        <div class="land-field">

                            <label for="survey_type">
                                Survey Type
                            </label>

                            <select
                                id="survey_type"
                                name="survey_type"
                            >

                                <option value="">
                                    Select Survey Type
                                </option>

                                <option value="RS">
                                    RS — Revisional Survey
                                </option>

                                <option value="CS">
                                    CS — Cadastral Survey
                                </option>

                            </select>

                        </div>


                        {{-- =================================================
                            DIVISION
                        ================================================== --}}

                        <div class="land-field">

                            <label for="division">
                                Division
                            </label>

                            <select
                                id="division"
                                name="division"
                                disabled
                            >

                                <option value="">
                                    Select Survey Type First
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


                        {{-- =================================================
                            DISTRICT
                        ================================================== --}}

                        <div class="land-field">

                            <label for="district">
                                District
                            </label>

                            <select
                                id="district"
                                name="district"
                                disabled
                            >

                                <option value="">
                                    Select Division First
                                </option>

                            </select>

                        </div>


                        {{-- =================================================
                            UPAZILA
                        ================================================== --}}

                        <div class="land-field">

                            <label for="upazila">
                                Upazila
                            </label>

                            <select
                                id="upazila"
                                name="upazila"
                                disabled
                            >

                                <option value="">
                                    Select District First
                                </option>

                            </select>

                        </div>


                        {{-- =================================================
                            MOUZA
                        ================================================== --}}

                        <div class="land-field">

                            <label for="mouza">
                                Mouza
                            </label>

                            <select
                                id="mouza"
                                name="mouza"
                                disabled
                            >

                                <option value="">
                                    Select Upazila First
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- Loading --}}

                    <div
                        id="loading"
                        class="land-loading hidden"
                    >
                        Loading...
                    </div>


                    {{-- =================================================
                        MAP RESULTS
                    ================================================== --}}

                    <div
                        id="map-results"
                        class="hidden"
                    >

                        <div class="maps-header">

                            <div>

                                <h3 class="maps-title">
                                    Available Maps
                                </h3>

                                <p class="maps-description">
                                    Select a map to view details and place your order.
                                </p>

                            </div>


                            <div
                                id="selected-survey"
                                class="selected-survey hidden"
                            >

                                <span class="selected-survey-dot"></span>

                                <span id="selected-survey-text"></span>

                            </div>

                        </div>


                        <div
                            id="map-list"
                            class="maps-container"
                        ></div>

                    </div>


                    {{-- =================================================
                        NO MAPS
                    ================================================== --}}

                    <div
                        id="no-maps"
                        class="empty-state hidden"
                    >

                        <div class="empty-icon">

                            <svg
                                width="25"
                                height="25"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 20l-5-2V6l5 2m0 12l6-2m-6 2V8m6 10l6 2V8l-6-2m0 12V6"
                                />

                            </svg>

                        </div>


                        <h3 class="empty-title">
                            No Maps Available
                        </h3>


                        <p
                            id="no-maps-description"
                            class="empty-description"
                        >
                            No map is currently available for this selection.
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    =============================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Elements
            |--------------------------------------------------------------------------
            */

            const surveyType = document.getElementById('survey_type');

            const division = document.getElementById('division');
            const district = document.getElementById('district');
            const upazila = document.getElementById('upazila');
            const mouza = document.getElementById('mouza');

            const loading = document.getElementById('loading');

            const mapResults =
                document.getElementById('map-results');

            const mapList =
                document.getElementById('map-list');

            const noMaps =
                document.getElementById('no-maps');

            const selectedSurvey =
                document.getElementById('selected-survey');

            const selectedSurveyText =
                document.getElementById('selected-survey-text');

            const noMapsDescription =
                document.getElementById('no-maps-description');


            /*
            |--------------------------------------------------------------------------
            | Reset Select
            |--------------------------------------------------------------------------
            */

            function resetSelect(select, text) {

                select.innerHTML = '';

                const option =
                    document.createElement('option');

                option.value = '';

                option.textContent = text;

                select.appendChild(option);

                select.disabled = true;

            }


            /*
            |--------------------------------------------------------------------------
            | Enable Select
            |--------------------------------------------------------------------------
            */

            function enableSelect(select) {

                select.disabled = false;

            }


            /*
            |--------------------------------------------------------------------------
            | Loading
            |--------------------------------------------------------------------------
            */

            function showLoading() {

                loading.classList.remove('hidden');

            }


            function hideLoading() {

                loading.classList.add('hidden');

            }


            /*
            |--------------------------------------------------------------------------
            | Reset Results
            |--------------------------------------------------------------------------
            */

            function resetResults() {

                mapResults.classList.add('hidden');

                noMaps.classList.add('hidden');

                selectedSurvey.classList.add('hidden');

                mapList.innerHTML = '';

            }


            /*
            |--------------------------------------------------------------------------
            | Show Selected Survey
            |--------------------------------------------------------------------------
            */

            function updateSelectedSurvey() {

                const value = surveyType.value;

                if (!value) {

                    selectedSurvey.classList.add('hidden');

                    return;

                }

                selectedSurveyText.textContent =
                    value + ' Survey Maps';

                selectedSurvey.classList.remove('hidden');

            }


            /*
            |--------------------------------------------------------------------------
            | SURVEY TYPE CHANGE
            |--------------------------------------------------------------------------
            |
            | Survey select করার পর Division enable হবে.
            |
            */

            surveyType.addEventListener('change', function () {

                const selectedType = this.value;


                resetSelect(
                    district,
                    'Select Division First'
                );

                resetSelect(
                    upazila,
                    'Select District First'
                );

                resetSelect(
                    mouza,
                    'Select Upazila First'
                );

                resetResults();


                if (!selectedType) {

                    resetSelect(
                        division,
                        'Select Survey Type First'
                    );

                    division.classList.remove(
                        'survey-selected'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Enable Division
                |--------------------------------------------------------------------------
                */

                division.disabled = false;

                division.classList.add(
                    'survey-selected'
                );

                /*
                | Division options already exist from Blade.
                | No AJAX required here.
                */

            });


            /*
            |--------------------------------------------------------------------------
            | DIVISION CHANGE
            |--------------------------------------------------------------------------
            */

            division.addEventListener('change', async function () {

                const divisionId = this.value;

                resetSelect(
                    district,
                    'Select Division First'
                );

                resetSelect(
                    upazila,
                    'Select District First'
                );

                resetSelect(
                    mouza,
                    'Select Upazila First'
                );

                resetResults();


                if (!divisionId) {
                    return;
                }


                showLoading();


                try {

                    const response = await fetch(
                        `/maps/browse/divisions/${divisionId}/districts`
                    );


                    if (!response.ok) {

                        throw new Error(
                            'Failed to load districts.'
                        );

                    }


                    const districts =
                        await response.json();


                    district.innerHTML = '';


                    const firstOption =
                        document.createElement('option');

                    firstOption.value = '';

                    firstOption.textContent =
                        'Select District';

                    district.appendChild(firstOption);


                    districts.forEach(function (item) {

                        const option =
                            document.createElement('option');

                        option.value = item.id;

                        option.textContent =
                            item.name +
                            (
                                item.name_bn
                                    ? ' — ' + item.name_bn
                                    : ''
                            );

                        district.appendChild(option);

                    });


                    enableSelect(district);


                } catch (error) {

                    console.error(error);

                    resetSelect(
                        district,
                        'Unable to load districts'
                    );

                } finally {

                    hideLoading();

                }

            });


            /*
            |--------------------------------------------------------------------------
            | DISTRICT CHANGE
            |--------------------------------------------------------------------------
            */

            district.addEventListener('change', async function () {

                const districtId = this.value;


                resetSelect(
                    upazila,
                    'Select District First'
                );

                resetSelect(
                    mouza,
                    'Select Upazila First'
                );

                resetResults();


                if (!districtId) {
                    return;
                }


                showLoading();


                try {

                    const response = await fetch(
                        `/maps/browse/districts/${districtId}/upazilas`
                    );


                    if (!response.ok) {

                        throw new Error(
                            'Failed to load upazilas.'
                        );

                    }


                    const upazilas =
                        await response.json();


                    upazila.innerHTML = '';


                    const firstOption =
                        document.createElement('option');

                    firstOption.value = '';

                    firstOption.textContent =
                        'Select Upazila';

                    upazila.appendChild(firstOption);


                    upazilas.forEach(function (item) {

                        const option =
                            document.createElement('option');

                        option.value = item.id;

                        option.textContent =
                            item.name +
                            (
                                item.name_bn
                                    ? ' — ' + item.name_bn
                                    : ''
                            );

                        upazila.appendChild(option);

                    });


                    enableSelect(upazila);


                } catch (error) {

                    console.error(error);

                    resetSelect(
                        upazila,
                        'Unable to load upazilas'
                    );

                } finally {

                    hideLoading();

                }

            });


            /*
            |--------------------------------------------------------------------------
            | UPAZILA CHANGE
            |--------------------------------------------------------------------------
            */

            upazila.addEventListener('change', async function () {

                const upazilaId = this.value;


                resetSelect(
                    mouza,
                    'Select Upazila First'
                );

                resetResults();


                if (!upazilaId) {
                    return;
                }


                showLoading();


                try {

                    const response = await fetch(
                        `/maps/browse/upazilas/${upazilaId}/mouzas`
                    );


                    if (!response.ok) {

                        throw new Error(
                            'Failed to load mouzas.'
                        );

                    }


                    const mouzas =
                        await response.json();


                    mouza.innerHTML = '';


                    const firstOption =
                        document.createElement('option');

                    firstOption.value = '';

                    firstOption.textContent =
                        'Select Mouza';

                    mouza.appendChild(firstOption);


                    mouzas.forEach(function (item) {

                        const option =
                            document.createElement('option');

                        option.value = item.id;

                        option.textContent =
                            item.name +
                            (
                                item.name_bn
                                    ? ' — ' + item.name_bn
                                    : ''
                            );

                        mouza.appendChild(option);

                    });


                    enableSelect(mouza);


                } catch (error) {

                    console.error(error);

                    resetSelect(
                        mouza,
                        'Unable to load mouzas'
                    );

                } finally {

                    hideLoading();

                }

            });


            /*
            |--------------------------------------------------------------------------
            | MOUZA CHANGE
            |--------------------------------------------------------------------------
            */

            mouza.addEventListener('change', async function () {

                const mouzaId = this.value;

                const selectedType =
                    surveyType.value;


                resetResults();


                if (!mouzaId || !selectedType) {
                    return;
                }


                showLoading();


                try {

                    const response = await fetch(
                        `/maps/browse/mouzas/${mouzaId}/maps`
                    );


                    if (!response.ok) {

                        throw new Error(
                            'Failed to load maps.'
                        );

                    }


                    const allMaps =
                        await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | Filter by Survey Type
                    |--------------------------------------------------------------------------
                    |
                    | Backend থেকে survey_type না থাকলেও error হবে না.
                    | শুধু matching maps দেখাবে.
                    |
                    */

                    const maps =
                        allMaps.filter(function (map) {

                            return String(
                                map.survey_type ?? ''
                            ).toUpperCase() ===
                            String(
                                selectedType
                            ).toUpperCase();

                        });


                    /*
                    |--------------------------------------------------------------------------
                    | No Maps
                    |--------------------------------------------------------------------------
                    */

                    if (!maps.length) {

                        noMapsDescription.textContent =
                            `No ${selectedType} survey map is currently available for this Mouza.`;

                        noMaps.classList.remove(
                            'hidden'
                        );

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Show Selected Survey
                    |--------------------------------------------------------------------------
                    */

                    updateSelectedSurvey();


                    /*
                    |--------------------------------------------------------------------------
                    | Create Map Cards
                    |--------------------------------------------------------------------------
                    */

                    maps.forEach(function (map) {

                        const card =
                            document.createElement('div');


                        card.className =
                            'map-card';


                        const mapSurvey =
                            map.survey_type
                                ? String(
                                    map.survey_type
                                ).toUpperCase()
                                : selectedType;


                        card.innerHTML = `

                            <div
                                class="flex items-start justify-between gap-4"
                            >

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


                                <span class="map-status">
                                    Available
                                </span>

                            </div>


                            <span class="map-survey">
                                ${mapSurvey} Survey
                            </span>


                            <h4 class="map-card-title">
                                ${map.title}
                            </h4>


                            <p class="map-file">
                                ${map.file_name ?? 'PDF Map'}
                            </p>


                            <div class="map-price-row">

                                <span class="map-price-label">
                                    Map Price
                                </span>

                                <span class="map-price">
                                    ৳ ${map.price}
                                </span>

                            </div>


                            <a
                                href="/maps/${map.id}"
                                class="map-action"
                            >

                                View Map Details

                                <svg
                                    class="ml-2"
                                    width="15"
                                    height="15"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />

                                </svg>

                            </a>

                        `;


                        mapList.appendChild(card);

                    });


                    mapResults.classList.remove(
                        'hidden'
                    );


                } catch (error) {

                    console.error(error);

                    noMapsDescription.textContent =
                        'Unable to load maps. Please try again.';

                    noMaps.classList.remove(
                        'hidden'
                    );

                } finally {

                    hideLoading();

                }

            });

        });

    </script>

</x-app-layout>

