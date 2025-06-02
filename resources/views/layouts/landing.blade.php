

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Nest - Connect with Friends</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1877f2;
            --secondary-color: #42b72a;
            --dark-color: #1c1e21;
            --light-color: #f0f2f5;
            --border-color: #dddfe2;
            --card-bg: #ffffff;
            --text-color: #1c1e21;
            --hover-bg: #f0f2f5;
        }

        [data-bs-theme="dark"] {
            --primary-color: #1877f2;
            --secondary-color: #42b72a;
            --dark-color: #e4e6eb;
            --light-color: #18191a;
            --border-color: #3e4042;
            --card-bg: #242526;
            --text-color: #e4e6eb;
            --hover-bg: #3a3b3c;
        }

        body {
            background-color: var(--light-color);
            font-family: Helvetica, Arial, sans-serif;
            font-size: 0.9rem;
            min-height: 100vh;
            color: var(--text-color);
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--card-bg);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 0.3rem 1rem;
            height: 50px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .search-box {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .search-box input {
            background-color: var(--light-color);
            border-radius: 20px;
            padding: 0.3rem 1rem 0.3rem 2.5rem;
            border: none;
            width: 100%;
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #65676b;
        }

        .profile-pic {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .dropdown-menu {
            background-color: var(--card-bg);
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            color: var(--text-color);
        }

        .dropdown-item:hover {
            background-color: var(--hover-bg);
        }

        .dropdown-item i {
            width: 20px;
            color: #65676b;
        }

        /* Main Content Styles */
        .main-content {
            margin-top: 50px;
            padding: 15px;
            min-height: calc(100vh - 50px);
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 50px;
            bottom: 0;
            width: 280px;
            padding: 15px;
            overflow-y: auto;
            background-color: var(--light-color);
            z-index: 1020;
            transition: all 0.3s ease;
        }

        .sidebar.left {
            left: 0;
        }

        .sidebar.right {
            right: 0;
        }

        .sidebar.minimized {
            width: 60px;
            padding: 15px 5px;
        }

        .sidebar.minimized .sidebar-item span {
            display: none;
        }

        .sidebar.minimized .sidebar-card {
            padding: 10px 5px;
        }

        .sidebar.minimized .sidebar-icon {
            margin-right: 0;
        }

        .sidebar-toggle {
            position: fixed;
            top: 60px;
            left: 280px;
            width: 24px;
            height: 24px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-left: none;
            border-radius: 0 4px 4px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1021;
            transition: all 0.3s ease;
        }

        .sidebar-toggle i {
            color: var(--text-color);
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .sidebar.minimized + .sidebar-toggle {
            left: 60px;
        }

        .sidebar.minimized + .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar-card {
            background: var(--card-bg);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 3px;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-color);
            text-decoration: none;
        }

        .sidebar-item:hover {
            background-color: var(--hover-bg);
        }

        .sidebar-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            margin-right: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-color);
            font-size: 0.9rem;
        }

        /* Feed Section */
        .feed-container {
            flex: 1;
            margin: 0 300px;
            padding: 0 15px;
            transition: all 0.3s ease;
        }

        .feed-container.expanded {
            margin: 0 80px;
        }

        .feed {
            max-width: 600px;
            margin: 0 auto;
        }

        .create-post, .post {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .post-input {
            background-color: var(--light-color);
            border-radius: 20px;
            padding: 8px 12px;
            border: none;
            width: 100%;
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .post-actions {
            border-top: 1px solid var(--border-color);
            margin-top: 8px;
            padding-top: 8px;
        }

        .post-action-btn {
            color: var(--text-color);
            padding: 6px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .post-action-btn:hover {
            background-color: var(--hover-bg);
        }

        .post-stats {
            font-size: 0.8rem;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .post-comments {
            background-color: var(--light-color);
            border-radius: 6px;
            padding: 8px;
            margin-top: 8px;
        }

        .comment-input {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 6px 12px;
            border: 1px solid var(--border-color);
            width: 100%;
            font-size: 0.85rem;
            color: var(--text-color);
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--card-bg);
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1040;
        }

        .theme-toggle i {
            color: var(--text-color);
            font-size: 1.2rem;
        }

        /* Mobile Sidebar */
        .mobile-sidebar-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--card-bg);
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 1040;
            align-items: center;
            justify-content: center;
        }

        .mobile-sidebar-toggle i {
            color: var(--text-color);
            font-size: 1.2rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.right {
                transform: translateX(100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: none;
            }

            .mobile-sidebar-toggle {
                display: flex;
            }

            .feed-container {
                margin: 0;
            }

            .feed-container.expanded {
                margin: 0;
            }
        }

        @media (max-width: 768px) {
            .search-box {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Social Nest</a>
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search Social Nest" class="border-0 bg-transparent" style="outline: none;">
                </div>
                <div class="dropdown">
                    <img src="https://via.placeholder.com/32" alt="Profile" class="profile-pic" data-bs-toggle="dropdown">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-question-circle"></i> Help</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Mobile Sidebar Toggle -->
    <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Theme Toggle Button -->
    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Theme toggle functionality
            const themeToggle = $('#themeToggle');
            const html = $('html');
            const icon = themeToggle.find('i');

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                html.attr('data-bs-theme', savedTheme);
                updateThemeIcon(savedTheme);
            }

            themeToggle.click(function() {
                const currentTheme = html.attr('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                html.attr('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });

            function updateThemeIcon(theme) {
                icon.removeClass('fa-sun fa-moon')
                    .addClass(theme === 'light' ? 'fa-moon' : 'fa-sun');
            }

            // Add hover effect to post action buttons
            $('.post-action-btn').hover(
                function() { $(this).css('background-color', 'var(--hover-bg)'); },
                function() { $(this).css('background-color', 'transparent'); }
            );

            // Handle post creation
            $('.post-input').focus(function() {
                $(this).css('background-color', 'var(--hover-bg)');
            }).blur(function() {
                $(this).css('background-color', 'var(--light-color)');
            });

            // Handle search input
            $('.search-box input').focus(function() {
                $(this).parent().css('background-color', 'var(--hover-bg)');
            }).blur(function() {
                $(this).parent().css('background-color', 'var(--light-color)');
            });

            // Sidebar minimize functionality
            const sidebar = $('.sidebar.left');
            const sidebarToggle = $('.sidebar-toggle');
            const feedContainer = $('.feed-container');
            const mobileSidebarToggle = $('#mobileSidebarToggle');

            // Check for saved sidebar state
            const savedSidebarState = localStorage.getItem('sidebarState');
            if (savedSidebarState === 'minimized') {
                sidebar.addClass('minimized');
                feedContainer.addClass('expanded');
            }

            // Desktop sidebar toggle
            sidebarToggle.click(function() {
                sidebar.toggleClass('minimized');
                feedContainer.toggleClass('expanded');
                
                // Save state
                const isMinimized = sidebar.hasClass('minimized');
                localStorage.setItem('sidebarState', isMinimized ? 'minimized' : 'expanded');
            });

            // Mobile sidebar toggle
            mobileSidebarToggle.click(function() {
                sidebar.toggleClass('show');
                $(this).find('i').toggleClass('fa-bars fa-times');
            });

            // Close sidebar when clicking outside on mobile
            $(document).click(function(e) {
                if ($(window).width() <= 1200) {
                    if (!$(e.target).closest('.sidebar, .mobile-sidebar-toggle').length) {
                        sidebar.removeClass('show');
                        mobileSidebarToggle.find('i').removeClass('fa-times').addClass('fa-bars');
                    }
                }
            });

            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() > 1200) {
                    sidebar.removeClass('show');
                    mobileSidebarToggle.find('i').removeClass('fa-times').addClass('fa-bars');
                }
            });
        });
    </script>
</body>
</html>

