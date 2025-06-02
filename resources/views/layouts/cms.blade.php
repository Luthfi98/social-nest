@php
    $menus = \App\Models\MenuModel::with('children')->where('parent_id', null)->orderBy('order')->get();
    // dd($menus);
@endphp


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Nest - Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --sidebar-width: 220px;
            --sidebar-collapsed-width: 70px;
            --navbar-height: 50px;
            --footer-height: 40px;
        }

        [data-bs-theme="dark"] {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #e3e6f0;
            --light-color: #212529;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            font-size: 0.875rem;
            padding-top: var(--navbar-height);
            padding-bottom: var(--footer-height);
        }

        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--navbar-height));
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            padding-top: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 1000;
            overflow-x: hidden;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link i.fa-chevron-down {
            display: none;
        }

        .sidebar.collapsed .submenu {
            display: none !important;
        }

        .sidebar.collapsed .sidebar-footer {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            padding: 0.5rem;
            margin: 0.25rem auto;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .sidebar.collapsed .nav-link i {
            margin: 0;
            font-size: 1rem;
        }

        .sidebar.collapsed .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar-toggle {
            position: fixed;
            left: var(--sidebar-width);
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            border: 2px solid var(--bs-body-bg);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            font-size: 0.9rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 1001;
            padding: 0;
            line-height: 1;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed + .sidebar-toggle {
            left: var(--sidebar-collapsed-width);
        }

        .sidebar-toggle:hover {
            background: #224abe;
            transform: translateY(-50%) scale(1.1);
        }

        .sidebar-toggle i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed ~ .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .floating-submenu {
            position: fixed;
            left: var(--sidebar-collapsed-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            min-width: 200px;
            display: none;
            z-index: 1002;
            padding: 0.5rem 0;
        }

        .sidebar:not(.collapsed) .floating-submenu {
            display: none !important;
        }

        .nav-item {
            position: relative;
        }

        .nav-item:hover .floating-submenu {
            display: none;
        }

        .sidebar.collapsed .nav-item:hover .floating-submenu {
            display: block;
        }

        .floating-submenu:hover {
            display: block;
        }

        .floating-submenu .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            margin: 0;
            width: 100%;
            height: auto;
            border-radius: 0;
            justify-content: flex-start;
            white-space: nowrap;
            display: flex;
            align-items: center;
            text-align: left;
        }

        .floating-submenu .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .floating-submenu .nav-link i {
            width: 1.2rem;
            margin-right: 1rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .floating-submenu .nav-link span {
            text-align: left;
            flex: 1;
        }

        .floating-submenu .nav-link:hover i {
            color: #fff;
        }

        .mobile-nav-items {
            display: none;
        }

        .sidebar .nav {
            flex: 1;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0.25rem 0.75rem;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .sidebar .nav-link span {
            flex: 1;
            text-align: left;
            margin-left: 0.5rem;
        }

        .sidebar .nav-link i.fa-chevron-down {
            font-size: 0.7rem;
            transition: transform 0.3s ease;
            margin-left: 0.5rem;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link i.fa-chevron-down.rotate {
            transform: rotate(180deg);
        }

        .sidebar .submenu {
            list-style: none;
            padding-left: 2.5rem;
            margin: 0;
            display: none;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 0 0 5px 5px;
            margin: 0 0.75rem;
        }

        .sidebar .submenu.show {
            display: block;
        }

        .sidebar .submenu .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.4rem 0.75rem;
            margin: 0.15rem 0;
            font-size: 0.75rem;
            border-radius: 3px;
            display: flex;
            align-items: center;
        }

        .sidebar .submenu .nav-link i {
            width: 1.2rem;
            margin-right: 0.75rem;
            font-size: 0.9rem;
        }

        .sidebar .submenu .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .sidebar .submenu .nav-link:hover i {
            color: #fff;
        }

        .sidebar-footer {
            padding: 1rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 1rem;
            min-height: calc(100vh - var(--navbar-height));
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed ~ .content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            background-color: var(--bs-body-bg);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 1001;
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1rem;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.3s ease;
            font-size: 0.875rem;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .stat-card {
            border-left: 3px solid;
            border-radius: 8px;
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--secondary-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.info {
            border-left-color: var(--danger-color);
        }

        .stat-card .card-body {
            padding: 1rem;
        }

        .stat-card .card-title {
            color: var(--dark-color);
            font-size: 0.65rem;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 0.15rem;
            letter-spacing: 0.5px;
        }

        .stat-card .card-text {
            color: var(--dark-color);
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0.15rem 0;
            line-height: 1.2;
        }

        .stat-card .card-text small {
            font-size: 0.6rem;
            opacity: 0.8;
        }

        .table {
            background-color: var(--bs-body-bg);
            border-radius: 8px;
            overflow: hidden;
            font-size: 0.8rem;
        }

        .table thead th {
            background-color: var(--light-color);
            border-bottom: 2px solid #e3e6f0;
            color: var(--dark-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            padding: 0.5rem;
        }

        .table td {
            padding: 0.5rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.35em 0.65em;
            font-weight: 500;
            font-size: 0.7rem;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--footer-height);
            background-color: var(--bs-body-bg);
            box-shadow: 0 -0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 999;
            padding: 0.5rem 0;
            font-size: 0.75rem;
            transition: left 0.3s ease;
        }

        .sidebar.collapsed ~ .footer {
            left: var(--sidebar-collapsed-width);
        }

        .user-dropdown .dropdown-toggle::after {
            display: none;
        }

        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 8px;
            font-size: 0.8rem;
            min-width: 200px;
            margin-top: 0.5rem;
        }

        .user-dropdown .dropdown-item {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .user-dropdown .dropdown-item:hover {
            background-color: var(--light-color);
        }

        .user-dropdown .dropdown-item i {
            width: 1.2rem;
            margin-right: 0.5rem;
            color: var(--dark-color);
            font-size: 0.9rem;
        }

        .theme-switch {
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .theme-switch:hover {
            background-color: var(--light-color);
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .avatar {
            width: 24px;
            height: 24px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .footer {
                left: 0;
            }

            .navbar-nav {
                display: none;
            }

            .mobile-nav-items {
                display: block;
                padding: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: auto;
            }

            .mobile-nav-items .nav-link {
                color: rgba(255, 255, 255, 0.8);
                padding: 0.5rem 1rem;
                display: flex;
                align-items: center;
                border-radius: 5px;
                margin: 0.25rem 0;
            }

            .mobile-nav-items .nav-link:hover {
                color: #fff;
                background-color: rgba(255, 255, 255, 0.1);
            }

            .mobile-nav-items .nav-link i {
                width: 1.5rem;
                margin-right: 0.5rem;
            }

            .mobile-nav-items .dropdown-menu {
                background: var(--bs-body-bg);
                border: none;
                box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
                border-radius: 8px;
                margin-top: 0.5rem;
            }

            .mobile-nav-items .dropdown-item {
                color: var(--dark-color);
                padding: 0.5rem 1rem;
            }

            .mobile-nav-items .dropdown-item:hover {
                background-color: var(--light-color);
            }

            .sidebar-toggle {
                display: none;
            }
        }

        [data-bs-theme="dark"] .floating-submenu {
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        [data-bs-theme="dark"] .floating-submenu .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        [data-bs-theme="dark"] .floating-submenu .nav-link:hover i {
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <i class="fas fa-dove me-1"></i>Social Nest
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-2">
                        <button class="theme-switch btn btn-link" id="themeSwitch">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" 
                                 class="rounded-circle me-1 avatar" alt="Admin">
                            <span class="d-none d-md-inline">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="dropdown-item-text">
                                    <div class="fw-bold">Admin User</div>
                                    <small class="text-muted">admin@socialnest.com</small>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            @foreach ($menus as $menu)
                @if ($menu->route)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($menu->route) ? 'active' : '' }}" href="{{ route($menu->route) }}">
                            <i class="{{ $menu->icon }}"></i>
                            <span>{{ __($menu->name) }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link submenu-toggle {{ $menu->children->contains(function ($submenu) {
                            return request()->routeIs($submenu->route);
                        }) ? 'active' : '' }}" href="#">
                            <i class="{{ $menu->icon }}"></i>
                            <span>{{ __($menu->name) }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="submenu {{ $menu->children->contains(function ($submenu) {
                            return request()->routeIs($submenu->route);
                        }) ? 'show' : '' }}">
                            @foreach ($menu->children->sortBy('order') as $submenu)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs($submenu->route) ? 'active' : '' }}" href="{{ route($submenu->route) }}">
                                        <i class="{{ $submenu->icon }}"></i>
                                        <span>{{ __($submenu->name) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="floating-submenu" style="text-align: left;">
                            @foreach ($menu->children->sortBy('order') as $submenu)
                                <a class="nav-link {{ request()->routeIs($submenu->route) ? 'active' : '' }}" href="{{ route($submenu->route) }}">
                                    <i class="{{ $submenu->icon }} mr-3"></i> {{ __($submenu->name) }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="mobile-nav-items">
            <a class="nav-link" href="#" id="mobileThemeSwitch">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </a>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="dropdown-item-text">
                            <div class="fw-bold">Admin User</div>
                            <small class="text-muted">admin@socialnest.com</small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span>Version 1.0.0</span>
                <span>&copy; 2024</span>
            </div>
        </div>
    </div>
    <div class="sidebar-toggle d-none d-lg-block">
        <i class="fas fa-chevron-left"></i>
    </div>

    <!-- Main Content -->
    
    <main class="content">
    @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">Social Nest. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0">Dashboard</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    @stack('scripts')
    
    <!-- Toastr Configuration -->
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    <script>
        $(document).ready(function() {
            // Add active class to current nav item
            $('.nav-link').click(function(e) {
                if (!$(this).hasClass('submenu-toggle')) {
                    $('.nav-link').removeClass('active');
                    $(this).addClass('active');
                }
            });

            // Handle floating submenu positioning
            $('.nav-link').hover(function() {
                if ($('.sidebar').hasClass('collapsed')) {
                    const navItem = $(this).closest('.nav-item');
                    const submenu = navItem.find('.floating-submenu');
                    const navItemTop = navItem.offset().top;
                    const sidebarTop = $('.sidebar').offset().top;
                    
                    submenu.css('top', (navItemTop - sidebarTop) + 'px');
                }
            });

            // Handle submenu toggles
            $('.submenu-toggle').click(function(e) {
                e.preventDefault();
                const submenu = $(this).next('.submenu');
                const icon = $(this).find('.fa-chevron-down');
                
                // Only toggle submenu if sidebar is not collapsed
                if (!$('.sidebar').hasClass('collapsed')) {
                    // Close other submenus
                    $('.submenu').not(submenu).removeClass('show');
                    $('.submenu-toggle').not(this).find('.fa-chevron-down').removeClass('rotate');
                    
                    // Toggle current submenu
                    submenu.toggleClass('show');
                    icon.toggleClass('rotate');
                }
            });

            // Toggle sidebar on mobile
            $('.navbar-toggler').click(function() {
                $('.sidebar').toggleClass('show');
            });

            // Add hover effect to cards
            $('.card').hover(
                function() { $(this).addClass('shadow-lg'); },
                function() { $(this).removeClass('shadow-lg'); }
            );

            // Dark mode toggle
            const themeSwitch = document.getElementById('themeSwitch');
            const html = document.documentElement;
            const icon = themeSwitch.querySelector('i');

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                html.setAttribute('data-bs-theme', savedTheme);
                updateThemeIcon(savedTheme);
            }

            themeSwitch.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });

            function updateThemeIcon(theme) {
                icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            }

            // Sidebar toggle for desktop
            $('.sidebar-toggle').click(function() {
                $('.sidebar').toggleClass('collapsed');
                $('.content').toggleClass('expanded');
            });

            // Close sidebar when clicking outside on mobile
            $(document).click(function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.sidebar, .navbar-toggler').length) {
                        $('.sidebar').removeClass('show');
                    }
                }
            });

            // Mobile theme switch
            $('#mobileThemeSwitch').click(function(e) {
                e.preventDefault();
                const html = document.documentElement;
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                const icon = $(this).find('i');
                icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            });
        });
    </script>

    @if (session()->has('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    @if (session()->has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

</body>
</html>
