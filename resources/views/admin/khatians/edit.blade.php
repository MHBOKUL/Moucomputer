<x-app-layout>

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <x-slot name="header">

        <div class="khatian-header">

            <div class="header-left">

                <div class="header-icon">
                    ✎
                </div>

                <div>
                    <h2 class="header-title">
                        Edit Khatian
                    </h2>

                    <p class="header-subtitle">
                        Khatian Management System
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.khatians.index') }}"
               class="header-back-btn">

                ← Back to Khatian List

            </a>

        </div>

    </x-slot>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <div class="khatian-page">

        <div class="khatian-container">


            {{-- =================================================
                BREADCRUMB
            ================================================== --}}

            <div class="breadcrumb">

                <a href="{{ route('admin.dashboard') }}">
                    Admin
                </a>

                <span>›</span>

                <a href="{{ route('admin.khatians.index') }}">
                    Khatian Management
                </a>

                <span>›</span>

                <strong>
                    Edit Khatian
                </strong>

            </div>


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="alert-success">

                    <div class="alert-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Success</strong>

                        <p>
                            {{ session('success') }}
                        </p>
                    </div>

                </div>

            @endif


            {{-- =================================================
                VALIDATION ERRORS
            ================================================== --}}

            @if($errors->any())

                <div class="alert-error">

                    <div class="alert-icon">
                        !
                    </div>

                    <div>

                        <strong>
                            Please fix the following errors
                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif


            {{-- =================================================
                MAIN CARD
            ================================================== --}}

            <div class="form-card">


                {{-- CARD HEADER --}}

                <div class="form-card-header">

                    <div>

                        <h1>
                            Edit Khatian Information
                        </h1>

                        <p>
                            Update the land record information below.
                        </p>

                    </div>

                    <div class="khatian-number-badge">

                        Khatian #{{ $khatian->khatian_number }}

                    </div>

                </div>


                {{-- FORM --}}

                <form method="POST"
                      action="{{ route('admin.khatians.update', $khatian) }}">

                    @csrf

                    @method('PUT')


                    <div class="form-body">


                        {{-- =================================================
                            LOCATION INFORMATION
                        ================================================== --}}

                        <div class="section-title">

                            <div class="section-number">
                                01
                            </div>

                            <div>

                                <h3>
                                    Location Information
                                </h3>

                                <p>
                                    Select the mouza where this khatian belongs.
                                </p>

                            </div>

                        </div>


                        <div class="form-grid">


                            {{-- Mouza --}}

                            <div class="form-group">

                                <label for="mouza_id">

                                    Mouza

                                    <span>*</span>

                                </label>

                                <select id="mouza_id"
                                        name="mouza_id"
                                        required
                                        class="form-control">

                                    <option value="">
                                        Select Mouza
                                    </option>

                                    @foreach($mouzas as $mouza)

                                        <option value="{{ $mouza->id }}"
                                            {{ old('mouza_id', $khatian->mouza_id) == $mouza->id ? 'selected' : '' }}>

                                            {{ $mouza->name }}

                                            @if($mouza->name_bn)
                                                — {{ $mouza->name_bn }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                                @error('mouza_id')

                                    <p class="field-error">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Survey Type --}}

                            <div class="form-group">

                                <label for="survey_type_id">

                                    Survey Type

                                    <span>*</span>

                                </label>

                                <select id="survey_type_id"
                                        name="survey_type_id"
                                        required
                                        class="form-control">

                                    <option value="">
                                        Select Survey Type
                                    </option>

                                    @foreach($surveyTypes as $surveyType)

                                        <option value="{{ $surveyType->id }}"
                                            {{ old('survey_type_id', $khatian->survey_type_id) == $surveyType->id ? 'selected' : '' }}>

                                            {{ $surveyType->name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('survey_type_id')

                                    <p class="field-error">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- =================================================
                            KHATIAN INFORMATION
                        ================================================== --}}

                        <div class="section-title section-spacing">

                            <div class="section-number">
                                02
                            </div>

                            <div>

                                <h3>
                                    Khatian Information
                                </h3>

                                <p>
                                    Enter the basic khatian and owner information.
                                </p>

                            </div>

                        </div>


                        <div class="form-grid">


                            {{-- Khatian Number --}}

                            <div class="form-group">

                                <label for="khatian_number">

                                    Khatian Number

                                    <span>*</span>

                                </label>

                                <input type="text"
                                       id="khatian_number"
                                       name="khatian_number"
                                       value="{{ old('khatian_number', $khatian->khatian_number) }}"
                                       required
                                       placeholder="Example: 1234"
                                       class="form-control">

                                @error('khatian_number')

                                    <p class="field-error">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Owner Name --}}

                            <div class="form-group">

                                <label for="owner_name">

                                    Owner Name

                                </label>

                                <input type="text"
                                       id="owner_name"
                                       name="owner_name"
                                       value="{{ old('owner_name', $khatian->owner_name) }}"
                                       placeholder="Enter owner name"
                                       class="form-control">

                                @error('owner_name')

                                    <p class="field-error">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- =================================================
                            PDF & PRICE
                        ================================================== --}}

                        <div class="section-title section-spacing">

                            <div class="section-number">
                                03
                            </div>

                            <div>

                                <h3>
                                    Document & Pricing
                                </h3>

                                <p>
                                    Manage the PDF document and selling price.
                                </p>

                            </div>

                        </div>


                        <div class="form-grid">


                            {{-- PDF --}}

                            <div class="form-group">

                                <label for="pdf">

                                    Khatian PDF

                                </label>

                                <div class="file-box">

                                    <input type="file"
                                           id="pdf"
                                           name="pdf"
                                           accept=".pdf">

                                    <div class="file-info">

                                        <div class="file-icon">
                                            PDF
                                        </div>

                                        <div>

                                            <strong>
                                                Replace PDF
                                            </strong>

                                            <small>
                                                PDF only · Maximum recommended size 20MB
                                            </small>

                                        </div>

                                    </div>

                                </div>

                                @if($khatian->pdf_path)

                                    <div class="current-file">

                                        <span>
                                            Current PDF
                                        </span>

                                        <a href="{{ asset('storage/' . $khatian->pdf_path) }}"
                                           target="_blank">

                                            View Current PDF ↗

                                        </a>

                                    </div>

                                @endif

                                @error('pdf')

                                    <p class="field-error">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Price --}}

                            <div class="form-group">

                                <label for="price">

                                    Price

                                    <span>*</span>

                                </label>

                                <div class="price-input">

                                    <span>
                                        ৳
                                    </span>

                                    <input type="number"
                                           id="price"
                                           name="price"
                                           value="{{ old('price', $khatian->price) }}"
                                           min="0"
                                           step="0.01"
                                           required
                                           placeholder="0.00">

                                </div>

                                <small class="help-text">

                                    Set 0 for a free khatian.

                                </small>

                                @error('price')

                                    <p class="field-error">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- =================================================
                            STATUS
                        ================================================== --}}

                        <div class="section-title section-spacing">

                            <div class="section-number">
                                04
                            </div>

                            <div>

                                <h3>
                                    Publication Status
                                </h3>

                                <p>
                                    Control whether this khatian is available to customers.
                                </p>

                            </div>

                        </div>


                        <div class="status-card">

                            <div class="status-left">

                                <div class="status-icon">
                                    ✓
                                </div>

                                <div>

                                    <strong>
                                        Active Khatian
                                    </strong>

                                    <p>
                                        Active khatians can be displayed and purchased by customers.
                                    </p>

                                </div>

                            </div>


                            <label class="switch">

                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $khatian->is_active) ? 'checked' : '' }}>

                                <span class="slider"></span>

                            </label>

                        </div>


                    </div>


                    {{-- =================================================
                        FORM FOOTER
                    ================================================== --}}

                    <div class="form-footer">

                        <a href="{{ route('admin.khatians.index') }}"
                           class="btn btn-cancel">

                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            ✓ Update Khatian

                        </button>

                    </div>


                </form>

            </div>


            {{-- =================================================
                INFORMATION CARD
            ================================================== --}}

            <div class="info-card">

                <div class="info-icon">
                    i
                </div>

                <div>

                    <strong>
                        Important Information
                    </strong>

                    <p>
                        Make sure the Mouza, Survey Type and Khatian Number
                        are correct before updating the record. Customers
                        may use this information to identify and purchase
                        the correct land record.
                    </p>

                </div>

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

        .khatian-page {
            background: #f3f7f5;
            min-height: calc(100vh - 65px);
            padding: 35px 20px 60px;
        }

        .khatian-container {
            max-width: 1100px;
            margin: auto;
        }


        /* ================================
           HEADER
        ================================= */

        .khatian-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #087f5b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            font-weight: 700;
        }

        .header-title {
            font-size: 25px;
            font-weight: 800;
            color: #16352d;
            line-height: 1.2;
        }

        .header-subtitle {
            font-size: 13px;
            color: #71817b;
            margin-top: 3px;
        }

        .header-back-btn {
            padding: 11px 18px;
            border: 1px solid #d4dfda;
            border-radius: 8px;
            background: white;
            color: #176b52;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .header-back-btn:hover {
            background: #eaf5f0;
            border-color: #087f5b;
        }


        /* ================================
           BREADCRUMB
        ================================= */

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
            margin-bottom: 22px;
            font-size: 14px;
            color: #77837f;
        }

        .breadcrumb a {
            color: #087f5b;
            text-decoration: none;
            font-weight: 600;
        }

        .breadcrumb strong {
            color: #34443e;
        }


        /* ================================
           ALERTS
        ================================= */

        .alert-success,
        .alert-error {
            display: flex;
            gap: 13px;
            padding: 16px 18px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #e9f8f0;
            border: 1px solid #b8e5cf;
            color: #176b45;
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #f3c3c3;
            color: #a82b2b;
        }

        .alert-icon {
            width: 27px;
            height: 27px;
            flex: 0 0 27px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            background: currentColor;
            color: white;
        }

        .alert-success .alert-icon {
            background: #159765;
        }

        .alert-error .alert-icon {
            background: #d94141;
        }

        .alert-success p {
            margin-top: 3px;
        }

        .alert-error ul {
            margin-top: 6px;
            padding-left: 18px;
        }


        /* ================================
           FORM CARD
        ================================= */

        .form-card {
            background: white;
            border-radius: 14px;
            border: 1px solid #dfe9e5;
            box-shadow: 0 5px 25px rgba(20, 60, 45, .07);
            overflow: hidden;
        }

        .form-card-header {
            padding: 25px 30px;
            background: linear-gradient(
                135deg,
                #087f5b,
                #075f47
            );
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .form-card-header h1 {
            font-size: 22px;
            font-weight: 800;
        }

        .form-card-header p {
            margin-top: 5px;
            font-size: 14px;
            color: #d7eee6;
        }

        .khatian-number-badge {
            padding: 9px 14px;
            border-radius: 7px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .form-body {
            padding: 32px;
        }


        /* ================================
           SECTION TITLE
        ================================= */

        .section-title {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding-bottom: 18px;
            border-bottom: 1px solid #e5ece9;
        }

        .section-spacing {
            margin-top: 38px;
        }

        .section-number {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 8px;
            background: #e8f5f0;
            color: #087f5b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .section-title h3 {
            color: #183b31;
            font-size: 18px;
            font-weight: 800;
        }

        .section-title p {
            margin-top: 3px;
            color: #7a8883;
            font-size: 13px;
        }


        /* ================================
           FORM GRID
        ================================= */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 25px;
            margin-top: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #273c35;
            font-size: 14px;
            font-weight: 750;
        }

        .form-group label span {
            color: #dc3e3e;
        }

        .form-control {
            width: 100%;
            height: 50px;
            padding: 0 15px;
            border: 1px solid #cfdcd7;
            border-radius: 8px;
            background: #fbfdfc;
            color: #243b34;
            font-size: 15px;
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            background: white;
            border-color: #087f5b;
            box-shadow: 0 0 0 3px rgba(8,127,91,.11);
        }

        .field-error {
            margin-top: 6px;
            color: #dc3e3e;
            font-size: 13px;
        }


        /* ================================
           FILE UPLOAD
        ================================= */

        .file-box {
            position: relative;
            min-height: 85px;
            border: 1.5px dashed #b7cbc3;
            border-radius: 9px;
            background: #f8fbfa;
            overflow: hidden;
        }

        .file-box input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 17px;
        }

        .file-icon {
            width: 42px;
            height: 42px;
            border-radius: 7px;
            background: #e74b4b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 900;
        }

        .file-info strong {
            display: block;
            color: #29463c;
            font-size: 14px;
        }

        .file-info small {
            display: block;
            color: #81908b;
            margin-top: 3px;
            font-size: 12px;
        }

        .current-file {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 9px;
            padding: 9px 12px;
            background: #edf7f3;
            border-radius: 6px;
            font-size: 12px;
        }

        .current-file span {
            color: #6c7d76;
        }

        .current-file a {
            color: #087f5b;
            font-weight: 700;
            text-decoration: none;
        }


        /* ================================
           PRICE
        ================================= */

        .price-input {
            height: 50px;
            display: flex;
            align-items: center;
            border: 1px solid #cfdcd7;
            border-radius: 8px;
            background: #fbfdfc;
            overflow: hidden;
        }

        .price-input span {
            height: 100%;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf5f1;
            color: #087f5b;
            font-weight: 800;
            border-right: 1px solid #d4e1dc;
        }

        .price-input input {
            width: 100%;
            height: 100%;
            border: 0;
            outline: 0;
            padding: 0 14px;
            background: transparent;
            font-size: 15px;
        }

        .help-text {
            display: block;
            margin-top: 7px;
            color: #7b8984;
            font-size: 12px;
        }


        /* ================================
           STATUS
        ================================= */

        .status-card {
            margin-top: 24px;
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border: 1px solid #d8e6e0;
            border-radius: 10px;
            background: #f7fbf9;
        }

        .status-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .status-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dff4e9;
            color: #087f5b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .status-left strong {
            color: #234238;
            font-size: 14px;
        }

        .status-left p {
            margin-top: 3px;
            color: #7a8983;
            font-size: 12px;
        }


        /* ================================
           SWITCH
        ================================= */

        .switch {
            position: relative;
            width: 52px;
            height: 28px;
            flex: 0 0 52px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            inset: 0;
            cursor: pointer;
            border-radius: 30px;
            background: #b9c8c2;
            transition: .25s;
        }

        .slider:before {
            content: "";
            position: absolute;
            width: 22px;
            height: 22px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: white;
            transition: .25s;
            box-shadow: 0 1px 4px rgba(0,0,0,.2);
        }

        .switch input:checked + .slider {
            background: #087f5b;
        }

        .switch input:checked + .slider:before {
            transform: translateX(24px);
        }


        /* ================================
           FOOTER BUTTONS
        ================================= */

        .form-footer {
            padding: 20px 32px;
            border-top: 1px solid #e5ece9;
            background: #fafcfb;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            min-height: 46px;
            padding: 0 21px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 750;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            transition: .2s;
        }

        .btn-cancel {
            background: #e9eeec;
            color: #41534c;
        }

        .btn-cancel:hover {
            background: #dce5e1;
        }

        .btn-primary {
            background: #087f5b;
            color: white;
            box-shadow: 0 3px 8px rgba(8,127,91,.18);
        }

        .btn-primary:hover {
            background: #066548;
            transform: translateY(-1px);
        }


        /* ================================
           INFO CARD
        ================================= */

        .info-card {
            margin-top: 20px;
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #eef7f4;
            border: 1px solid #cce4da;
            border-radius: 10px;
        }

        .info-icon {
            width: 28px;
            height: 28px;
            flex: 0 0 28px;
            border-radius: 50%;
            background: #087f5b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .info-card strong {
            color: #245043;
            font-size: 14px;
        }

        .info-card p {
            margin-top: 4px;
            color: #667a72;
            font-size: 13px;
            line-height: 1.6;
        }


        /* ================================
           TABLET
        ================================= */

        @media (max-width: 768px) {

            .khatian-page {
                padding: 22px 14px 45px;
            }

            .khatian-header {
                align-items: flex-start;
            }

            .header-back-btn {
                font-size: 12px;
                padding: 9px 12px;
            }

            .header-title {
                font-size: 21px;
            }

            .form-card-header {
                padding: 22px;
                align-items: flex-start;
                flex-direction: column;
            }

            .form-body {
                padding: 23px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-footer {
                padding: 17px 23px;
            }

        }


        /* ================================
           MOBILE
        ================================= */

        @media (max-width: 520px) {

            .khatian-page {
                padding: 15px 10px 35px;
            }

            .khatian-header {
                flex-direction: column;
                align-items: stretch;
            }

            .header-back-btn {
                text-align: center;
                width: 100%;
            }

            .header-icon {
                width: 42px;
                height: 42px;
                font-size: 19px;
            }

            .header-title {
                font-size: 20px;
            }

            .breadcrumb {
                font-size: 12px;
                gap: 6px;
            }

            .form-card {
                border-radius: 10px;
            }

            .form-card-header {
                padding: 19px;
            }

            .form-card-header h1 {
                font-size: 18px;
            }

            .form-card-header p {
                font-size: 12px;
            }

            .khatian-number-badge {
                width: 100%;
                text-align: center;
            }

            .form-body {
                padding: 18px;
            }

            .section-title {
                gap: 10px;
            }

            .section-number {
                width: 34px;
                height: 34px;
                flex-basis: 34px;
            }

            .section-title h3 {
                font-size: 16px;
            }

            .section-title p {
                font-size: 12px;
                line-height: 1.5;
            }

            .form-control,
            .price-input {
                height: 48px;
            }

            .status-card {
                align-items: flex-start;
            }

            .status-left {
                align-items: flex-start;
            }

            .status-left p {
                line-height: 1.5;
            }

            .form-footer {
                flex-direction: column-reverse;
                padding: 17px;
            }

            .form-footer .btn {
                width: 100%;
            }

            .info-card {
                padding: 15px;
            }

        }

    </style>

</x-app-layout>