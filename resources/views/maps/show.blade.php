<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $map->title }} | MoujaMap</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        a {
            text-decoration: none;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 0;
        }

        .navbar-inner {
            max-width: 1100px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
        }

        .brand span {
            color: #2563eb;
        }

        .back-btn {
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
        }

        .back-btn:hover {
            color: #2563eb;
        }

        .container {
            max-width: 1100px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .breadcrumb {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .breadcrumb a {
            color: #2563eb;
        }

        .page-header h1 {
            margin: 0;
            font-size: 32px;
            line-height: 1.25;
            color: #111827;
        }

        .page-header p {
            margin-top: 10px;
            color: #6b7280;
            font-size: 15px;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 25px;
            align-items: start;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            padding: 22px 25px;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-header h2 {
            margin: 0;
            font-size: 19px;
            color: #111827;
        }

        .card-header p {
            margin: 6px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .details {
            padding: 10px 25px 20px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 20px;
            padding: 17px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .label {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
        }

        .value {
            color: #111827;
            font-size: 14px;
            font-weight: 600;
        }

        .status {
            display: inline-flex;
            align-items: center;
            padding: 6px 11px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 700;
        }

        .file-name {
            word-break: break-word;
        }

        .order-card {
            overflow: hidden;
            position: sticky;
            top: 25px;
        }

        .order-header {
            padding: 25px;
            background: #111827;
            color: #ffffff;
        }

        .order-header p {
            margin: 0 0 7px;
            font-size: 13px;
            color: #d1d5db;
        }

        .price {
            font-size: 34px;
            font-weight: 800;
        }

        .order-body {
            padding: 25px;
        }

        .order-description {
            margin: 0 0 20px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
        }

        .order-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px 18px;
            border-radius: 11px;
            background: #2563eb;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .order-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .secure-box {
            margin-top: 18px;
            padding: 14px;
            border-radius: 10px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .map-id {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            font-size: 13px;
        }

        .map-id span:first-child {
            color: #6b7280;
        }

        .map-id span:last-child {
            font-weight: 700;
            color: #111827;
        }

        .footer {
            margin-top: 45px;
            padding: 25px 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #9ca3af;
            font-size: 13px;
        }

        @media (max-width: 800px) {

            .layout {
                grid-template-columns: 1fr;
            }

            .order-card {
                position: static;
            }

            .page-header h1 {
                font-size: 26px;
            }
        }

        @media (max-width: 600px) {

            .container {
                margin: 30px auto;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .navbar-inner {
                padding: 0 15px;
            }

            .brand {
                font-size: 20px;
            }

            .back-btn {
                font-size: 13px;
            }

            .card-header,
            .details,
            .order-header,
            .order-body {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
</head>

<body>

    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <nav class="navbar">

        <div class="navbar-inner">

            <a href="{{ route('home') }}" class="brand">
                Mouja<span>Map</span>
            </a>

            <a href="{{ route('home') }}" class="back-btn">
                ← Back to Home
            </a>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ========================================================= --}}

    <main class="container">

        {{-- Page Header --}}

        <div class="page-header">

            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                &nbsp;/&nbsp;
                Map Details
            </div>

            <h1>
                {{ $map->title }}
            </h1>

            <p>
                Detailed information about this Mouza map.
            </p>

        </div>


        <div class="layout">

            {{-- ================================================= --}}
            {{-- MAP INFORMATION --}}
            {{-- ================================================= --}}

            <div class="card">

                <div class="card-header">

                    <h2>
                        Map Information
                    </h2>

                    <p>
                        Location and document information
                    </p>

                </div>


                <div class="details">

                    {{-- Division --}}

                    <div class="detail-row">

                        <div class="label">
                            Division
                        </div>

                        <div class="value">

                            {{
                                $map->mouza?->upazila?->district?->division?->name_bn
                                ?? $map->mouza?->upazila?->district?->division?->name
                                ?? 'N/A'
                            }}

                        </div>

                    </div>


                    {{-- District --}}

                    <div class="detail-row">

                        <div class="label">
                            District
                        </div>

                        <div class="value">

                            {{
                                $map->mouza?->upazila?->district?->name_bn
                                ?? $map->mouza?->upazila?->district?->name
                                ?? 'N/A'
                            }}

                        </div>

                    </div>


                    {{-- Upazila --}}

                    <div class="detail-row">

                        <div class="label">
                            Upazila
                        </div>

                        <div class="value">

                            {{
                                $map->mouza?->upazila?->name_bn
                                ?? $map->mouza?->upazila?->name
                                ?? 'N/A'
                            }}

                        </div>

                    </div>


                    {{-- Mouza --}}

                    <div class="detail-row">

                        <div class="label">
                            Mouza
                        </div>

                        <div class="value">

                            {{
                                $map->mouza?->name_bn
                                ?? $map->mouza?->name
                                ?? 'N/A'
                            }}

                        </div>

                    </div>


                    {{-- Survey Type --}}

                    <div class="detail-row">

                        <div class="label">
                            Survey Type
                        </div>

                        <div class="value">

                            {{
                                $map->mouza?->surveyType?->name_bn
                                ?? $map->mouza?->surveyType?->name
                                ?? 'N/A'
                            }}

                        </div>

                    </div>


                    {{-- File Name --}}

                    <div class="detail-row">

                        <div class="label">
                            PDF Document
                        </div>

                        <div class="value file-name">

                            {{ $map->file_name ?? 'PDF document' }}

                        </div>

                    </div>


                    {{-- Status --}}

                    <div class="detail-row">

                        <div class="label">
                            Availability
                        </div>

                        <div class="value">

                            <span class="status">
                                Available
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ORDER CARD --}}
            {{-- ================================================= --}}

            <div class="card order-card">

                <div class="order-header">

                    <p>
                        Map Price
                    </p>

                    <div class="price">
                        ৳{{ number_format($map->price, 2) }}
                    </div>

                </div>


                <div class="order-body">

                    <p class="order-description">

                        Purchase this digital Mouza map and get access
                        to the PDF document after your order is completed.

                    </p>


                    {{-- ================================================= --}}
                    {{-- ORDER NOW BUTTON --}}
                    {{-- ================================================= --}}
<a
    href="{{ route('orders.create', ['map' => $map->id]) }}"
    class="order-btn"
>
    Order Now
</a>


                    {{-- Security / Information --}}

                    <div class="secure-box">

                        ✓ Digital PDF Map<br>
                        ✓ Secure Order Processing<br>
                        ✓ Download Access After Payment

                    </div>


                    {{-- Map ID --}}

                    <div class="map-id">

                        <span>
                            Map ID
                        </span>

                        <span>
                            #{{ $map->id }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="footer">

        © {{ date('Y') }} MoujaMap. All rights reserved.

    </footer>

</body>

</html>