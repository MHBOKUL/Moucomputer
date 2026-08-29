<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mouza Details - Admin</title>

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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        .subtitle {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .row {
            display: grid;
            grid-template-columns: 200px 1fr;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #6b7280;
        }

        .value {
            color: #111827;
        }

        .bangla {
            font-size: 17px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #dcfce7;
            color: #166534;
        }

        .actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
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
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        @media (max-width: 600px) {
            .header {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 6px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Mouza Details</h1>

            <div class="subtitle">
                View Mouza information
            </div>
        </div>

        <a href="{{ route('admin.mouzas.index') }}"
           class="btn btn-secondary">
            ← Back
        </a>
    </div>


    <div class="card">

        <div class="row">
            <div class="label">
                Division
            </div>

            <div class="value">
                {{ $mouza->upazila->district->division->name ?? '-' }}

                @if($mouza->upazila->district->division->name_bn ?? false)
                    — {{ $mouza->upazila->district->division->name_bn }}
                @endif
            </div>
        </div>


        <div class="row">
            <div class="label">
                District
            </div>

            <div class="value">
                {{ $mouza->upazila->district->name ?? '-' }}

                @if($mouza->upazila->district->name_bn ?? false)
                    — {{ $mouza->upazila->district->name_bn }}
                @endif
            </div>
        </div>


        <div class="row">
            <div class="label">
                Upazila
            </div>

            <div class="value">
                {{ $mouza->upazila->name ?? '-' }}

                @if($mouza->upazila->name_bn ?? false)
                    — {{ $mouza->upazila->name_bn }}
                @endif
            </div>
        </div>


        <div class="row">
            <div class="label">
                Mouza Name
            </div>

            <div class="value">
                {{ $mouza->name }}
            </div>
        </div>


        <div class="row">
            <div class="label">
                বাংলা নাম
            </div>

            <div class="value bangla">
                {{ $mouza->name_bn ?? '-' }}
            </div>
        </div>


        <div class="row">
            <div class="label">
                JL Number
            </div>

            <div class="value">
                {{ $mouza->jl_number ?? '-' }}
            </div>
        </div>


        <div class="row">
            <div class="label">
                Survey Type
            </div>

            <div class="value">
                {{ $mouza->surveyType->name ?? '-' }}
            </div>
        </div>


        <div class="row">
            <div class="label">
                Status
            </div>

            <div class="value">
                @if($mouza->is_active)
                    <span class="badge">Active</span>
                @else
                    <span class="badge"
                          style="background:#fee2e2;color:#991b1b;">
                        Inactive
                    </span>
                @endif
            </div>
        </div>


        <div class="row">
            <div class="label">
                Created At
            </div>

            <div class="value">
                {{ $mouza->created_at?->format('d M Y, h:i A') }}
            </div>
        </div>


        <div class="row">
            <div class="label">
                Updated At
            </div>

            <div class="value">
                {{ $mouza->updated_at?->format('d M Y, h:i A') }}
            </div>
        </div>


        <div class="actions">

            <a href="{{ route('admin.mouzas.edit', $mouza) }}"
               class="btn btn-primary">
                Edit Mouza
            </a>


            <form action="{{ route('admin.mouzas.destroy', $mouza) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this Mouza?');">

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