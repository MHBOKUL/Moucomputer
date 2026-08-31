<nav x-data="{ open: false }" class="mm-navbar">

    {{-- =========================
        TOP NAVIGATION
    ========================== --}}
    <div class="mm-nav-container">

        {{-- Logo / Brand --}}
        <div class="mm-brand">
            <a href="{{ route('home') }}" class="mm-brand-link">

                <div class="mm-logo-box">
                    <x-application-logo class="mm-logo" />
                </div>

                <div class="mm-brand-text">
                    <span class="mm-brand-title">MoujaMap</span>
                    <span class="mm-brand-subtitle">Digital Land Map Service</span>
                </div>

            </a>
        </div>


        {{-- =========================
            DESKTOP NAVIGATION
        ========================== --}}
        <div class="mm-desktop-menu">

            <a href="{{ route('home') }}"
               class="mm-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="mm-nav-icon">⌂</span>
                Home
            </a>

            <a href="{{ route('maps.browse') }}"
               class="mm-nav-link {{ request()->routeIs('maps.*') ? 'active' : '' }}">
                <span class="mm-nav-icon">▦</span>
                Mouza Maps
            </a>

            @auth
                @if(auth()->user()->is_admin ?? false)

                    <a href="{{ route('admin.dashboard') }}"
                       class="mm-nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                        <span class="mm-nav-icon">▣</span>
                        Admin Panel
                    </a>

                @endif
            @endauth

        </div>


        {{-- =========================
            RIGHT SIDE
        ========================== --}}
        <div class="mm-right">

            @auth

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="mm-user-button">

                            <span class="mm-user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>

                            <span class="mm-user-name">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="mm-chevron"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <div class="mm-dropdown-header">
                            <div class="mm-dropdown-name">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="mm-dropdown-email">
                                {{ Auth::user()->email }}
                            </div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 &nbsp; Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                🚪 &nbsp; Log Out

                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            @else

                <a href="{{ route('login') }}" class="mm-login">
                    Login
                </a>

                @if(Route::has('register'))

                    <a href="{{ route('register') }}" class="mm-register">
                        Register
                    </a>

                @endif

            @endauth

        </div>


        {{-- =========================
            MOBILE BUTTON
        ========================== --}}
        <button
            @click="open = !open"
            class="mm-mobile-button"
            type="button"
            aria-label="Toggle navigation">

            <svg x-show="!open"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="2"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"/>

            </svg>

            <svg x-show="open"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="2"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"/>

            </svg>

        </button>

    </div>


    {{-- =========================
        MOBILE MENU
    ========================== --}}
    <div
        x-show="open"
        x-transition
        class="mm-mobile-menu">

        <a href="{{ route('home') }}"
           class="mm-mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">

            <span>⌂</span>
            Home

        </a>


        <a href="{{ route('maps.browse') }}"
           class="mm-mobile-link {{ request()->routeIs('maps.*') ? 'active' : '' }}">

            <span>▦</span>
            Mouza Maps

        </a>


        @auth

            @if(auth()->user()->is_admin ?? false)

                <a href="{{ route('admin.dashboard') }}"
                   class="mm-mobile-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">

                    <span>▣</span>
                    Admin Panel

                </a>

            @endif


            <div class="mm-mobile-user">

                <div class="mm-mobile-user-info">

                    <div class="mm-mobile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="mm-mobile-name">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="mm-mobile-email">
                            {{ Auth::user()->email }}
                        </div>
                    </div>

                </div>


                <a href="{{ route('profile.edit') }}"
                   class="mm-mobile-action">
                    👤 Profile
                </a>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="mm-mobile-action logout">
                        🚪 Log Out
                    </button>

                </form>

            </div>

        @else

            <div class="mm-mobile-auth">

                <a href="{{ route('login') }}" class="mm-mobile-login">
                    Login
                </a>

                @if(Route::has('register'))

                    <a href="{{ route('register') }}" class="mm-mobile-register">
                        Register
                    </a>

                @endif

            </div>

        @endauth

    </div>

</nav>


{{-- =====================================================
     MOUJAMAP NAVIGATION CSS
===================================================== --}}
<style>

    /* =========================
       MAIN NAVBAR
    ========================== */

    .mm-navbar {
        width: 100%;
        background: #ffffff;
        border-bottom: 1px solid #dfe8e3;
        box-shadow: 0 2px 12px rgba(0, 70, 50, 0.07);
        position: relative;
        z-index: 50;
    }


    .mm-nav-container {
        max-width: 1280px;
        height: 76px;
        margin: auto;
        padding: 0 24px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
    }


    /* =========================
       BRAND
    ========================== */

    .mm-brand {
        flex-shrink: 0;
    }

    .mm-brand-link {
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none;
    }

    .mm-logo-box {
        width: 46px;
        height: 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e7f5ef;
        border: 1px solid #c9e7da;
        border-radius: 10px;
    }

    .mm-logo {
        width: 34px;
        height: 34px;
        color: #087f5b;
        fill: currentColor;
    }

    .mm-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
    }

    .mm-brand-title {
        color: #075b43;
        font-size: 21px;
        font-weight: 800;
        letter-spacing: -0.3px;
    }

    .mm-brand-subtitle {
        color: #7a8c85;
        font-size: 10px;
        margin-top: 5px;
        font-weight: 500;
        letter-spacing: .3px;
    }


    /* =========================
       DESKTOP MENU
    ========================== */

    .mm-desktop-menu {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-left: auto;
    }

    .mm-nav-link {
        height: 42px;
        padding: 0 15px;

        display: inline-flex;
        align-items: center;
        gap: 7px;

        border-radius: 7px;

        color: #465852;
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: all .2s ease;
    }

    .mm-nav-link:hover {
        color: #087f5b;
        background: #eef8f4;
    }

    .mm-nav-link.active {
        color: #087f5b;
        background: #e8f6f0;
    }

    .mm-nav-icon {
        font-size: 17px;
        line-height: 1;
    }


    /* =========================
       RIGHT SIDE
    ========================== */

    .mm-right {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-left: 10px;
    }


    .mm-login {
        padding: 10px 18px;

        border-radius: 7px;

        background: #087f5b;
        color: white;

        text-decoration: none;

        font-size: 13px;
        font-weight: 700;

        transition: all .2s ease;
    }

    .mm-login:hover {
        background: #056b4c;
        transform: translateY(-1px);
    }


    .mm-register {
        padding: 9px 17px;

        border: 1px solid #b9d9cc;
        border-radius: 7px;

        color: #087f5b;
        background: white;

        text-decoration: none;

        font-size: 13px;
        font-weight: 700;

        transition: all .2s ease;
    }

    .mm-register:hover {
        background: #eef8f4;
        border-color: #087f5b;
    }


    /* =========================
       USER BUTTON
    ========================== */

    .mm-user-button {
        min-height: 44px;
        padding: 4px 10px 4px 5px;

        display: flex;
        align-items: center;
        gap: 9px;

        border: 1px solid #d8e5df;
        border-radius: 8px;

        background: #ffffff;
        color: #33443e;

        cursor: pointer;

        transition: all .2s ease;
    }

    .mm-user-button:hover {
        background: #f3faf7;
        border-color: #9bcdbb;
    }

    .mm-user-avatar {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;

        background: #087f5b;
        color: #ffffff;

        font-size: 14px;
        font-weight: 800;
    }

    .mm-user-name {
        max-width: 130px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        font-size: 13px;
        font-weight: 700;
    }

    .mm-chevron {
        width: 15px;
        height: 15px;
        color: #71827b;
    }


    /* =========================
       DROPDOWN
    ========================== */

    .mm-dropdown-header {
        padding: 12px 16px;
        border-bottom: 1px solid #edf2ef;
    }

    .mm-dropdown-name {
        color: #17352b;
        font-size: 14px;
        font-weight: 700;
    }

    .mm-dropdown-email {
        margin-top: 3px;
        color: #87958f;
        font-size: 11px;
    }


    /* =========================
       MOBILE BUTTON
    ========================== */

    .mm-mobile-button {
        display: none;

        width: 42px;
        height: 42px;

        align-items: center;
        justify-content: center;

        border: 1px solid #d5e4dd;
        border-radius: 8px;

        background: white;
        color: #087f5b;

        cursor: pointer;
    }

    .mm-mobile-button svg {
        width: 22px;
        height: 22px;
    }


    /* =========================
       MOBILE MENU
    ========================== */

    .mm-mobile-menu {
        display: none;

        border-top: 1px solid #edf2ef;
        background: #ffffff;

        padding: 10px 16px 18px;
    }

    .mm-mobile-link {
        display: flex;
        align-items: center;
        gap: 11px;

        padding: 13px 12px;

        margin: 3px 0;

        border-radius: 7px;

        color: #465852;
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;
    }

    .mm-mobile-link:hover,
    .mm-mobile-link.active {
        color: #087f5b;
        background: #eaf7f2;
    }


    /* =========================
       MOBILE USER
    ========================== */

    .mm-mobile-user {
        margin-top: 12px;
        padding-top: 15px;

        border-top: 1px solid #e7eeeb;
    }

    .mm-mobile-user-info {
        display: flex;
        align-items: center;
        gap: 11px;

        padding: 8px 5px 13px;
    }

    .mm-mobile-avatar {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #087f5b;
        color: white;

        font-weight: 800;
    }

    .mm-mobile-name {
        color: #17352b;
        font-size: 14px;
        font-weight: 700;
    }

    .mm-mobile-email {
        color: #899791;
        font-size: 11px;
        margin-top: 2px;
    }

    .mm-mobile-action {
        width: 100%;

        display: block;

        padding: 11px 12px;

        border: 0;
        border-radius: 7px;

        background: transparent;

        color: #465852;
        text-align: left;
        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;
    }

    .mm-mobile-action:hover {
        background: #f0f7f4;
        color: #087f5b;
    }

    .mm-mobile-action.logout:hover {
        background: #fff2f2;
        color: #c0392b;
    }


    /* =========================
       MOBILE AUTH
    ========================== */

    .mm-mobile-auth {
        display: flex;
        flex-direction: column;
        gap: 8px;

        padding-top: 12px;
        border-top: 1px solid #e7eeeb;
    }

    .mm-mobile-login,
    .mm-mobile-register {
        display: block;

        padding: 12px;

        border-radius: 7px;

        text-align: center;
        text-decoration: none;

        font-size: 13px;
        font-weight: 700;
    }

    .mm-mobile-login {
        background: #087f5b;
        color: white;
    }

    .mm-mobile-register {
        border: 1px solid #c5ddd3;
        color: #087f5b;
    }


    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 900px) {

        .mm-nav-container {
            height: 68px;
            padding: 0 16px;
        }

        .mm-desktop-menu,
        .mm-right {
            display: none;
        }

        .mm-mobile-button {
            display: flex;
        }

        .mm-mobile-menu {
            display: block;
        }

        .mm-brand-title {
            font-size: 19px;
        }

        .mm-brand-subtitle {
            font-size: 9px;
        }

    }


    @media (max-width: 480px) {

        .mm-logo-box {
            width: 40px;
            height: 40px;
        }

        .mm-logo {
            width: 29px;
            height: 29px;
        }

        .mm-brand-title {
            font-size: 17px;
        }

        .mm-brand-subtitle {
            display: none;
        }

        .mm-mobile-button {
            width: 39px;
            height: 39px;
        }

    }

</style>

