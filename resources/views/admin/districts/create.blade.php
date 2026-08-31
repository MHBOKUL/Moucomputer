<x-app-layout>

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <x-slot name="header">
        <div class="district-header">

            <div>
                <div class="header-breadcrumb">
                    Administration / Districts
                </div>

                <h2>
                    Add District
                </h2>

                <p>
                    Create a new district for your MoujaMap system.
                </p>
            </div>

            <a href="{{ route('admin.districts.index') }}"
               class="back-btn">
                <span>←</span>
                Back to Districts
            </a>

        </div>
    </x-slot>


    {{-- =========================
        PAGE CONTENT
    ========================== --}}
    <div class="district-page">

        <div class="district-container">


            {{-- =========================
                INTRO
            ========================== --}}
            <div class="district-intro">

                <div class="district-icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m-2 4h2m4-8h1m-1 4h1m-1 4h1"/>

                    </svg>
                </div>

                <div>
                    <h1>Create New District</h1>

                    <p>
                        Add district information to the MoujaMap
                        administrative database.
                    </p>
                </div>

            </div>


            {{-- =========================
                FORM CARD
            ========================== --}}
            <div class="district-card">


                {{-- CARD HEADER --}}
                <div class="card-header">

                    <div>
                        <h3>District Information</h3>

                        <p>
                            Enter the required information below.
                        </p>
                    </div>

                    <span class="required-badge">
                        * Required
                    </span>

                </div>


                {{-- =========================
                    FORM
                ========================== --}}
                <form method="POST"
                      action="{{ route('admin.districts.store') }}">

                    @csrf


                    <div class="form-body">


                        {{-- =========================
                            DIVISION
                        ========================== --}}
                        <div class="form-group">

                            <label for="division_id">
                                Division
                                <span>*</span>
                            </label>

                            <select id="division_id"
                                    name="division_id"
                                    required>

                                <option value="">
                                    Select Division
                                </option>

                                @foreach ($divisions as $division)

                                    <option value="{{ $division->id }}"
                                        {{ old('division_id') == $division->id ? 'selected' : '' }}>

                                        {{ $division->name }}

                                        @if ($division->name_bn)
                                            — {{ $division->name_bn }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>


                            @error('division_id')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- =========================
                            DISTRICT NAME
                        ========================== --}}
                        <div class="form-group">

                            <label for="name">
                                District Name
                                <span>*</span>
                            </label>

                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Naogaon"
                                   required>

                            <div class="field-help">
                                Enter the official English name of the district.
                            </div>


                            @error('name')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- =========================
                            BANGLA NAME
                        ========================== --}}
                        <div class="form-group">

                            <label for="name_bn">
                                বাংলা নাম
                            </label>

                            <input id="name_bn"
                                   name="name_bn"
                                   type="text"
                                   value="{{ old('name_bn') }}"
                                   placeholder="উদাহরণ: নওগাঁ">

                            <div class="field-help">
                                বাংলায় জেলার নাম লিখুন।
                            </div>


                            @error('name_bn')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- =========================
                            STATUS
                        ========================== --}}
                        <div class="status-box">

                            <label class="status-label">

                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       checked>

                                <div class="status-content">

                                    <strong>
                                        Active District
                                    </strong>

                                    <span>
                                        This district will be available
                                        throughout the system.
                                    </span>

                                </div>

                            </label>

                        </div>


                    </div>


                    {{-- =========================
                        FORM FOOTER
                    ========================== --}}
                    <div class="form-footer">

                        <a href="{{ route('admin.districts.index') }}"
                           class="cancel-btn">

                            Cancel

                        </a>


                        <button type="submit"
                                class="save-btn">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                            Save District

                        </button>

                    </div>

                </form>

            </div>


            {{-- =========================
                FOOT NOTE
            ========================== --}}
            <div class="page-note">

                <span>*</span>
                Required fields

            </div>

        </div>

    </div>


    {{-- =========================================================
        CSS
    ========================================================== --}}
    <style>

        /* =========================
           RESET / BASE
        ========================== */

        .district-page,
        .district-page * {
            box-sizing: border-box;
        }

        .district-page {
            width: 100%;
            min-height: calc(100vh - 80px);
            background: #f6f7f9;
            padding: 40px 20px 60px;
            color: #111827;
        }


        /* =========================
           HEADER
        ========================== */

        .district-header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
        }

        .district-header .header-breadcrumb {
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .district-header h2 {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 800;
            color: #111827;
        }

        .district-header p {
            margin: 7px 0 0;
            font-size: 15px;
            color: #6b7280;
        }


        /* =========================
           BACK BUTTON
        ========================== */

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 46px;
            padding: 0 18px;

            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 10px;

            color: #374151;
            font-size: 15px;
            font-weight: 600;

            text-decoration: none;

            transition: all .2s ease;
        }

        .back-btn span {
            font-size: 20px;
            line-height: 1;
        }

        .back-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            transform: translateY(-1px);
        }


        /* =========================
           CONTAINER
        ========================== */

        .district-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }


        /* =========================
           INTRO
        ========================== */

        .district-intro {
            display: flex;
            align-items: center;
            gap: 17px;
            margin-bottom: 25px;
        }

        .district-icon {
            width: 58px;
            height: 58px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #111827;
            color: #ffffff;

            border-radius: 15px;

            box-shadow: 0 8px 20px rgba(17, 24, 39, .15);
        }

        .district-icon svg {
            width: 29px;
            height: 29px;
        }

        .district-intro h1 {
            margin: 0;

            font-size: 24px;
            font-weight: 800;
            line-height: 1.3;

            color: #111827;
        }

        .district-intro p {
            margin: 5px 0 0;

            font-size: 15px;
            line-height: 1.5;

            color: #6b7280;
        }


        /* =========================
           CARD
        ========================== */

        .district-card {
            width: 100%;

            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 4px 6px rgba(0, 0, 0, .03),
                0 10px 30px rgba(0, 0, 0, .04);
        }


        /* =========================
           CARD HEADER
        ========================== */

        .card-header {
            min-height: 85px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 22px 30px;

            background: #fafafa;

            border-bottom: 1px solid #e5e7eb;
        }

        .card-header h3 {
            margin: 0;

            font-size: 19px;
            font-weight: 750;

            color: #111827;
        }

        .card-header p {
            margin: 5px 0 0;

            font-size: 14px;

            color: #6b7280;
        }

        .required-badge {
            display: inline-flex;
            align-items: center;

            padding: 6px 11px;

            background: #fff7ed;
            color: #c2410c;

            border: 1px solid #fed7aa;

            border-radius: 20px;

            font-size: 12px;
            font-weight: 700;

            white-space: nowrap;
        }


        /* =========================
           FORM BODY
        ========================== */

        .form-body {
            padding: 32px 30px;

            display: flex;
            flex-direction: column;

            gap: 27px;
        }


        /* =========================
           FORM GROUP
        ========================== */

        .form-group {
            width: 100%;
        }

        .form-group label {
            display: block;

            margin-bottom: 9px;

            font-size: 16px;
            font-weight: 700;

            color: #1f2937;
        }

        .form-group label span {
            color: #dc2626;
            margin-left: 2px;
        }


        /* =========================
           INPUT / SELECT
        ========================== */

        .form-group input,
        .form-group select {
            width: 100%;

            height: 54px;

            padding: 0 16px;

            border: 1px solid #d1d5db;
            border-radius: 11px;

            background: #ffffff;

            color: #111827;

            font-family: inherit;
            font-size: 16px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: #9ca3af;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #111827;

            box-shadow:
                0 0 0 3px rgba(17, 24, 39, .08);

            background: #ffffff;
        }


        /* =========================
           HELPER TEXT
        ========================== */

        .field-help {
            margin-top: 7px;

            font-size: 13px;
            line-height: 1.5;

            color: #6b7280;
        }


        /* =========================
           ERROR
        ========================== */

        .error-message {
            margin-top: 7px;

            padding: 8px 11px;

            background: #fef2f2;

            border: 1px solid #fecaca;
            border-radius: 8px;

            color: #b91c1c;

            font-size: 13px;
            font-weight: 500;
        }


        /* =========================
           STATUS
        ========================== */

        .status-box {
            width: 100%;

            padding: 18px;

            background: #f9fafb;

            border: 1px solid #e5e7eb;
            border-radius: 12px;
        }

        .status-label {
            display: flex;
            align-items: center;
            gap: 14px;

            cursor: pointer;
        }

        .status-label input {
            width: 22px;
            height: 22px;

            flex-shrink: 0;

            accent-color: #111827;

            cursor: pointer;
        }

        .status-content {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .status-content strong {
            font-size: 16px;
            font-weight: 700;

            color: #1f2937;
        }

        .status-content span {
            font-size: 13px;
            line-height: 1.5;

            color: #6b7280;
        }


        /* =========================
           FORM FOOTER
        ========================== */

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 12px;

            padding: 20px 30px;

            background: #fafafa;

            border-top: 1px solid #e5e7eb;
        }


        /* =========================
           BUTTONS
        ========================== */

        .cancel-btn,
        .save-btn {
            min-height: 50px;

            padding: 0 22px;

            border-radius: 10px;

            font-family: inherit;
            font-size: 15px;
            font-weight: 700;

            text-decoration: none;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            transition: all .2s ease;

            cursor: pointer;
        }

        .cancel-btn {
            background: #ffffff;

            border: 1px solid #d1d5db;

            color: #374151;
        }

        .cancel-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .save-btn {
            gap: 8px;

            border: 1px solid #111827;

            background: #111827;

            color: #ffffff;
        }

        .save-btn svg {
            width: 18px;
            height: 18px;
        }

        .save-btn:hover {
            background: #1f2937;
            border-color: #1f2937;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(17, 24, 39, .15);
        }

        .save-btn:active {
            transform: translateY(0);
        }


        /* =========================
           PAGE NOTE
        ========================== */

        .page-note {
            margin-top: 15px;

            text-align: center;

            font-size: 13px;

            color: #9ca3af;
        }

        .page-note span {
            color: #dc2626;
        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 768px) {

            .district-page {
                padding: 30px 16px 45px;
            }

            .district-header {
                align-items: flex-start;
            }

            .district-header h2 {
                font-size: 24px;
            }

            .district-header p {
                font-size: 14px;
            }

            .district-container {
                max-width: 100%;
            }

            .district-intro h1 {
                font-size: 21px;
            }

            .district-intro p {
                font-size: 14px;
            }

            .card-header {
                padding: 20px;
            }

            .form-body {
                padding: 25px 20px;
            }

            .form-footer {
                padding: 18px 20px;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 600px) {

            .district-page {
                padding: 22px 12px 40px;
            }


            /* Header */

            .district-header {
                flex-direction: column;

                align-items: stretch;

                gap: 15px;
            }

            .district-header h2 {
                font-size: 23px;
            }

            .district-header p {
                font-size: 13px;
            }

            .back-btn {
                width: 100%;
            }


            /* Intro */

            .district-intro {
                align-items: flex-start;

                gap: 12px;

                margin-bottom: 18px;
            }

            .district-icon {
                width: 48px;
                height: 48px;

                border-radius: 12px;
            }

            .district-icon svg {
                width: 24px;
                height: 24px;
            }

            .district-intro h1 {
                font-size: 19px;
            }

            .district-intro p {
                font-size: 13px;
            }


            /* Card */

            .district-card {
                border-radius: 14px;
            }


            /* Card Header */

            .card-header {
                flex-direction: column;

                align-items: flex-start;

                padding: 18px 16px;

                gap: 10px;
            }

            .card-header h3 {
                font-size: 17px;
            }

            .card-header p {
                font-size: 13px;
            }


            /* Form */

            .form-body {
                padding: 22px 16px;

                gap: 22px;
            }

            .form-group label {
                font-size: 15px;
            }

            .form-group input,
            .form-group select {
                height: 52px;

                padding: 0 14px;

                font-size: 15px;
            }


            /* Status */

            .status-box {
                padding: 15px;
            }

            .status-label {
                align-items: flex-start;
            }

            .status-label input {
                width: 20px;
                height: 20px;

                margin-top: 2px;
            }

            .status-content strong {
                font-size: 15px;
            }

            .status-content span {
                font-size: 12px;
            }


            /* Footer */

            .form-footer {
                flex-direction: column-reverse;

                padding: 16px;

                gap: 10px;
            }

            .cancel-btn,
            .save-btn {
                width: 100%;

                min-height: 52px;
            }

        }


        /* =========================================================
           SMALL MOBILE
        ========================================================== */

        @media (max-width: 380px) {

            .district-page {
                padding-left: 10px;
                padding-right: 10px;
            }

            .district-intro h1 {
                font-size: 17px;
            }

            .district-intro p {
                font-size: 12px;
            }

            .form-body {
                padding: 20px 13px;
            }

            .card-header {
                padding: 17px 13px;
            }

            .form-footer {
                padding: 14px 13px;
            }

        }

    </style>

</x-app-layout>

