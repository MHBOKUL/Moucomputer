<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Upazila - Admin</title>

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
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 28px;
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

        input,
        select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
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

        .required {
            color: #dc2626;
        }

        .division-name {
            color: #6b7280;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px auto;
            }

            .card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Add Upazila</h1>

        <div class="subtitle">
            Add a new Upazila under a District
        </div>

        <form action="{{ route('admin.upazilas.store') }}" method="POST">

            @csrf

            {{-- District --}}
            <div class="form-group">

                <label for="district_id">
                    District <span class="required">*</span>
                </label>

                <select name="district_id"
                        id="district_id"
                        required>

                    <option value="">
                        Select District
                    </option>

                    @foreach($districts as $district)

                        <option value="{{ $district->id }}"
                            {{ old('district_id') == $district->id ? 'selected' : '' }}>

                            {{ $district->name }}

                            @if($district->name_bn)
                                — {{ $district->name_bn }}
                            @endif

                            @if($district->division)
                                ({{ $district->division->name }})
                            @endif

                        </option>

                    @endforeach

                </select>

                @error('district_id')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Upazila Name --}}
            <div class="form-group">

                <label for="name">
                    Upazila Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    placeholder="Enter Upazila name"
                    required
                >

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Bengali Name --}}
            <div class="form-group">

                <label for="name_bn">
                    বাংলা নাম
                </label>

                <input
                    type="text"
                    name="name_bn"
                    id="name_bn"
                    value="{{ old('name_bn') }}"
                    placeholder="উপজেলার বাংলা নাম"
                >

                @error('name_bn')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Buttons --}}
            <div class="buttons">

                <a href="{{ route('admin.upazilas.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Save Upazila
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>