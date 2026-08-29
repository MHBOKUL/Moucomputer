<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $map->title }} - Map</title>

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
            max-width: 900px;
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

        .row {
            display: grid;
            grid-template-columns: 180px 1fr;
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .label {
            font-weight: bold;
            color: #6b7280;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 17px;
            border-radius: 7px;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        @media(max-width:600px) {

            .row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .actions {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>{{ $map->title }}</h1>


        <div class="row">

            <div class="label">
                Division
            </div>

            <div>
                {{ $map->mouza->upazila->district->division->name ?? '-' }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                District
            </div>

            <div>
                {{ $map->mouza->upazila->district->name ?? '-' }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                Upazila
            </div>

            <div>
                {{ $map->mouza->upazila->name ?? '-' }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                Mouza
            </div>

            <div>
                {{ $map->mouza->name ?? '-' }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                Survey Type
            </div>

            <div>
                {{ $map->mouza->surveyType->name ?? '-' }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                File Name
            </div>

            <div>
                {{ $map->file_name ?? '-' }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                Price
            </div>

            <div>
                ৳{{ number_format($map->price, 2) }}
            </div>

        </div>


        <div class="row">

            <div class="label">
                Status
            </div>

            <div>

                @if($map->is_active)

                    <span class="badge active">
                        Active
                    </span>

                @else

                    <span class="badge inactive">
                        Inactive
                    </span>

                @endif

            </div>

        </div>


        <div class="actions">

            <a href="{{ route('admin.maps.download', $map) }}"
               class="btn btn-success">
                Download PDF
            </a>


            <a href="{{ asset('storage/' . $map->file_path) }}"
               target="_blank"
               class="btn btn-primary">
                View PDF
            </a>


            <a href="{{ route('admin.maps.edit', $map) }}"
               class="btn btn-secondary">
                Edit
            </a>


            <form action="{{ route('admin.maps.destroy', $map) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this map?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger">
                    Delete
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>