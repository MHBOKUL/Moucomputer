<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Map - Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        select,
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            background: #fff;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        .help {
            margin-top: 6px;
            color: #6b7280;
            font-size: 13px;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .mouza-info {
            margin-top: 10px;
            padding: 12px 14px;
            background: #f3f4f6;
            border-radius: 7px;
            display: none;
            font-size: 14px;
        }

        .mouza-info strong {
            color: #111827;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .checkbox input {
            width: 17px;
            height: 17px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
            background: #fee2e2;
            color: #991b1b;
        }

        .file-note {
            margin-top: 8px;
            font-size: 13px;
            color: #6b7280;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px auto;
            }

            .card {
                padding: 20px;
            }

            .actions {
                flex-direction: column;
            }

            .actions .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Add Map</h1>

        <div class="subtitle">
            Upload and manage Mouza map PDF information
        </div>

        @if($errors->any())
            <div class="alert">
                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.maps.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            {{-- Mouza --}}
            <div class="form-group">

                <label for="mouza_id">
                    Mouza <span style="color:red">*</span>
                </label>

                <select
                    name="mouza_id"
                    id="mouza_id"
                    required
                >

                    <option value="">
                        Select Mouza
                    </option>

                    @foreach($mouzas as $mouza)

                        <option
                            value="{{ $mouza->id }}"
                            data-survey="{{ $mouza->surveyType->name ?? '-' }}"
                            data-survey-bn="{{ $mouza->surveyType->name_bn ?? '' }}"
                            data-upazila="{{ $mouza->upazila->name ?? '-' }}"
                            data-district="{{ $mouza->upazila->district->name ?? '-' }}"
                            data-division="{{ $mouza->upazila->district->division->name ?? '-' }}"
                            {{ old('mouza_id') == $mouza->id ? 'selected' : '' }}
                        >

                            {{ $mouza->name }}

                            @if($mouza->name_bn)
                                — {{ $mouza->name_bn }}
                            @endif

                        </option>

                    @endforeach

                </select>

                <div class="mouza-info" id="mouzaInfo">
                    <div>
                        <strong>Division:</strong>
                        <span id="divisionName">-</span>
                    </div>

                    <div>
                        <strong>District:</strong>
                        <span id="districtName">-</span>
                    </div>

                    <div>
                        <strong>Upazila:</strong>
                        <span id="upazilaName">-</span>
                    </div>

                    <div>
                        <strong>Survey Type:</strong>
                        <span id="surveyName">-</span>
                    </div>
                </div>

                @error('mouza_id')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Title --}}
            <div class="form-group">

                <label for="title">
                    Map Title <span style="color:red">*</span>
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    placeholder="Example: Barol Mouza Map"
                    required
                >

                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- PDF --}}
            <div class="form-group">

                <label for="map_file">
                    Map PDF <span style="color:red">*</span>
                </label>

                <input
                    type="file"
                    name="map_file"
                    id="map_file"
                    accept=".pdf,application/pdf"
                    required
                >

                <div class="file-note">
                    Only PDF files are allowed. Maximum size: 50 MB.
                </div>

                @error('map_file')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Price --}}
            <div class="form-group">

                <label for="price">
                    Price (BDT) <span style="color:red">*</span>
                </label>

                <input
                    type="number"
                    name="price"
                    id="price"
                    value="{{ old('price', 0) }}"
                    min="0"
                    step="0.01"
                    placeholder="Example: 500"
                    required
                >

                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Active --}}
            <div class="form-group">

                <label class="checkbox">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                    >

                    <span>Active</span>

                </label>

            </div>


            {{-- Buttons --}}
            <div class="actions">

                <a
                    href="{{ route('admin.maps.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Map
                </button>

            </div>

        </form>

    </div>

</div>


<script>

    const mouzaSelect = document.getElementById('mouza_id');

    const mouzaInfo = document.getElementById('mouzaInfo');

    const divisionName = document.getElementById('divisionName');
    const districtName = document.getElementById('districtName');
    const upazilaName = document.getElementById('upazilaName');
    const surveyName = document.getElementById('surveyName');


    function updateMouzaInfo() {

        const selected =
            mouzaSelect.options[mouzaSelect.selectedIndex];


        if (!selected || !selected.value) {

            mouzaInfo.style.display = 'none';

            return;
        }


        divisionName.textContent =
            selected.dataset.division || '-';

        districtName.textContent =
            selected.dataset.district || '-';

        upazilaName.textContent =
            selected.dataset.upazila || '-';

        surveyName.textContent =
            selected.dataset.survey || '-';


        mouzaInfo.style.display = 'block';
    }


    mouzaSelect.addEventListener(
        'change',
        updateMouzaInfo
    );


    updateMouzaInfo();

</script>

</body>
</html>