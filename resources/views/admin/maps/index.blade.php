<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maps - Admin</title>

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
            max-width: 1300px;
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
            font-size: 14px;
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

        table {
            width: 100%;
            border-collapse: collapse;
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

        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #6b7280;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
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

        .file {
            color: #2563eb;
            text-decoration: none;
        }

        .price {
            font-weight: bold;
        }

        @media (max-width: 900px) {

            .header {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 1100px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>Maps</h1>

            <div class="subtitle">
                Manage Mouza maps and downloadable files
            </div>
        </div>

        <a href="{{ route('admin.maps.create') }}"
           class="btn btn-primary">
            + Add Map
        </a>

    </div>


    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif


    <div class="table-card">

        @if($maps->count())

            <table>

                <thead>

                <tr>
                    <th>#</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Mouza</th>
                    <th>Survey</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>

                </thead>

                <tbody>

                @foreach($maps as $map)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>
                            {{ $map->mouza->upazila->district->division->name ?? '-' }}
                        </td>


                        <td>
                            {{ $map->mouza->upazila->district->name ?? '-' }}
                        </td>


                        <td>
                            {{ $map->mouza->upazila->name ?? '-' }}
                        </td>


                        <td>
                            {{ $map->mouza->name ?? '-' }}
                        </td>


                        <td>
                            {{ $map->mouza->surveyType->name ?? '-' }}
                        </td>


                        <td>
                            {{ $map->title }}
                        </td>


                        <td class="price">
                            ৳{{ number_format($map->price, 2) }}
                        </td>


                        <td>

                            @if($map->is_active)

                                <span class="badge active">
                                    Active
                                </span>

                            @else

                                <span class="badge inactive">
                                    Inactive
                                </span>

                            @endif

                        </td>


                        <td>

                            @if($map->file_path)

                                <a href="{{ asset('storage/' . $map->file_path) }}"
                                   target="_blank"
                                   class="file">
                                    View File
                                </a>

                            @else

                                -

                            @endif

                        </td>


                        <td>

                            <div class="actions">

                                <a href="{{ route('admin.maps.show', $map) }}"
                                   class="btn btn-primary">
                                    View
                                </a>


                                <a href="{{ route('admin.maps.edit', $map) }}"
                                   class="btn btn-edit">
                                    Edit
                                </a>


                                <form action="{{ route('admin.maps.destroy', $map) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this map?');">

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

            <div class="empty">

                <h3>No Maps Found</h3>

                <p>
                    You haven't added any map yet.
                </p>

                <a href="{{ route('admin.maps.create') }}"
                   class="btn btn-primary">
                    + Add Your First Map
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>