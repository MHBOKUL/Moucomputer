<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mouzas - Admin</title>

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
            max-width: 1400px;
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

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
        }

        .btn-view {
            background: #6b7280;
            color: white;
        }

        .btn-delete {
            background: #dc2626;
            color: white;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
        }

        .table-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        th,
        td {
            padding: 14px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f9fafb;
            font-size: 12px;
            text-transform: uppercase;
            color: #6b7280;
            white-space: nowrap;
        }

        td {
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #6b7280;
        }

        .location {
            line-height: 1.5;
        }

        .location-main {
            font-weight: 600;
        }

        .location-sub {
            color: #6b7280;
            font-size: 12px;
        }

        form {
            margin: 0;
        }

        @media (max-width: 768px) {
            .header {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .container {
                margin: 20px auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    {{-- Header --}}
    <div class="header">

        <div>
            <h1>Mouzas</h1>

            <div class="subtitle">
                Manage Bangladesh Mouza information
            </div>
        </div>

        <a
            href="{{ route('admin.mouzas.create') }}"
            class="btn btn-primary"
        >
            + Add Mouza
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif


    {{-- Table --}}
    <div class="table-card">

        @if($mouzas->count())

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Upazila</th>
                            <th>Survey Type</th>
                            <th>Mouza Name</th>
                            <th>বাংলা নাম</th>
                            <th>JL Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    @foreach($mouzas as $mouza)

                        <tr>

                            {{-- Serial --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- Division --}}
                            <td>

                                <div class="location">

                                    <div class="location-main">
                                        {{ $mouza->upazila->district->division->name ?? '-' }}
                                    </div>

                                    @if($mouza->upazila->district->division->name_bn ?? null)

                                        <div class="location-sub">
                                            {{ $mouza->upazila->district->division->name_bn }}
                                        </div>

                                    @endif

                                </div>

                            </td>


                            {{-- District --}}
                            <td>

                                <div class="location">

                                    <div class="location-main">
                                        {{ $mouza->upazila->district->name ?? '-' }}
                                    </div>

                                    @if($mouza->upazila->district->name_bn ?? null)

                                        <div class="location-sub">
                                            {{ $mouza->upazila->district->name_bn }}
                                        </div>

                                    @endif

                                </div>

                            </td>


                            {{-- Upazila --}}
                            <td>

                                <div class="location">

                                    <div class="location-main">
                                        {{ $mouza->upazila->name ?? '-' }}
                                    </div>

                                    @if($mouza->upazila->name_bn ?? null)

                                        <div class="location-sub">
                                            {{ $mouza->upazila->name_bn }}
                                        </div>

                                    @endif

                                </div>

                            </td>


                            {{-- Survey Type --}}
                            <td>

                                {{ $mouza->surveyType->name ?? '-' }}

                                @if($mouza->surveyType->name_bn ?? null)

                                    <div class="location-sub">
                                        {{ $mouza->surveyType->name_bn }}
                                    </div>

                                @endif

                            </td>


                            {{-- Mouza Name --}}
                            <td>
                                <strong>
                                    {{ $mouza->name }}
                                </strong>
                            </td>


                            {{-- Bangla Name --}}
                            <td>
                                {{ $mouza->name_bn ?? '-' }}
                            </td>


                            {{-- JL Number --}}
                            <td>
                                {{ $mouza->jl_number ?? '-' }}
                            </td>


                            {{-- Status --}}
                            <td>

                                @if($mouza->is_active)

                                    <span class="badge badge-active">
                                        Active
                                    </span>

                                @else

                                    <span class="badge badge-inactive">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="actions">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.mouzas.show', $mouza) }}"
                                        class="btn btn-view"
                                    >
                                        View
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.mouzas.edit', $mouza) }}"
                                        class="btn btn-edit"
                                    >
                                        Edit
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.mouzas.destroy', $mouza) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Mouza?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                <h3>No Mouza Found</h3>

                <p>
                    You haven't added any Mouza yet.
                </p>

                <a
                    href="{{ route('admin.mouzas.create') }}"
                    class="btn btn-primary"
                >
                    + Add Your First Mouza
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>