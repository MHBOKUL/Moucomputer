<x-app-layout>

    {{-- =====================================================
        Header
    ====================================================== --}}
    <x-slot name="header">

        <div class="district-header">

            <div>
                <h2 class="district-header-title">
                    Edit District
                </h2>

                <p class="district-header-subtitle">
                    Update district information
                </p>
            </div>

            <a href="{{ route('admin.districts.index') }}"
               class="district-back-link">
                ← Back to Districts
            </a>

        </div>

    </x-slot>


    {{-- =====================================================
        Page
    ====================================================== --}}
    <div class="district-edit-page">

        <div class="district-edit-container">


            {{-- =================================================
                Page Intro
            ================================================== --}}
            <div class="district-intro">

                <div class="district-intro-icon">
                    ◇
                </div>

                <div>
                    <h1>
                        Edit District
                    </h1>

                    <p>
                        Update the district information and manage
                        its availability in the MoujaMap system.
                    </p>
                </div>

            </div>


            {{-- =================================================
                Main Card
            ================================================== --}}
            <div class="district-card">


                {{-- Card Header --}}
                <div class="district-card-header">

                    <div>

                        <h3>
                            District Information
                        </h3>

                        <p>
                            Please update the information below.
                        </p>

                    </div>

                    <span class="district-edit-badge">
                        Editing
                    </span>

                </div>


                {{-- =================================================
                    Form
                ================================================== --}}
                <form method="POST"
                      action="{{ route('admin.districts.update', $district) }}"
                      class="district-form">

                    @csrf
                    @method('PUT')


                    {{-- =================================================
                        Division
                    ================================================== --}}
                    <div class="district-form-group">

                        <label for="division_id"
                               class="district-label">

                            Division

                            <span class="required">
                                *
                            </span>

                        </label>

                        <p class="district-field-help">
                            Select the division where this district belongs.
                        </p>


                        <div class="district-input-wrapper">

                            <span class="district-input-icon">
                                ◈
                            </span>

                            <select id="division_id"
                                    name="division_id"
                                    required
                                    class="district-select">

                                @foreach ($divisions as $division)

                                    <option value="{{ $division->id }}"
                                        {{ old('division_id', $district->division_id) == $division->id ? 'selected' : '' }}>

                                        {{ $division->name }}

                                        @if ($division->name_bn)
                                            — {{ $division->name_bn }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        @error('division_id')

                            <p class="district-error">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        District Name
                    ================================================== --}}
                    <div class="district-form-group">

                        <label for="name"
                               class="district-label">

                            District Name

                            <span class="required">
                                *
                            </span>

                        </label>

                        <p class="district-field-help">
                            Enter the official English name of the district.
                        </p>


                        <div class="district-input-wrapper">

                            <span class="district-input-icon">
                                ◇
                            </span>

                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name', $district->name) }}"
                                   required
                                   placeholder="Enter district name"
                                   class="district-input">

                        </div>


                        @error('name')

                            <p class="district-error">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        Bangla Name
                    ================================================== --}}
                    <div class="district-form-group">

                        <label for="name_bn"
                               class="district-label">

                            বাংলা নাম

                        </label>

                        <p class="district-field-help">
                            জেলার বাংলা নাম লিখুন।
                        </p>


                        <div class="district-input-wrapper">

                            <span class="district-input-icon">
                                বাং
                            </span>

                            <input id="name_bn"
                                   name="name_bn"
                                   type="text"
                                   value="{{ old('name_bn', $district->name_bn) }}"
                                   placeholder="জেলার বাংলা নাম"
                                   class="district-input">

                        </div>


                        @error('name_bn')

                            <p class="district-error">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        Status
                    ================================================== --}}
                    <div class="district-status-box">

                        <div class="district-status-content">

                            <div class="district-status-icon">
                                ✓
                            </div>

                            <div class="district-status-text">

                                <h4>
                                    District Status
                                </h4>

                                <p>
                                    Active districts are available
                                    throughout the MoujaMap platform.
                                </p>

                            </div>

                        </div>


                        <label class="district-switch">

                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $district->is_active) ? 'checked' : '' }}>

                            <span class="district-slider"></span>

                        </label>

                    </div>


                    {{-- =================================================
                        Current Status
                    ================================================== --}}
                    <div class="district-current-status">

                        <span class="status-label">
                            Current Status
                        </span>

                        @if ($district->is_active)

                            <span class="status-badge active">
                                ● Active
                            </span>

                        @else

                            <span class="status-badge inactive">
                                ● Inactive
                            </span>

                        @endif

                    </div>


                    {{-- =================================================
                        Buttons
                    ================================================== --}}
                    <div class="district-form-actions">

                        <a href="{{ route('admin.districts.index') }}"
                           class="district-btn district-btn-cancel">

                            Cancel

                        </a>

                        <button type="submit"
                                class="district-btn district-btn-update">

                            <span>
                                ✓
                            </span>

                            Update District

                        </button>

                    </div>

                </form>

            </div>


            {{-- =================================================
                Footer Note
            ================================================== --}}
            <div class="district-security-note">

                <span>
                    🔒
                </span>

                <p>
                    Your changes will be saved securely to the
                    MoujaMap database.
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CSS
    ========================================================== --}}
    <style>

        /* =====================================================
           Page
        ====================================================== */

        .district-edit-page {
            min-height: calc(100vh - 70px);
            padding: 45px 20px 70px;
            background: #f5f7fb;
        }

        .district-edit-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }


        /* =====================================================
           Header
        ====================================================== */

        .district-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .district-header-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #111827;
        }

        .district-header-subtitle {
            margin: 4px 0 0;
            font-size: 14px;
            color: #6b7280;
        }

        .district-back-link {
            display: inline-flex;
            align-items: center;
            padding: 10px 16px;

            border: 1px solid #e5e7eb;
            border-radius: 9px;

            background: white;
            color: #374151;

            font-size: 14px;
            font-weight: 600;

            text-decoration: none;

            transition: all .2s ease;
        }

        .district-back-link:hover {
            background: #111827;
            color: white;
            border-color: #111827;
        }


        /* =====================================================
           Intro
        ====================================================== */

        .district-intro {
            display: flex;
            align-items: center;
            gap: 16px;

            margin-bottom: 25px;
        }

        .district-intro-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 52px;
            height: 52px;

            border-radius: 14px;

            background: #111827;
            color: white;

            font-size: 24px;
            font-weight: 700;

            box-shadow: 0 8px 20px rgba(17,24,39,.15);
        }

        .district-intro h1 {
            margin: 0;

            font-size: 30px;
            font-weight: 800;

            color: #111827;
        }

        .district-intro p {
            margin: 5px 0 0;

            font-size: 15px;
            line-height: 1.6;

            color: #6b7280;
        }


        /* =====================================================
           Main Card
        ====================================================== */

        .district-card {
            overflow: hidden;

            background: white;

            border: 1px solid #e5e7eb;
            border-radius: 18px;

            box-shadow:
                0 10px 30px rgba(15,23,42,.06);
        }


        /* =====================================================
           Card Header
        ====================================================== */

        .district-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 25px 30px;

            background: #fafafa;

            border-bottom: 1px solid #e5e7eb;
        }

        .district-card-header h3 {
            margin: 0;

            font-size: 20px;
            font-weight: 700;

            color: #111827;
        }

        .district-card-header p {
            margin: 5px 0 0;

            font-size: 14px;

            color: #6b7280;
        }

        .district-edit-badge {
            padding: 7px 12px;

            border-radius: 20px;

            background: #f3f4f6;
            color: #374151;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .05em;
        }


        /* =====================================================
           Form
        ====================================================== */

        .district-form {
            padding: 30px;
        }

        .district-form-group {
            margin-bottom: 28px;
        }

        .district-label {
            display: block;

            margin-bottom: 6px;

            font-size: 16px;
            font-weight: 700;

            color: #1f2937;
        }

        .required {
            color: #dc2626;
        }

        .district-field-help {
            margin: 0 0 10px;

            font-size: 13px;

            color: #6b7280;
        }


        /* =====================================================
           Input Wrapper
        ====================================================== */

        .district-input-wrapper {
            position: relative;
        }

        .district-input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            z-index: 2;

            color: #6b7280;

            font-size: 15px;
            font-weight: 700;

            pointer-events: none;
        }


        /* =====================================================
           Inputs
        ====================================================== */

        .district-input,
        .district-select {

            width: 100%;

            box-sizing: border-box;

            min-height: 54px;

            padding: 12px 15px 12px 45px;

            border: 1px solid #d1d5db;
            border-radius: 11px;

            background: white;

            color: #111827;

            font-size: 16px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .district-input::placeholder {
            color: #9ca3af;
        }

        .district-input:hover,
        .district-select:hover {
            border-color: #9ca3af;
        }

        .district-input:focus,
        .district-select:focus {
            border-color: #111827;

            box-shadow:
                0 0 0 3px rgba(17,24,39,.08);
        }


        /* =====================================================
           Error
        ====================================================== */

        .district-error {
            margin: 7px 0 0;

            font-size: 13px;
            font-weight: 600;

            color: #dc2626;
        }


        /* =====================================================
           Status Box
        ====================================================== */

        .district-status-box {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 20px;

            margin-top: 5px;

            border: 1px solid #e5e7eb;
            border-radius: 14px;

            background: #f9fafb;
        }

        .district-status-content {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .district-status-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 42px;
            height: 42px;

            flex-shrink: 0;

            border-radius: 11px;

            background: #111827;
            color: white;

            font-size: 18px;
            font-weight: 700;
        }

        .district-status-text h4 {
            margin: 0;

            font-size: 16px;
            font-weight: 700;

            color: #111827;
        }

        .district-status-text p {
            margin: 4px 0 0;

            font-size: 13px;

            line-height: 1.5;

            color: #6b7280;
        }


        /* =====================================================
           Toggle Switch
        ====================================================== */

        .district-switch {
            position: relative;

            width: 52px;
            height: 29px;

            flex-shrink: 0;

            cursor: pointer;
        }

        .district-switch input {
            position: absolute;

            opacity: 0;

            width: 0;
            height: 0;
        }

        .district-slider {
            position: absolute;

            inset: 0;

            border-radius: 30px;

            background: #d1d5db;

            transition: .25s;
        }

        .district-slider::before {
            content: "";

            position: absolute;

            width: 21px;
            height: 21px;

            left: 4px;
            top: 4px;

            border-radius: 50%;

            background: white;

            box-shadow: 0 2px 5px rgba(0,0,0,.2);

            transition: .25s;
        }

        .district-switch input:checked + .district-slider {
            background: #111827;
        }

        .district-switch input:checked + .district-slider::before {
            transform: translateX(23px);
        }


        /* =====================================================
           Current Status
        ====================================================== */

        .district-current-status {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 15px 2px 0;

        }

        .status-label {
            font-size: 13px;
            font-weight: 600;

            color: #6b7280;
        }

        .status-badge {
            padding: 6px 11px;

            border-radius: 20px;

            font-size: 12px;
            font-weight: 700;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.inactive {
            background: #fee2e2;
            color: #991b1b;
        }


        /* =====================================================
           Actions
        ====================================================== */

        .district-form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 12px;

            margin-top: 30px;
            padding-top: 25px;

            border-top: 1px solid #f0f0f0;
        }

        .district-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            min-height: 50px;

            padding: 0 22px;

            border-radius: 10px;

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            text-decoration: none;

            transition: all .2s ease;
        }

        .district-btn-cancel {
            border: 1px solid #e5e7eb;

            background: #f3f4f6;

            color: #374151;
        }

        .district-btn-cancel:hover {
            background: #e5e7eb;
        }

        .district-btn-update {
            border: 1px solid #111827;

            background: #111827;

            color: white;
        }

        .district-btn-update:hover {
            background: #1f2937;

            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(17,24,39,.18);
        }


        /* =====================================================
           Security Note
        ====================================================== */

        .district-security-note {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-top: 20px;

            text-align: center;
        }

        .district-security-note p {
            margin: 0;

            font-size: 12px;

            color: #9ca3af;
        }


        /* =====================================================
           Tablet
        ====================================================== */

        @media (max-width: 768px) {

            .district-edit-page {
                padding: 30px 16px 50px;
            }

            .district-intro h1 {
                font-size: 26px;
            }

            .district-card-header {
                padding: 22px;
            }

            .district-form {
                padding: 22px;
            }

        }


        /* =====================================================
           Mobile
        ====================================================== */

        @media (max-width: 600px) {

            .district-edit-page {
                padding: 20px 12px 40px;
            }


            /* Header */

            .district-header {
                align-items: flex-start;

                flex-direction: column;

                gap: 12px;
            }

            .district-header-title {
                font-size: 21px;
            }

            .district-header-subtitle {
                font-size: 13px;
            }

            .district-back-link {
                width: 100%;

                justify-content: center;

                box-sizing: border-box;
            }


            /* Intro */

            .district-intro {
                align-items: flex-start;

                gap: 12px;

                margin-bottom: 18px;
            }

            .district-intro-icon {
                width: 43px;
                height: 43px;

                border-radius: 11px;

                font-size: 19px;
            }

            .district-intro h1 {
                font-size: 23px;
            }

            .district-intro p {
                font-size: 13px;
            }


            /* Card */

            .district-card {
                border-radius: 14px;
            }

            .district-card-header {
                align-items: flex-start;

                flex-direction: column;

                padding: 18px;
            }

            .district-card-header h3 {
                font-size: 18px;
            }

            .district-edit-badge {
                font-size: 11px;
            }


            /* Form */

            .district-form {
                padding: 18px;
            }

            .district-form-group {
                margin-bottom: 23px;
            }

            .district-label {
                font-size: 15px;
            }

            .district-field-help {
                font-size: 12px;
            }

            .district-input,
            .district-select {
                min-height: 51px;

                font-size: 15px;

                padding-left: 43px;
            }


            /* Status */

            .district-status-box {
                align-items: flex-start;

                padding: 15px;
            }

            .district-status-content {
                gap: 10px;
            }

            .district-status-icon {
                width: 37px;
                height: 37px;

                font-size: 15px;
            }

            .district-status-text h4 {
                font-size: 14px;
            }

            .district-status-text p {
                font-size: 11px;
            }


            /* Buttons */

            .district-form-actions {
                flex-direction: column-reverse;

                align-items: stretch;
            }

            .district-btn {
                width: 100%;
            }


            /* Status */

            .district-current-status {
                padding-top: 13px;
            }

        }


        /* =====================================================
           Very Small Mobile
        ====================================================== */

        @media (max-width: 380px) {

            .district-edit-page {
                padding-left: 9px;
                padding-right: 9px;
            }

            .district-form {
                padding: 15px;
            }

            .district-card-header {
                padding: 15px;
            }

            .district-intro h1 {
                font-size: 21px;
            }

        }

    </style>

</x-app-layout>