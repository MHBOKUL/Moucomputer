<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Map</title>

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
            max-width: 750px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,.07);
        }

        h1 {
            margin-top: 0;
        }

        .group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
        }

        .info {
            background: #f3f4f6;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 17px;
            border: 0;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-download {
            background: #16a34a;
            color: white;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox input {
            width: auto;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Map</h1>

        <div class="info">
            <strong>Current File:</strong>
            {{ $map->file_name ?? 'No file' }}
        </div>

        <form action="{{ route('admin.maps.update', $map) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="group">

                <label>Mouza</label>

                <select name="mouza_id" required>

                    @foreach($mouzas as $mouza)

                        <option value="{{ $mouza->id }}"
                            {{ $map->mouza_id == $mouza->id ? 'selected' : '' }}>

                            {{ $mouza->upazila->district->division->name ?? '-' }}
                            /
                            {{ $mouza->upazila->district->name ?? '-' }}
                            /
                            {{ $mouza->upazila->name ?? '-' }}
                            /
                            {{ $mouza->name }}

                            -
                            {{ $mouza->surveyType->name ?? '-' }}

                        </option>

                    @endforeach

                </select>

                @error('mouza_id')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="group">

                <label>Map Title</label>

                <input type="text"
                       name="title"
                       value="{{ old('title', $map->title) }}"
                       required>

                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="group">

                <label>Replace PDF (Optional)</label>

                <input type="file"
                       name="file"
                       accept="application/pdf">

                <small>
                    Leave empty if you don't want to replace the current PDF.
                </small>

                @error('file')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="group">

                <label>Price</label>

                <input type="number"
                       name="price"
                       step="0.01"
                       min="0"
                       value="{{ old('price', $map->price) }}"
                       required>

                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="group checkbox">

                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', $map->is_active) ? 'checked' : '' }}>

                <label style="margin:0;">
                    Active
                </label>

            </div>


            <div class="actions">

                <button type="submit"
                        class="btn btn-primary">
                    Update Map
                </button>

                <a href="{{ route('admin.maps.show', $map) }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>