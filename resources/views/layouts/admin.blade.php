<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BreadSMG Admin - Toko Roti & Kue</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('template-assets/admin/assets/images/favicon-32x32.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('template-assets/admin/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('template-assets/admin/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('template-assets/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-assets/admin/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-assets/admin/assets/plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-assets/admin/assets/plugins/simplebar/css/simplebar.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('template-assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('template-assets/admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/admin/assets/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/admin/assets/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/admin/assets/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/admin/assets/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/admin/assets/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/admin/assets/sass/responsive.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

    <!--start header-->
    <header class="top-header">
        <nav class="navbar navbar-expand align-items-center gap-4">
            <div class="btn-toggle">
                <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative">
                    <input class="form-control rounded-5 px-5 search-control d-lg-block d-none" type="text"
                        placeholder="Search">
                    <span
                        class="material-icons-outlined position-absolute d-lg-block d-none ms-3 translate-middle-y start-0 top-50">search</span>
                    <span
                        class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 search-close">close</span>
                </div>
            </div>
            <ul class="navbar-nav gap-1 nav-right-links align-items-center">
                <li class="nav-item dropdown">
                    <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <img src="{{ asset('template-assets/admin/assets/images/avatars/01.png') }}"
                            class="rounded-circle p-1 border" width="45" height="45" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                        <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                            <div class="text-center">
                                <img src="{{ asset('template-assets/admin/assets/images/avatars/01.png') }}"
                                    class="rounded-circle p-1 shadow mb-3" width="90" height="90" alt="">
                                <h5 class="user-name mb-0 fw-bold">Hello, Admin</h5>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                            href="{{ route('admin.dashboard') }}"><i
                                class="material-icons-outlined">dashboard</i>Dashboard</a>
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('home') }}"
                            target="_blank"><i class="material-icons-outlined">language</i>Lihat Website</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                                class="material-icons-outlined">power_settings_new</i>Logout</a>
                    </div>
                </li>
            </ul>

        </nav>
    </header>
    <!--end top header-->


    <!--start sidebar-->
    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div class="logo-icon">
                <img src="{{ asset('template-assets/admin/assets/images/logo-icon.png') }}" class="logo-img" alt="">
            </div>
            <div class="logo-name flex-grow-1">
                <h5 class="mb-0">BreadSMG</h5>
            </div>
            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
        </div>
        <div class="sidebar-nav">
            <!--navigation-->
            <ul class="metismenu" id="sidenav">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <div class="parent-icon"><i class="material-icons-outlined">home</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.menus.index') }}"
                        class="{{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                        <div class="parent-icon"><i class="material-icons-outlined">restaurant_menu</i>
                        </div>
                        <div class="menu-title">Kelola Menu</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                        class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <div class="parent-icon"><i class="material-icons-outlined">shopping_bag</i>
                        </div>
                        <div class="menu-title">Kelola Pesanan</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        <div class="parent-icon"><i class="material-icons-outlined">language</i>
                        </div>
                        <div class="menu-title">Lihat Website</div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </div>
    </aside>
    <!--end sidebar-->

    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            @yield('content')
        </div>
    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--start footer-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2024 BreadSMG - Toko Roti & Kue. All rights reserved.</p>
    </footer>
    <!--end footer-->

    <!--bootstrap js-->
    <script src="{{ asset('template-assets/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('template-assets/admin/assets/js/jquery.min.js') }}"></script>
    <script
        src="{{ asset('template-assets/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template-assets/admin/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template-assets/admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('template-assets/admin/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>