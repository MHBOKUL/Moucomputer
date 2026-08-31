<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MoujaMap') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- =========================================================
         GLOBAL ADMIN UI STYLES
         ========================================================= -->
    <style>
        :root {
            --mm-primary: #087443;
            --mm-primary-dark: #075b36;
            --mm-primary-light: #eaf7f0;
            --mm-accent: #d4a72c;
            --mm-bg: #f5f7f8;
            --mm-border: #e3e8e5;
            --mm-text: #17221d;
            --mm-muted: #68756e;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--mm-bg);
            color: var(--mm-text);
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        /* =====================================================
           SCROLLBAR
           ===================================================== */

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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
           SELECTION
           ===================================================== */

        ::selection {
            background: var(--mm-primary);
            color: white;
        }

        /* =====================================================
           MAIN PAGE
           ===================================================== */

        .mm-page {
            min-height: calc(100vh - 64px);
            background:
                linear-gradient(
                    180deg,
                    #f7f9f8 0%,
                    #f5f7f8 45%,
                    #f3f6f4 100%
                );
        }

        /* =====================================================
           PAGE HEADER
           ===================================================== */

        .mm-header {
            background: rgba(255, 255, 255, 0.97);
            border-bottom: 1px solid var(--mm-border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            position: relative;
            z-index: 20;
        }

        .mm-header-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 18px 24px;
        }

        /* =====================================================
           PAGE CONTENT
           ===================================================== */

        .mm-content {
            width: 100%;
        }

        .mm-container {
            max-width: 1280px;
            margin: 0 auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        /* =====================================================
           COMMON CARDS
           ===================================================== */

        .mm-card {
            background: #ffffff;
            border: 1px solid var(--mm-border);
            border-radius: 16px;
            box-shadow:
                0 1px 2px rgba(16, 24, 40, 0.03),
                0 4px 12px rgba(16, 24, 40, 0.025);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .mm-card:hover {
            box-shadow:
                0 2px 4px rgba(16, 24, 40, 0.04),
                0 10px 25px rgba(16, 24, 40, 0.05);
        }

        /* =====================================================
           SECTION HEADINGS
           ===================================================== */

        .mm-section-title {
            font-size: 18px;
            line-height: 1.4;
            font-weight: 800;
            color: var(--mm-text);
            letter-spacing: -0.015em;
        }

        .mm-section-subtitle {
            margin-top: 4px;
            font-size: 13px;
            line-height: 1.6;
            color: var(--mm-muted);
        }

        /* =====================================================
           BUTTONS
           ===================================================== */

        .mm-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 18px;
            border-radius: 10px;
            background: var(--mm-primary);
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            border: 1px solid var(--mm-primary);
            transition: all 0.2s ease;
        }

        .mm-btn-primary:hover {
            background: var(--mm-primary-dark);
            border-color: var(--mm-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 5px 14px rgba(8, 116, 67, 0.18);
        }

        .mm-btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 18px;
            border-radius: 10px;
            background: #ffffff;
            color: #34423a;
            font-size: 14px;
            font-weight: 700;
            border: 1px solid #d5ddd8;
            transition: all 0.2s ease;
        }

        .mm-btn-secondary:hover {
            background: #f6f8f7;
            border-color: #aebbb4;
            transform: translateY(-1px);
        }

        /* =====================================================
           FORM ELEMENTS
           ===================================================== */

        input,
        select,
        textarea {
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--mm-primary) !important;
            box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.10) !important;
            outline: none !important;
        }

        /* =====================================================
           TABLES
           ===================================================== */

        .mm-table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
        }

        .mm-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .mm-table thead th {
            background: #f5f8f6;
            color: #64716a;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 14px 18px;
            border-bottom: 1px solid var(--mm-border);
            white-space: nowrap;
        }

        .mm-table tbody td {
            background: #ffffff;
            padding: 16px 18px;
            border-bottom: 1px solid #edf1ef;
            font-size: 14px;
            color: #34423a;
        }

        .mm-table tbody tr {
            transition: background 0.15s ease;
        }

        .mm-table tbody tr:hover td {
            background: #f8faf9;
        }

        .mm-table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* =====================================================
           STATUS BADGES
           ===================================================== */

        .mm-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
            white-space: nowrap;
        }

        .mm-status-success {
            color: #087443;
            background: #eaf7f0;
            border: 1px solid #c9ead8;
        }

        .mm-status-warning {
            color: #9a6800;
            background: #fff8df;
            border: 1px solid #f4e2a4;
        }

        .mm-status-danger {
            color: #b42318;
            background: #fff0ee;
            border: 1px solid #f3c7c2;
        }

        .mm-status-info {
            color: #175cd3;
            background: #eef4ff;
            border: 1px solid #cbdcff;
        }

        .mm-status-neutral {
            color: #59665f;
            background: #f1f3f2;
            border: 1px solid #dde3df;
        }

        /* =====================================================
           ALERTS
           ===================================================== */

        .mm-alert {
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .mm-alert-success {
            color: #087443;
            background: #eaf7f0;
            border: 1px solid #c9ead8;
        }

        .mm-alert-danger {
            color: #b42318;
            background: #fff0ee;
            border: 1px solid #f3c7c2;
        }

        .mm-alert-info {
            color: #175cd3;
            background: #eef4ff;
            border: 1px solid #cbdcff;
        }

        /* =====================================================
           NAVIGATION OVERRIDES
           ===================================================== */

        nav {
            border-bottom: 1px solid var(--mm-border);
        }

        /* =====================================================
           LINKS
           ===================================================== */

        a {
            transition:
                color 0.15s ease,
                background-color 0.15s ease,
                border-color 0.15s ease;
        }

        /* =====================================================
           FOCUS ACCESSIBILITY
           ===================================================== */

        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 3px solid rgba(8, 116, 67, 0.22);
            outline-offset: 2px;
        }

        /* =====================================================
           MOBILE
           ===================================================== */

        @media (max-width: 640px) {

            .mm-header-inner {
                padding: 15px 16px;
            }

            .mm-container {
                padding-left: 16px;
                padding-right: 16px;
            }

            .mm-section-title {
                font-size: 16px;
            }

            .mm-card {
                border-radius: 13px;
            }
        }

        /* =====================================================
           PRINT
           ===================================================== */

        @media print {

            nav {
                display: none !important;
            }

            .mm-header {
                box-shadow: none;
            }

            .mm-page {
                background: white;
            }

            .mm-card {
                box-shadow: none;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-50">

        {{-- =====================================================
             NAVIGATION
             ===================================================== --}}
        @include('layouts.navigation')

        {{-- =====================================================
             PAGE HEADER
             ===================================================== --}}
        @isset($header)

            <header class="mm-header">

                <div class="mm-header-inner">

                    {{ $header }}

                </div>

            </header>

        @endisset


        {{-- =====================================================
             PAGE CONTENT
             ===================================================== --}}

        <main class="mm-page">

            <div class="mm-content">

                {{ $slot }}

            </div>

        </main>

    </div>

</body>

</html>

