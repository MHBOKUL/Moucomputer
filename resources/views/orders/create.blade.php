
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order {{ $map->title }} - MoujaMap</title>

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
            background: #ffffff;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .map-info {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .map-info h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 150px 1fr;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #6b7280;
        }

        .price {
            color: #16a34a;
            font-size: 20px;
            font-weight: bold;
        }

        .form-title {
            font-size: 21px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 7px;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
            display: inline-block;
            padding: 13px 22px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #6b7280;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .required {
            color: #dc2626;
        }

        @media(max-width: 600px) {

            .container {
                margin: 20px auto;
            }

            .card {
                padding: 20px;
            }

            h1 {
                font-size: 23px;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 4px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Place Your Order</h1>

        <div class="subtitle">
            Complete the form below to order this Mouza Map.
        </div>


        {{-- Map Information --}}
        <div class="map-info">

            <h2>{{ $map->title }}</h2>

            <div class="info-row">
                <div class="label">Division</div>
                <div>
                    {{ $map->mouza->upazila->district->division->name ?? '-' }}
                </div>
            </div>

            <div class="info-row">
                <div class="label">District</div>
                <div>
                    {{ $map->mouza->upazila->district->name ?? '-' }}
                </div>
            </div>

            <div class="info-row">
                <div class="label">Upazila</div>
                <div>
                    {{ $map->mouza->upazila->name ?? '-' }}
                </div>
            </div>

            <div class="info-row">
                <div class="label">Mouza</div>
                <div>
                    {{ $map->mouza->name ?? '-' }}
                </div>
            </div>

            <div class="info-row">
                <div class="label">Survey Type</div>
                <div>
                    {{ $map->mouza->surveyType->name ?? '-' }}
                </div>
            </div>

            <div class="info-row">
                <div class="label">Price</div>
                <div class="price">
                    ৳{{ number_format($map->price, 2) }}
                </div>
            </div>

        </div>


        {{-- Order Form --}}
        <h2 class="form-title">
            Customer Information
        </h2>

        <form action="{{ route('orders.map.store') }}" method="POST">

            @csrf

            {{-- Map ID --}}
            <input
                type="hidden"
                name="map_id"
                value="{{ $map->id }}"
            >


            {{-- Customer Name --}}
            <div class="form-group">

                <label for="customer_name">
                    Customer Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="customer_name"
                    name="customer_name"
                    value="{{ old('customer_name') }}"
                    placeholder="Enter your full name"
                    required
                >

                @error('customer_name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Phone --}}
            <div class="form-group">

                <label for="phone">
                    Phone Number <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="01XXXXXXXXX"
                    required
                >

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Email --}}
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Payment Method --}}
            <div class="form-group">

                <label for="payment_method">
                    Payment Method <span class="required">*</span>
                </label>

                <select
                    id="payment_method"
                    name="payment_method"
                    required
                >

                    <option value="">
                        Select Payment Method
                    </option>

                 <option value="cod"
    {{ old('payment_method') == 'cod' ? 'selected' : '' }}>
    Cash on Delivery
</option>

                    <option
                        value="bkash"
                        {{ old('payment_method') == 'bkash' ? 'selected' : '' }}
                    >
                        bKash
                    </option>

                    <option
                        value="nagad"
                        {{ old('payment_method') == 'nagad' ? 'selected' : '' }}
                    >
                        Nagad
                    </option>

                    <option
                        value="card"
                        {{ old('payment_method') == 'card' ? 'selected' : '' }}
                    >
                        Card
                    </option>

                </select>

                @error('payment_method')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Buttons --}}
            <div class="actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Place Order — ৳{{ number_format($map->price, 2) }}
                </button>

                <a
                    href="{{ route('maps.show', $map) }}"
                    class="btn btn-secondary"
                >
                    Back to Map
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>

