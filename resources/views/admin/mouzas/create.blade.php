<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Mouza - Admin</title>

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
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 28px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox input {
            width: 16px;
            height: 16px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 28px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 7px;
            border: none;
            text-decoration: none;
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

        .location-info {
            margin-top: 6px;
            color: #6b7280;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px auto;
            }

            .card {
                padding: 20px;
            }

            .actions {
                flex-direction: column-reverse;
                gap: 12px;
                align-items: stretch;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Add Mouza</h1>

        <div class="subtitle">
            Add a new Mouza under an Upazila
        </div>

        <form action="{{ route('admin.mouzas.store') }}" method="POST">

            @csrf


            {{-- Upazila --}}
            <div class="form-group">

                <label for="upazila_id">
                    Upazila <span style="color:red;">*</span>
                </label>

                <select name="upazila_id" id="upazila_id" required>

                    <option value="">
                        Select Upazila
                    </option>

                    @foreach($upazilas as $upazila)

                        <option
                            value="{{ $upazila->id }}"
                            {{ old('upazila_id') == $upazila->id ? 'selected' : '' }}
                        >
                            {{ $upazila->name }}

                            @if($upazila->name_bn)
                                — {{ $upazila->name_bn }}
                            @endif

                            — {{ $upazila->district->name ?? '' }}

                            @if($upazila->district?->division)
                                — {{ $upazila->district->division->name }}
                            @endif
                        </option>

                    @endforeach

                </select>

                @error('upazila_id')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="location-info">
                    Division → District → Upazila
                </div>

            </div>


            {{-- Survey Type --}}
            <div class="form-group">

                <label for="survey_type_id">
                    Survey Type <span style="color:red;">*</span>
                </label>

                <select name="survey_type_id" id="survey_type_id" required>

                    <option value="">
                        Select Survey Type
                    </option>

                    @foreach($surveyTypes as $surveyType)

                        <option
                            value="{{ $surveyType->id }}"
                            {{ old('survey_type_id') == $surveyType->id ? 'selected' : '' }}
                        >
                            {{ $surveyType->name }}

                            @if(!empty($surveyType->name_bn))
                                — {{ $surveyType->name_bn }}
                            @endif
                        </option>

                    @endforeach

                </select>

                @error('survey_type_id')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Mouza Name --}}
            <div class="form-group">

                <label for="name">
                    Mouza Name <span style="color:red;">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    placeholder="Enter Mouza name"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Bangla Name --}}
            <div class="form-group">

                <label for="name_bn">
                    বাংলা নাম
                </label>

                <input
                    type="text"
                    name="name_bn"
                    id="name_bn"
                    value="{{ old('name_bn') }}"
                    placeholder="মৌজার বাংলা নাম"
                >

                @error('name_bn')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- JL Number --}}
            <div class="form-group">

                <label for="jl_number">
                    JL Number
                </label>

                <input
                    type="text"
                    name="jl_number"
                    id="jl_number"
                    value="{{ old('jl_number') }}"
                    placeholder="Enter JL Number"
                >

                @error('jl_number')
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


            {{-- Actions --}}
            <div class="actions">

                <a
                    href="{{ route('admin.mouzas.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Mouza
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>