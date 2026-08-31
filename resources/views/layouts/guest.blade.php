
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MoujaMap') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap"
        rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- =====================================================
         AUTH PAGE STYLES
         ===================================================== -->
    <style>
        :root {
            --mm-primary: #087443;
            --mm-primary-dark: #075b36;
            --mm-primary-light: #eaf7f0;
            --mm-accent: #d4a72c;
            --mm-border: #dfe7e2;
            --mm-text: #17221d;
            --mm-muted: #68756e;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            color: var(--mm-text);
            background: #f3f6f4;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        /* =====================================================
           AUTH BACKGROUND
           ===================================================== */

        .mm-auth-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding: 32px 16px;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(8, 116, 67, 0.08),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(212, 167, 44, 0.08),
                    transparent 28%
                ),
                linear-gradient(
                    135deg,
                    #f7faf8 0%,
                    #f1f5f3 50%,
                    #eef3f0 100%
                );
        }

        /* =====================================================
           LOGO AREA
           ===================================================== */

        .mm-auth-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            margin-bottom: 22px;
        }

        .mm-auth-logo {
            width: 72px;
            height: 72px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #ffffff;

            border: 1px solid var(--mm-border);
            border-radius: 18px;

            box-shadow:
                0 4px 10px rgba(0, 0, 0, 0.04),
                0 12px 28px rgba(8, 116, 67, 0.07);

            color: var(--mm-primary);
        }

        .mm-auth-brand-name {
            margin-top: 12px;

            font-size: 20px;
            line-height: 1.2;
            font-weight: 800;

            letter-spacing: -0.02em;
            color: var(--mm-text);
        }

        .mm-auth-brand-subtitle {
            margin-top: 4px;

            font-size: 12px;
            font-weight: 500;

            color: var(--mm-muted);
            text-align: center;
        }

        /* =====================================================
           AUTH CARD
           ===================================================== */

        .mm-auth-card {
            width: 100%;
            max-width: 460px;

            background: rgba(255, 255, 255, 0.98);

            border: 1px solid var(--mm-border);
            border-radius: 18px;

            padding: 32px;

            box-shadow:
                0 2px 5px rgba(16, 24, 40, 0.03),
                0 12px 30px rgba(16, 24, 40, 0.06);

            position: relative;
            overflow: hidden;
        }

        /* Green top line */

        .mm-auth-card::before {
            content: "";

            position: absolute;
            top: 0;
            left: 0;
            right: 0;

            height: 4px;

            background: var(--mm-primary);
        }

        /* =====================================================
           FORM
           ===================================================== */

        .mm-auth-card input[type="text"],
        .mm-auth-card input[type="email"],
        .mm-auth-card input[type="password"] {
            width: 100%;

            border: 1px solid #d3dcd7;
            border-radius: 10px;

            background: #ffffff;

            padding: 11px 13px;

            font-size: 14px;
            color: var(--mm-text);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .mm-auth-card input[type="text"]:focus,
        .mm-auth-card input[type="email"]:focus,
        .mm-auth-card input[type="password"]:focus {
            border-color: var(--mm-primary) !important;

            box-shadow:
                0 0 0 3px rgba(8, 116, 67, 0.10) !important;

            outline: none !important;
        }

        /* =====================================================
           LABELS
           ===================================================== */

        .mm-auth-card label {
            font-size: 13px;
            font-weight: 700;
            color: #34423a;
        }

        /* =====================================================
           CHECKBOX
           ===================================================== */

        .mm-auth-card input[type="checkbox"] {
            accent-color: var(--mm-primary);
        }

        /* =====================================================
           LINKS
           ===================================================== */

        .mm-auth-card a {
            color: var(--mm-primary);
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .mm-auth-card a:hover {
            color: var(--mm-primary-dark);
        }

        /* =====================================================
           BUTTONS
           ===================================================== */

        .mm-auth-card button,
        .mm-auth-card [type="submit"] {
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .mm-auth-card button:hover,
        .mm-auth-card [type="submit"]:hover {
            transform: translateY(-1px);
        }

        /* =====================================================
           ERROR MESSAGE
           ===================================================== */

        .mm-auth-card .text-red-600,
        .mm-auth-card .text-red-500 {
            color: #b42318 !important;
        }

        /* =====================================================
           SESSION STATUS
           ===================================================== */

        .mm-auth-status {
            margin-bottom: 18px;

            padding: 12px 14px;

            border: 1px solid #c9ead8;
            border-radius: 10px;

            background: #eaf7f0;

            color: #087443;

            font-size: 13px;
            font-weight: 600;
        }

        /* =====================================================
           FOOTER
           ===================================================== */

        .mm-auth-footer {
            margin-top: 20px;

            text-align: center;

            font-size: 11px;
            color: #84918a;
        }

        /* =====================================================
           MOBILE
           ===================================================== */

        @media (max-width: 640px) {

            .mm-auth-page {
                padding: 24px 14px;
            }

            .mm-auth-card {
                padding: 24px 20px;
                border-radius: 15px;
            }

            .mm-auth-logo {
                width: 62px;
                height: 62px;
                border-radius: 15px;
            }

            .mm-auth-brand-name {
                font-size: 18px;
            }
        }

        /* =====================================================
           ACCESSIBILITY
           ===================================================== */

        button:focus-visible,
        a:focus-visible,
        input:focus-visible {
            outline: 3px solid rgba(8, 116, 67, 0.20);
            outline-offset: 2px;
        }

        /* =====================================================
           SCROLLBAR
           ===================================================== */

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #edf1ef;
        }

        ::-webkit-scrollbar-thumb {
            background: #b7c4bd;
            border-radius: 999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #8fa097;
        }

        /* =====================================================
           PRINT
           ===================================================== */

        @media print {
            .mm-auth-page {
                background: white;
            }

            .mm-auth-card {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <div class="mm-auth-page">

        {{-- =================================================
             BRAND / LOGO
             ================================================= --}}
        <a href="/" class="mm-auth-brand">

            <div class="mm-auth-logo">

                <x-application-logo
                    class="w-12 h-12 fill-current"
                />

            </div>

            <div class="mm-auth-brand-name">
                MoujaMap
            </div>

            <div class="mm-auth-brand-subtitle">
                Digital Mouza Map & Land Information
            </div>

        </a>


        {{-- =================================================
             AUTH CARD
             ================================================= --}}
        <div class="mm-auth-card">

            {{ $slot }}

        </div>


        {{-- =================================================
             FOOTER
             ================================================= --}}
        <div class="mm-auth-footer">
            © {{ date('Y') }} MoujaMap. All rights reserved.
        </div>

    </div>

</body>

</html>

