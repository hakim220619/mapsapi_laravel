@php
    $currentRouteName = Route::currentRouteName();
    $activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
    $activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar container shadow-none py-0">
    <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-3 px-md-4">
        <!-- Menu logo wrapper: Start -->
        <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
            <!-- Mobile menu toggle: Start-->
            <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="tf-icons mdi mdi-menu mdi-24px align-middle"></i>
            </button>
            <!-- Mobile menu toggle: End-->
            <a href="{{ url('front-pages/landing') }}" class="app-brand-link">
                <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
                <span
                    class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ config('variables.templateName') }}</span>
            </a>
        </div>
        <!-- Menu logo wrapper: End -->
        <!-- Menu wrapper: Start -->
        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
            <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tf-icons mdi mdi-close"></i>
            </button>
            <ul class="navbar-nav me-auto p-3 p-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-medium" aria-current="page"
                        href="{{ url('front-pages/landing') }}#landingHero">Cari Jasa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ url('front-pages/landing') }}#landingFeatures">Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ url('front-pages/landing') }}#landingTeam">About</a>
                </li>


            </ul>
        </div>
        <div class="landing-menu-overlay d-lg-none"></div>
        <!-- Menu wrapper: End -->
        <!-- Toolbar: Start -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            @if ($configData['hasCustomizer'] == true)
                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class='mdi mdi-24px'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                <span class="align-middle"><i class='mdi mdi-weather-sunny me-2'></i>Light</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->
            @endif

            <!-- navbar button: Start -->
            <li>
                @if (!isset(request()->user()->id))
                    <a href="{{ url('/login') }}" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"><span
                            class="tf-icons mdi mdi-account me-md-1"></span><span
                            class="d-none d-md-block">Login</span></a>
                @else
                    <button class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"><span
                            class="tf-icons mdi mdi-account me-md-1"></span><span
                            class="d-none d-md-block">{{ request()->user()->name }}</span></button>
                @endif


            </li>
            <!-- navbar button: End -->
        </ul>
        <!-- Toolbar: End -->
    </div>
</nav>
<!-- Navbar: End -->
