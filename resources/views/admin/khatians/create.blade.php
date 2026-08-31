
<x-app-layout>

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <x-slot name="header">

        <div class="khatian-header">

            <div>
                <div class="breadcrumb">
                    Admin Panel
                    <span>/</span>
                    Khatian Management
                    <span>/</span>
                    Add Khatian
                </div>

                <h2>
                    Add New Khatian
                </h2>

                <p>
                    Add khatian information and upload the corresponding PDF document.
                </p>
            </div>

            <a href="{{ route('admin.khatians.index') }}"
               class="back-button">
                ← Back to Khatians
            </a>

        </div>

    </x-slot>


    {{-- =========================================================
         PAGE CONTENT
    ========================================================== --}}
    <div class="khatian-page">

        <div class="khatian-container">

            {{-- Success Message --}}
            @if (session('success'))

                <div class="alert-success">
                    <span class="alert-icon">✓</span>

                    <div>
                        <strong>Success</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>

            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="alert-error">

                    <div class="alert-error-title">
                        ⚠ Please correct the following errors:
                    </div>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- =================================================
                 MAIN FORM CARD
            ================================================== --}}
            <div class="form-card">

                {{-- Card Header --}}
                <div class="form-card-header">

                    <div class="header-icon">
                        📄
                    </div>

                    <div>
                        <h3>Khatian Information</h3>

                        <p>
                            Enter the land record information carefully.
                        </p>
                    </div>

                </div>


                {{-- Form --}}
                <form method="POST"
                      action="{{ route('admin.khatians.store') }}"
                      enctype="multipart/form-data">

                    @csrf


                    <div class="form-body">


                        {{-- =================================================
                             LOCATION INFORMATION
                        ================================================== --}}
                        <div class="section-title">

                            <div class="section-number">
                                01
                            </div>

                            <div>
                                <h4>Location Information</h4>

                                <p>
                                    Select the Mouza where this khatian belongs.
                                </p>
                            </div>

                        </div>


                        <div class="form-grid">

                            {{-- Mouza --}}
                            <div class="form-group full-width">

                                <label for="mouza_id">
                                    Mouza
                                    <span>*</span>
                                </label>

                                <select id="mouza_id"
                                        name="mouza_id"
                                        required>

                                    <option value="">
                                        Select Mouza
                                    </option>

                                    @foreach ($mouzas as $mouza)

                                        <option value="{{ $mouza->id }}"
                                            {{ old('mouza_id') == $mouza->id ? 'selected' : '' }}>

                                            {{ $mouza->name }}

                                            @if ($mouza->name_bn)
                                                — {{ $mouza->name_bn }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                                @error('mouza_id')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
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
                                        required>

                                    <option value="">
                                        Select Survey Type
                                    </option>

                                    @foreach ($surveyTypes as $surveyType)

                                        <option value="{{ $surveyType->id }}"
                                            {{ old('survey_type_id') == $surveyType->id ? 'selected' : '' }}>

                                            {{ $surveyType->name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('survey_type_id')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Khatian Number --}}
                            <div class="form-group">

                                <label for="khatian_number">
                                    Khatian Number
                                    <span>*</span>
                                </label>

                                <input type="text"
                                       id="khatian_number"
                                       name="khatian_number"
                                       value="{{ old('khatian_number') }}"
                                       placeholder="Example: 125"
                                       required>

                                @error('khatian_number')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small>
                                    Enter the official khatian number.
                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                             OWNER INFORMATION
                        ================================================== --}}
                        <div class="section-title section-space">

                            <div class="section-number">
                                02
                            </div>

                            <div>
                                <h4>Owner Information</h4>

                                <p>
                                    Add the primary owner name if available.
                                </p>
                            </div>

                        </div>


                        <div class="form-grid">

                            <div class="form-group full-width">

                                <label for="owner_name">
                                    Owner Name
                                </label>

                                <input type="text"
                                       id="owner_name"
                                       name="owner_name"
                                       value="{{ old('owner_name') }}"
                                       placeholder="Enter owner name">

                                @error('owner_name')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- =================================================
                             PDF & PRICE
                        ================================================== --}}
                        <div class="section-title section-space">

                            <div class="section-number">
                                03
                            </div>

                            <div>
                                <h4>Digital Document & Pricing</h4>

                                <p>
                                    Upload the khatian PDF and set its selling price.
                                </p>
                            </div>

                        </div>


                        <div class="form-grid">

                            {{-- PDF --}}
                            <div class="form-group">

                                <label for="pdf">
                                    Khatian PDF
                                </label>

                                <div class="file-upload">

                                    <div class="upload-icon">
                                        ↑
                                    </div>

                                    <div class="upload-content">

                                        <input type="file"
                                               id="pdf"
                                               name="pdf"
                                               accept=".pdf">

                                        <label for="pdf">
                                            Choose PDF File
                                        </label>

                                        <p>
                                            PDF only · Maximum recommended size: 20 MB
                                        </p>

                                    </div>

                                </div>

                                @error('pdf')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Price --}}
                            <div class="form-group">

                                <label for="price">
                                    Price (BDT)
                                    <span>*</span>
                                </label>

                                <div class="price-input">

                                    <span>৳</span>

                                    <input type="number"
                                           id="price"
                                           name="price"
                                           value="{{ old('price', 0) }}"
                                           min="0"
                                           step="0.01"
                                           required>

                                </div>

                                @error('price')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small>
                                    Enter 0 if this khatian is free.
                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                             STATUS
                        ================================================== --}}
                        <div class="section-title section-space">

                            <div class="section-number">
                                04
                            </div>

                            <div>
                                <h4>Publication Status</h4>

                                <p>
                                    Control whether customers can access this khatian.
                                </p>
                            </div>

                        </div>


                        <div class="status-box">

                            <label class="status-toggle">

                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>

                                <span class="toggle"></span>

                                <span class="status-text">

                                    <strong>Active Khatian</strong>

                                    <small>
                                        Customers can view and purchase this khatian.
                                    </small>

                                </span>

                            </label>

                        </div>


                    </div>


                    {{-- =================================================
                         FORM FOOTER
                    ================================================== --}}
                    <div class="form-footer">

                        <a href="{{ route('admin.khatians.index') }}"
                           class="cancel-button">
                            Cancel
                        </a>

                        <button type="submit"
                                class="save-button">

                            <span>✓</span>

                            Save Khatian

                        </button>

                    </div>

                </form>

            </div>


            {{-- Information Card --}}
            <div class="info-card">

                <div class="info-icon">
                    ℹ
                </div>

                <div>

                    <strong>Important</strong>

                    <p>
                        Make sure the Mouza, Survey Type and Khatian Number
                        are correct before saving. Uploaded PDF files should
                        correspond to the selected land record.
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

        .khatian-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .breadcrumb {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .breadcrumb span {
            margin: 0 7px;
            color: #94a3b8;
        }

        .khatian-header h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
        }

        .khatian-header p {
            margin: 5px 0 0;
            font-size: 15px;
            color: #64748b;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
            white-space: nowrap;
        }

        .back-button:hover {
            background: #e2e8f0;
        }


        /* PAGE */

        .khatian-page {
            min-height: calc(100vh - 80px);
            padding: 35px 20px 60px;
            background:
                linear-gradient(
                    180deg,
                    #f1f5f9 0%,
                    #f8fafc 100%
                );
        }

        .khatian-container {
            width: 100%;
            max-width: 1050px;
            margin: auto;
        }


        /* ALERT */

        .alert-success,
        .alert-error {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 17px 20px;
            margin-bottom: 22px;
            border-radius: 12px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            display: block;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #10b981;
            color: white;
            font-weight: 800;
        }

        .alert-success strong {
            font-size: 15px;
        }

        .alert-success p {
            margin: 3px 0 0;
            font-size: 14px;
        }

        .alert-error-title {
            font-weight: 800;
            margin-bottom: 8px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
            font-size: 14px;
        }


        /* FORM CARD */

        .form-card {
            overflow: hidden;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow:
                0 10px 30px rgba(15, 23, 42, .07);
        }

        .form-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 25px 30px;
            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #115e59
                );
            color: white;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: rgba(255,255,255,.15);
            font-size: 25px;
        }

        .form-card-header h3 {
            margin: 0;
            font-size: 21px;
            font-weight: 800;
        }

        .form-card-header p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #ccfbf1;
        }


        /* FORM BODY */

        .form-body {
            padding: 32px;
        }


        /* SECTION */

        .section-title {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            margin-bottom: 22px;
        }

        .section-space {
            margin-top: 40px;
        }

        .section-number {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #ccfbf1;
            color: #0f766e;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 900;
        }

        .section-title h4 {
            margin: 0;
            font-size: 18px;
            color: #0f172a;
            font-weight: 800;
        }

        .section-title p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 14px;
        }


        /* GRID */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }

        .full-width {
            grid-column: 1 / -1;
        }


        /* FORM GROUP */

        .form-group {
            min-width: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 15px;
            font-weight: 750;
        }

        .form-group label span {
            color: #dc2626;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            min-height: 48px;
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background: #fff;
            color: #0f172a;
            font-size: 16px;
            outline: none;
            transition: .2s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15,118,110,.12);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .form-group small {
            display: block;
            margin-top: 7px;
            color: #64748b;
            font-size: 13px;
        }


        /* ERROR */

        .field-error {
            margin-top: 7px;
            color: #dc2626;
            font-size: 13px;
            font-weight: 600;
        }


        /* FILE UPLOAD */

        .file-upload {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 100px;
            padding: 15px;
            border: 2px dashed #cbd5e1;
            border-radius: 11px;
            background: #f8fafc;
            transition: .2s ease;
        }

        .file-upload:hover {
            border-color: #0f766e;
            background: #f0fdfa;
        }

        .upload-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #ccfbf1;
            color: #0f766e;
            border-radius: 10px;
            font-size: 23px;
            font-weight: 900;
        }

        .upload-content input[type="file"] {
            display: none;
        }

        .upload-content label {
            display: inline-block;
            margin: 0;
            padding: 8px 13px;
            background: #0f766e;
            color: white;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
        }

        .upload-content label:hover {
            background: #115e59;
        }

        .upload-content p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 12px;
        }


        /* PRICE */

        .price-input {
            display: flex;
            align-items: center;
            overflow: hidden;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
        }

        .price-input span {
            display: flex;
            align-items: center;
            justify-content: center;
            align-self: stretch;
            width: 45px;
            background: #f1f5f9;
            border-right: 1px solid #cbd5e1;
            color: #0f766e;
            font-size: 20px;
            font-weight: 800;
        }

        .price-input input {
            width: 100%;
            min-height: 48px;
            padding: 10px 14px;
            border: 0 !important;
            outline: none;
            font-size: 16px;
        }

        .price-input:focus-within {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15,118,110,.12);
        }


        /* STATUS */

        .status-box {
            padding: 18px;
            border: 1px solid #d1fae5;
            border-radius: 11px;
            background: #f0fdf4;
        }

        .status-toggle {
            display: flex !important;
            align-items: center;
            gap: 13px;
            margin: 0 !important;
            cursor: pointer;
        }

        .status-toggle input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .toggle {
            position: relative;
            width: 48px;
            height: 27px;
            flex-shrink: 0;
            border-radius: 30px;
            background: #cbd5e1;
            transition: .2s ease;
        }

        .toggle::after {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            width: 19px;
            height: 19px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,.2);
            transition: .2s ease;
        }

        .status-toggle input:checked + .toggle {
            background: #10b981;
        }

        .status-toggle input:checked + .toggle::after {
            transform: translateX(21px);
        }

        .status-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .status-text strong {
            color: #166534;
            font-size: 15px;
        }

        .status-text small {
            color: #64748b;
            font-size: 13px;
            font-weight: 400;
        }


        /* FOOTER */

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            padding: 22px 32px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .cancel-button,
        .save-button {
            min-height: 46px;
            padding: 11px 20px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: 750;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .cancel-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #cbd5e1;
            color: #475569;
        }

        .cancel-button:hover {
            background: #f1f5f9;
        }

        .save-button {
            border: 0;
            background: #0f766e;
            color: white;
            box-shadow: 0 4px 10px rgba(15,118,110,.2);
        }

        .save-button:hover {
            background: #115e59;
            transform: translateY(-1px);
        }

        .save-button span {
            margin-right: 6px;
        }


        /* INFO */

        .info-card {
            display: flex;
            gap: 13px;
            align-items: flex-start;
            margin-top: 20px;
            padding: 17px 20px;
            border: 1px solid #bae6fd;
            border-radius: 12px;
            background: #f0f9ff;
        }

        .info-icon {
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: #0284c7;
            color: white;
            font-weight: 800;
        }

        .info-card strong {
            color: #075985;
            font-size: 14px;
        }

        .info-card p {
            margin: 3px 0 0;
            color: #0369a1;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================================================
           MOBILE RESPONSIVE
        ========================================================== */

        @media (max-width: 768px) {

            .khatian-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .khatian-header h2 {
                font-size: 23px;
            }

            .khatian-header p {
                font-size: 14px;
            }

            .back-button {
                width: 100%;
            }

            .khatian-page {
                padding: 22px 12px 40px;
            }

            .form-card {
                border-radius: 12px;
            }

            .form-card-header {
                padding: 20px;
            }

            .form-card-header h3 {
                font-size: 18px;
            }

            .form-body {
                padding: 22px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .full-width {
                grid-column: auto;
            }

            .section-space {
                margin-top: 32px;
            }

            .section-title h4 {
                font-size: 17px;
            }

            .section-title p {
                font-size: 13px;
            }

            .form-group input[type="text"],
            .form-group input[type="number"],
            .form-group select {
                min-height: 50px;
                font-size: 16px;
            }

            .file-upload {
                align-items: flex-start;
            }

            .form-footer {
                flex-direction: column-reverse;
                padding: 18px;
            }

            .cancel-button,
            .save-button {
                width: 100%;
            }

            .info-card {
                padding: 15px;
            }
        }


        @media (max-width: 480px) {

            .breadcrumb {
                font-size: 12px;
            }

            .khatian-header h2 {
                font-size: 21px;
            }

            .form-card-header {
                gap: 12px;
            }

            .header-icon {
                width: 43px;
                height: 43px;
                font-size: 21px;
            }

            .form-body {
                padding: 20px 14px;
            }

            .section-title {
                gap: 10px;
            }

            .section-number {
                width: 32px;
                height: 32px;
                font-size: 11px;
            }

            .section-title h4 {
                font-size: 16px;
            }

            .upload-icon {
                width: 38px;
                height: 38px;
            }

            .upload-content p {
                line-height: 1.5;
            }

        }

    </style>


    {{-- =========================================================
         FILE NAME PREVIEW
    ========================================================== --}}
    <script>

        const pdfInput = document.getElementById('pdf');

        if (pdfInput) {

            pdfInput.addEventListener('change', function () {

                const file = this.files[0];

                if (!file) {
                    return;
                }

                const uploadText = this
                    .closest('.file-upload')
                    .querySelector('.upload-content p');

                if (uploadText) {

                    uploadText.textContent =
                        file.name + ' · ' +
                        (file.size / 1024 / 1024).toFixed(2) +
                        ' MB';

                }

            });

        }

    </script>

</x-app-layout>
