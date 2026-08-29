<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upazila Details - Admin</title>

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
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .header {
            padding: 25px 30px;
            border-bottom: 1px solid #e5e7eb;
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

        .details {
            padding: 30px;
        }

        .row {
            display: flex;
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            width: 180px;
            font-weight: 600;
            color: #6b7280;
        }

        .value {
            flex: 1;
            font-weight: 500;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
        }

        .actions {
            padding: 20px 30px;
            background: #f9fafb;
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

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        @media (max-width: 600px) {

            .container {
                margin: 20px auto;
            }

            .details {
                padding: 20px;
            }

            .row {
                flex-direction: column;
                gap: 6px;
            }

            .label {
                width: 100%;
            }

            .actions {
                padding: 20px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="header">

            <h1>Upazila Details</h1>

            <div class="subtitle">
                View complete information about this Upazila
            </div>

        </div>


        <div class="details">

            {{-- ID --}}
            <div class="row">

                <div class="label">
                    ID
                </div>

                <div class="value">
                    {{ $upazila->id }}
                </div>

            </div>


            {{-- Division --}}
            <div class="row">

                <div class="label">
                    Division
                </div>

                <div class="value">

                    {{ $upazila->district->division->name ?? '-' }}

                    @if($upazila->district?->division?->name_bn)
                        — {{ $upazila->district->division->name_bn }}
                    @endif

                </div>

            </div>


            {{-- District --}}
            <div class="row">

                <div class="label">
                    District
                </div>

                <div class="value">

                    {{ $upazila->district->name ?? '-' }}

                    @if($upazila->district?->name_bn)
                        — {{ $upazila->district->name_bn }}
                    @endif

                </div>

            </div>


            {{-- Upazila --}}
            <div class="row">

                <div class="label">
                    Upazila Name
                </div>

                <div class="value">
                    {{ $upazila->name }}
                </div>

            </div>


            {{-- Bengali Name --}}
            <div class="row">

                <div class="label">
                    বাংলা নাম
                </div>

                <div class="value">
                    {{ $upazila->name_bn ?? '-' }}
                </div>

            </div>


            {{-- Created --}}
            <div class="row">

                <div class="label">
                    Created
                </div>

                <div class="value">
                    {{ $upazila->created_at?->format('d M Y, h:i A') ?? '-' }}
                </div>

            </div>


            {{-- Updated --}}
            <div class="row">

                <div class="label">
                    Last Updated
                </div>

                <div class="value">
                    {{ $upazila->updated_at?->format('d M Y, h:i A') ?? '-' }}
                </div>

            </div>

        </div>


        <div class="actions">

            <a href="{{ route('admin.upazilas.index') }}"
               class="btn btn-secondary">
                ← Back
            </a>

            <a href="{{ route('admin.upazilas.edit', $upazila) }}"
               class="btn btn-primary">
                Edit
            </a>

            <form action="{{ route('admin.upazilas.destroy', $upazila) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this Upazila?');">

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