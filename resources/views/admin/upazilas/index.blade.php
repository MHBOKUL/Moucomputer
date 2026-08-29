<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Upazilas - Admin</title>

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
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
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

    .btn-edit {
        background: #f59e0b;
        color: white;
    }

    .btn-delete {
        background: #dc2626;
        color: white;
    }

    .btn-delete:hover {
        background: #b91c1c;
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

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background: #f9fafb;
        font-size: 13px;
        text-transform: uppercase;
        color: #6b7280;
    }

    td {
        font-size: 14px;
    }

    tr:last-child td {
        border-bottom: none;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .empty {
        text-align: center;
        padding: 40px;
        color: #6b7280;
    }

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 12px;
        background: #dcfce7;
        color: #166534;
    }

    .breadcrumb {
        margin-bottom: 20px;
        color: #6b7280;
        font-size: 14px;
    }

    .breadcrumb a {
        color: #2563eb;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {

        .header {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-left {
            width: 100%;
        }

        .header-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .table-card {
            overflow-x: auto;
        }

        table {
            min-width: 850px;
        }
    }
</style>

</head>

<body>

<div class="container">

{{-- Breadcrumb --}}
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    /
    <strong>Upazilas</strong>
</div>


{{-- Header --}}
<div class="header">

    <div class="header-left">

        <div>
            <h1>Upazilas</h1>

            <div class="subtitle">
                Manage Bangladesh Upazila information
            </div>
        </div>

    </div>


    <div class="header-actions">

        {{-- Back to Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-secondary">
            ← Dashboard
        </a>

        {{-- Add Upazila --}}
        <a href="{{ route('admin.upazilas.create') }}"
           class="btn btn-primary">
            + Add Upazila
        </a>

    </div>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="alert">
        {{ session('success') }}
    </div>

@endif


{{-- Validation Errors --}}
@if($errors->any())

    <div class="alert"
         style="background:#fee2e2; color:#991b1b;">

        <strong>Please fix the following errors:</strong>

        <ul style="margin-bottom:0;">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- Upazila Table --}}
<div class="table-card">

    @if($upazilas->count())

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila Name</th>
                    <th>বাংলা নাম</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

            @foreach($upazilas as $upazila)

                <tr>

                    {{-- Serial --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>


                    {{-- Division --}}
                    <td>

                        @if($upazila->district && $upazila->district->division)

                            {{ $upazila->district->division->name }}

                            @if($upazila->district->division->name_bn)
                                <br>
                                <small style="color:#6b7280;">
                                    {{ $upazila->district->division->name_bn }}
                                </small>
                            @endif

                        @else

                            -

                        @endif

                    </td>


                    {{-- District --}}
                    <td>

                        @if($upazila->district)

                            {{ $upazila->district->name }}

                            @if($upazila->district->name_bn)
                                <br>
                                <small style="color:#6b7280;">
                                    {{ $upazila->district->name_bn }}
                                </small>
                            @endif

                        @else

                            -

                        @endif

                    </td>


                    {{-- Upazila Name --}}
                    <td>
                        <strong>
                            {{ $upazila->name }}
                        </strong>
                    </td>


                    {{-- Bangla Name --}}
                    <td>
                        {{ $upazila->name_bn ?? '-' }}
                    </td>


                    {{-- Actions --}}
                    <td>

                        <div class="actions">

                            {{-- View --}}
                            <a href="{{ route('admin.upazilas.show', $upazila) }}"
                               class="btn btn-primary">
                                View
                            </a>


                            {{-- Edit --}}
                            <a href="{{ route('admin.upazilas.edit', $upazila) }}"
                               class="btn btn-edit">
                                Edit
                            </a>


                            {{-- Delete --}}
                            <form
                                action="{{ route('admin.upazilas.destroy', $upazila) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this Upazila?');"
                            >

                                @csrf

                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-delete">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    @else

        {{-- Empty State --}}
        <div class="empty">

            <h3>No Upazila Found</h3>

            <p>
                You haven't added any Upazila yet.
            </p>

            <a href="{{ route('admin.upazilas.create') }}"
               class="btn btn-primary">
                + Add Your First Upazila
            </a>

        </div>

    @endif

</div>

</div>

</body>
</html>
