<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Edit Upazila - Admin</title>

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
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    h1 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .subtitle {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 25px;
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

    .required {
        color: #dc2626;
    }

    input,
    select {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
        background: white;
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
        border: none;
        cursor: pointer;
        text-decoration: none;
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
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .current-info {
        background: #f3f4f6;
        padding: 12px 14px;
        border-radius: 7px;
        margin-bottom: 25px;
        font-size: 14px;
    }

    @media (max-width: 600px) {
        .container {
            margin: 20px auto;
        }

        .card {
            padding: 20px;
        }

        .buttons {
            flex-direction: column;
        }

        .btn {
            text-align: center;
            width: 100%;
        }
    }
</style>


</head>

<body>

<div class="container">


<div class="card">

    <h1>Edit Upazila</h1>

    <div class="subtitle">
        Update Upazila information
    </div>


    {{-- Current Information --}}
    <div class="current-info">

        <strong>Current Upazila:</strong>

        {{ $upazila->name }}

        @if($upazila->name_bn)
            — {{ $upazila->name_bn }}
        @endif

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="error"
             style="background:#fee2e2; padding:12px; border-radius:7px; margin-bottom:20px;">

            <strong>Please fix the following:</strong>

            <ul style="margin:8px 0 0 20px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Edit Form --}}
    <form
        action="{{ route('admin.upazilas.update', $upazila) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        {{-- District --}}
        <div class="form-group">

            <label for="district_id">
                District <span class="required">*</span>
            </label>

            <select
                name="district_id"
                id="district_id"
                required
            >

                <option value="">
                    Select District
                </option>

                @foreach($districts as $district)

                    <option
                        value="{{ $district->id }}"
                        {{ old('district_id', $upazila->district_id) == $district->id ? 'selected' : '' }}
                    >

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
                value="{{ old('name', $upazila->name) }}"
                placeholder="Example: Savar"
                required
            >

            @error('name')

                <div class="error">
                    {{ $message }}
                </div>

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
                value="{{ old('name_bn', $upazila->name_bn) }}"
                placeholder="উদাহরণ: সাভার"
            >

            @error('name_bn')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Buttons --}}
        <div class="buttons">

            <a
                href="{{ route('admin.upazilas.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Upazila
            </button>

        </div>

    </form>

</div>

</div>

</body>
</html>
