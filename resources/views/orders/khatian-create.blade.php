<x-app-layout>

    <style>
        :root {
            --green: #166534;
            --green-dark: #14532d;
            --green-light: #dcfce7;
            --green-soft: #f0fdf4;

            --text: #172016;
            --muted: #667168;
            --border: #dbe5dc;
        }

        .order-page {
            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #f4faf4 0%,
                    #ffffff 50%,
                    #f7faf7 100%
                );

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                sans-serif;

            color: var(--text);
        }

        .order-container {
            width: 100%;
            max-width: 1000px;

            margin: auto;

            padding:
                50px 24px 80px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            color: var(--green);

            font-size: 13px;
            font-weight: 800;

            text-decoration: none;

            margin-bottom: 22px;
        }

        .back-link:hover {
            color: var(--green-dark);
        }

        .order-card {
            overflow: hidden;

            background: white;

            border:
                1px solid
                var(--border);

            border-radius: 22px;

            box-shadow:
                0 18px 55px
                rgba(20, 83, 45, .09);
        }

        .order-header {
            padding: 30px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #14532d,
                    #166534
                );
        }

        .badge {
            display: inline-flex;

            padding:
                7px 11px;

            border-radius: 999px;

            background:
                rgba(220, 252, 231, .15);

            border:
                1px solid
                rgba(220, 252, 231, .25);

            color: #dcfce7;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: .06em;
        }

        .order-title {
            margin-top: 15px;

            font-size: 32px;

            line-height: 1.2;

            font-weight: 900;

            letter-spacing: -.03em;
        }

        .order-subtitle {
            margin-top: 8px;

            color: #dcfce7;

            font-size: 14px;
        }

        .order-body {
            padding: 32px;
        }

        .section-title {
            font-size: 19px;

            font-weight: 850;

            letter-spacing: -.02em;
        }

        .section-description {
            margin-top: 5px;

            color: var(--muted);

            font-size: 13px;
        }

        .summary {
            margin-top: 22px;

            padding: 20px;

            border:
                1px solid
                var(--border);

            border-radius: 15px;

            background: #fafcf9;
        }

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 15px;
        }

        .summary-item {
            padding: 14px;

            border:
                1px solid
                #e4ebe5;

            border-radius: 11px;

            background: white;
        }

        .label {
            color: #778178;

            font-size: 10px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .06em;
        }

        .value {
            margin-top: 6px;

            color: #18231a;

            font-size: 14px;

            font-weight: 800;
        }

        .price-box {
            margin-top: 18px;

            padding: 18px;

            border:
                1px solid
                #bbf7d0;

            border-radius: 14px;

            background:
                var(--green-soft);
        }

        .price-label {
            color: var(--muted);

            font-size: 12px;

            font-weight: 700;
        }

        .price {
            margin-top: 3px;

            color: var(--green-dark);

            font-size: 28px;

            font-weight: 900;
        }

        .form-section {
            margin-top: 35px;

            padding-top: 30px;

            border-top:
                1px solid
                #edf1ed;
        }

        .form-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 18px;

            margin-top: 22px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;

            margin-bottom: 7px;

            color: #374238;

            font-size: 12px;

            font-weight: 800;
        }

        .form-input,
        .form-select {
            width: 100%;

            min-height: 46px;

            padding:
                0 13px;

            border:
                1px solid
                #d5dfd6;

            border-radius: 10px;

            background: white;

            color: #18231a;

            font-size: 13px;

            outline: none;

            transition: .15s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color:
                #86b894;

            box-shadow:
                0 0 0 3px
                rgba(22, 101, 52, .08);
        }

        .error {
            margin-top: 5px;

            color: #b91c1c;

            font-size: 11px;
        }

        .payment-info {
            margin-top: 20px;

            padding: 14px 16px;

            border:
                1px solid
                #dbe5dc;

            border-radius: 11px;

            background: #fafcf9;

            color: #5f6b61;

            font-size: 12px;

            line-height: 1.6;
        }

        .submit-section {
            margin-top: 28px;

            display: flex;

            justify-content: flex-end;
        }

        .submit-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 48px;

            padding:
                0 24px;

            border: 0;

            border-radius: 11px;

            color: white;

            background:
                var(--green);

            font-size: 13px;

            font-weight: 850;

            cursor: pointer;

            transition: .15s ease;
        }

        .submit-button:hover {
            background:
                var(--green-dark);

            transform:
                translateY(-1px);
        }

        @media (max-width: 700px) {

            .order-container {
                padding:
                    35px 18px 60px;
            }

            .order-header {
                padding: 24px 22px;
            }

            .order-title {
                font-size: 26px;
            }

            .order-body {
                padding: 22px;
            }

            .summary-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .submit-section {
                justify-content: stretch;
            }

            .submit-button {
                width: 100%;
            }
        }
    </style>


    <div class="order-page">

        <div class="order-container">

            {{-- BACK --}}

            <a
                href="{{ route('khatians.show', $khatian) }}"
                class="back-link"
            >

                <svg
                    width="16"
                    height="16"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Khatian

            </a>


            <div class="order-card">

                {{-- HEADER --}}

                <div class="order-header">

                    <span class="badge">
                        KHATIAN ORDER
                    </span>

                    <h1 class="order-title">
                        Place Your Order
                    </h1>

                    <p class="order-subtitle">
                        Complete the form below to order your digital Khatian record.
                    </p>

                </div>


                <div class="order-body">

                    {{-- KHATIAN SUMMARY --}}

                    <h2 class="section-title">
                        Khatian Details
                    </h2>

                    <p class="section-description">
                        Please verify the record information before placing your order.
                    </p>


                    <div class="summary">

                        <div class="summary-grid">

                            <div class="summary-item">

                                <div class="label">
                                    Khatian Number
                                </div>

                                <div class="value">
                                    {{ $khatian->khatian_number }}
                                </div>

                            </div>


                            <div class="summary-item">

                                <div class="label">
                                    Survey Type
                                </div>

                                <div class="value">
                                    {{ strtoupper($khatian->surveyType->name ?? 'N/A') }}
                                </div>

                            </div>


                            <div class="summary-item">

                                <div class="label">
                                    Owner Name
                                </div>

                                <div class="value">
                                    {{ $khatian->owner_name ?? 'Not Available' }}
                                </div>

                            </div>


                            <div class="summary-item">

                                <div class="label">
                                    Mouza
                                </div>

                                <div class="value">
                                    {{ $khatian->mouza->name ?? 'N/A' }}
                                </div>

                            </div>

                        </div>


                        <div class="price-box">

                            <div class="price-label">
                                Total Amount
                            </div>

                            <div class="price">
                                ৳ {{ number_format((float) $khatian->price, 2) }}
                            </div>

                        </div>

                    </div>


                    {{-- CUSTOMER FORM --}}

                    <div class="form-section">

                        <h2 class="section-title">
                            Customer Information
                        </h2>

                        <p class="section-description">
                            Enter your contact information so we can process your order.
                        </p>


                        <form
                            method="POST"
                            action="{{ route('orders.khatian.store') }}"
                        >

                            @csrf


                            <input
                                type="hidden"
                                name="khatian_id"
                                value="{{ $khatian->id }}"
                            >


                            <div class="form-grid">

                                {{-- NAME --}}

                                <div class="form-group">

                                    <label
                                        class="form-label"
                                        for="customer_name"
                                    >
                                        Full Name
                                    </label>

                                    <input
                                        id="customer_name"
                                        type="text"
                                        name="customer_name"
                                        class="form-input"
                                        value="{{ old('customer_name') }}"
                                        placeholder="Enter your full name"
                                        required
                                    >

                                    @error('customer_name')

                                        <div class="error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- PHONE --}}

                                <div class="form-group">

                                    <label
                                        class="form-label"
                                        for="phone"
                                    >
                                        Phone Number
                                    </label>

                                    <input
                                        id="phone"
                                        type="text"
                                        name="phone"
                                        class="form-input"
                                        value="{{ old('phone') }}"
                                        placeholder="01XXXXXXXXX"
                                        required
                                    >

                                    @error('phone')

                                        <div class="error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- EMAIL --}}

                                <div class="form-group full">

                                    <label
                                        class="form-label"
                                        for="email"
                                    >
                                        Email Address
                                        <span style="font-weight:500;color:#8a938c;">
                                            (Optional)
                                        </span>
                                    </label>

                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        class="form-input"
                                        value="{{ old('email') }}"
                                        placeholder="you@example.com"
                                    >

                                    @error('email')

                                        <div class="error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- PAYMENT --}}

                                <div class="form-group full">

                                    <label
                                        class="form-label"
                                        for="payment_method"
                                    >
                                        Payment Method
                                    </label>

                                    <select
                                        id="payment_method"
                                        name="payment_method"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">
                                            Select payment method
                                        </option>

                                        <option
                                            value="cod"
                                            @selected(old('payment_method') === 'cod')
                                        >
                                            Cash on Delivery
                                        </option>

                                        <option
                                            value="bkash"
                                            @selected(old('payment_method') === 'bkash')
                                        >
                                            bKash
                                        </option>

                                        <option
                                            value="nagad"
                                            @selected(old('payment_method') === 'nagad')
                                        >
                                            Nagad
                                        </option>

                                        <option
                                            value="card"
                                            @selected(old('payment_method') === 'card')
                                        >
                                            Card
                                        </option>

                                        <option
                                            value="bank"
                                            @selected(old('payment_method') === 'bank')
                                        >
                                            Bank Transfer
                                        </option>

                                    </select>

                                    @error('payment_method')

                                        <div class="error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>


                            <div class="payment-info">

                                <strong>
                                    Payment Notice:
                                </strong>

                                Your order will initially remain
                                <strong>Pending</strong>.
                                After payment verification, an administrator
                                will confirm the order and enable your secure
                                PDF download.

                            </div>


                            {{-- SUBMIT --}}

                            <div class="submit-section">

                                <button
                                    type="submit"
                                    class="submit-button"
                                >

                                    Place Order

                                    <svg
                                        width="16"
                                        height="16"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 12h14M13 6l6 6-6 6"
                                        />

                                    </svg>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>