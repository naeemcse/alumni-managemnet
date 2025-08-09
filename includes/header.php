<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="app, landing, corporate, Creative, Html Template, Template">
    <meta name="author" content="web-themes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title -->
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Alumni of CSE'; ?></title>

    <!-- all css here -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link href="css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css?v=1.1" rel="stylesheet" type="text/css" />
    
    <!-- Additional CSS if needed -->
    <?php if(isset($additionalCSS)) echo $additionalCSS; ?>
</head>
<body>
    <section class="header">
        <a href="index.php" class="logo"><img src="img/connection.png" alt="">Alumni</a>
        
        <!-- Main Navigation for Laptop -->
        <nav class="navbar-main">
            <a href="index.php">Home</a>
            <a href="alumni.php">Alumni</a>
            <a href="students.php">Students</a>
            <a href="events.php">Events</a>
            <a href="jobs.php">Jobs</a>
            <a href="gallery.php">Gallery</a>
        </nav>
        
        <!-- Right side items -->
        <div class="header-right">
            <a href="admin-login.php" class="admin-btn">
                <i class="fas fa-user-shield"></i> Admin
            </a>
            <div class="dropdown">
                <button class="menu-dropdown-btn" id="menuDropdown">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="index.php#faculty"><i class="fas fa-chalkboard-teacher"></i> Faculty</a>
                    <a href="search.php"><i class="fas fa-search"></i> Search</a>
                    <a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu button -->
        <div id="mobile-menu-btn" class="mobile-menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <!-- Mobile Navigation -->
        <nav class="mobile-navbar" id="mobileNavbar">
            <a href="index.php">Home</a>
            <a href="index.php#faculty">Faculty</a>
            <a href="alumni.php">Alumni Directory</a>
            <a href="students.php">Students</a>
            <a href="events.php">Events</a>
            <a href="jobs.php">Jobs</a>
            <a href="gallery.php">Gallery</a>
            <a href="search.php">Search</a>
            <a href="signup.php">Sign Up</a>
            <a href="admin-login.php" class="mobile-admin-link">
                <i class="fas fa-user-shield"></i> Admin
            </a>
        </nav>
    </section>

    <!-- Clean Header Styles -->
    <style>
    /* Reset and Base Styles */
    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 5%;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    /* Logo Styles */
    .logo {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        text-decoration: none;
    }

    .logo img {
        height: 35px;
        margin-right: 8px;
    }

    .logo:hover {
        color: #3498db;
    }

    /* Main Navigation for Desktop/Laptop */
    .navbar-main {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .navbar-main a {
        color: #2c3e50;
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        position: relative;
    }

    .navbar-main a:hover {
        color: #3498db;
        background: rgba(52, 152, 219, 0.1);
    }

    /* Header Right Section */
    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    /* Admin Button */
    .admin-btn {
        background: #3498db;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .admin-btn:hover {
        background: #2980b9;
        color: white;
        transform: translateY(-1px);
    }

    /* Dropdown Styles */
    .dropdown {
        position: relative;
    }

    .menu-dropdown-btn {
        background: none;
        border: 2px solid #3498db;
        color: #3498db;
        padding: 0.5rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .menu-dropdown-btn:hover {
        background: #3498db;
        color: white;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        padding: 0.5rem 0;
        min-width: 180px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1001;
    }

    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-menu a {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #2c3e50;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .dropdown-menu a:hover {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }

    .dropdown-menu a i {
        margin-right: 0.5rem;
        width: 16px;
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 0.5rem;
        background: none;
        border: 2px solid #3498db;
        border-radius: 6px;
        z-index: 1002;
        transition: all 0.3s ease;
        position: relative;
    }

    .mobile-menu-btn:hover {
        background: rgba(52, 152, 219, 0.1);
    }

    .mobile-menu-btn span {
        width: 20px;
        height: 2px;
        background: #2c3e50;
        margin: 2px 0;
        transition: 0.3s;
        border-radius: 1px;
        display: block;
    }

    .mobile-menu-btn.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-4px, 4px);
    }

    .mobile-menu-btn.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-btn.active span:nth-child(3) {
        transform: rotate(45deg) translate(-4px, -4px);
    }

    /* Mobile Navigation */
    .mobile-navbar {
        position: fixed;
        top: 70px;
        left: -100%;
        right: 0;
        width: 100%;
        background: white;
        flex-direction: column;
        padding: 1rem 0;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        z-index: 999;
        transition: left 0.3s ease;
        max-height: calc(100vh - 70px);
        overflow-y: auto;
        display: flex;
    }

    .mobile-navbar.active {
        left: 0;
    }

    .mobile-navbar a {
        color: #2c3e50;
        text-decoration: none;
        padding: 1rem 2rem;
        border-bottom: 1px solid #ecf0f1;
        transition: all 0.3s ease;
    }

    .mobile-navbar a:hover {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }

    .mobile-navbar a:last-child {
        border-bottom: none;
    }

    .mobile-admin-link {
        background: #3498db !important;
        color: white !important;
        margin: 1rem 2rem 0 2rem !important;
        border-radius: 8px !important;
        text-align: center !important;
    }

    .mobile-admin-link:hover {
        background: #2980b9 !important;
        color: white !important;
    }

    /* Body padding for fixed header */
    body {
        padding-top: 70px;
    }
    
    /* Prevent scroll when mobile menu is open */
    body.menu-open {
        overflow: hidden;
        position: fixed;
        width: 100%;
    }

    /* Responsive Design */
    
    /* Desktop - hide mobile menu, show full navigation */
    @media (min-width: 768px) {
        .mobile-menu-btn {
            display: none !important;
        }
        
        .mobile-navbar {
            display: none !important;
        }
        
        .navbar-main {
            display: flex !important;
        }
        
        .header-right {
            display: flex !important;
        }
    }
    
    /* Large screens - spacious navigation */
    @media (min-width: 1200px) {
        .navbar-main {
            gap: 2rem;
        }
        
        .navbar-main a {
            padding: 0.6rem 1.2rem;
            font-size: 1rem;
        }
    }

    /* Medium laptops - compact navigation */
    @media (min-width: 992px) and (max-width: 1199px) {
        .navbar-main {
            gap: 1rem;
        }
        
        .navbar-main a {
            padding: 0.5rem 0.8rem;
            font-size: 0.9rem;
        }
        
        .header-right {
            gap: 0.5rem;
        }
    }

    /* Small laptops - very compact navigation */
    @media (min-width: 768px) and (max-width: 991px) {
        .navbar-main {
            gap: 0.8rem;
        }
        
        .navbar-main a {
            padding: 0.4rem 0.6rem;
            font-size: 0.85rem;
        }
        
        .header-right {
            gap: 0.5rem;
        }
    }

    /* Mobile Design - show only mobile menu */
    @media (max-width: 767px) {
        .navbar-main {
            display: none !important;
        }
        
        .header-right .dropdown {
            display: none !important;
        }
        
        .header-right .admin-btn {
            display: none !important;
        }

        .mobile-menu-btn {
            display: flex !important;
        }

        .header {
            padding: 1rem 4%;
        }

        .logo {
            font-size: 1.3rem;
        }

        .logo img {
            height: 30px;
        }
        
        .header-right {
            display: flex !important;
            justify-content: flex-end;
        }
    }

    /* Small mobile */
    @media (max-width: 480px) {
        .header {
            padding: 1rem 3%;
        }
        
        .logo {
            font-size: 1.2rem;
        }
        
        .logo img {
            height: 28px;
        }
    }
    </style>

    <!-- Clean JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Header JavaScript loaded');
        
        // Dropdown functionality for desktop
        const dropdownBtn = document.getElementById('menuDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');
        
        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
                console.log('Dropdown toggled');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileNavbar = document.getElementById('mobileNavbar');
        
        console.log('Mobile menu button found:', !!mobileMenuBtn);
        console.log('Mobile navbar found:', !!mobileNavbar);
        
        if (mobileMenuBtn && mobileNavbar) {
            console.log('Setting up mobile menu event listener');
            
            mobileMenuBtn.addEventListener('click', function(e) {
                console.log('Mobile menu button clicked!');
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle classes
                this.classList.toggle('active');
                mobileNavbar.classList.toggle('active');
                document.body.classList.toggle('menu-open');
                
                console.log('Mobile menu active:', this.classList.contains('active'));
            });

            // Close mobile menu when clicking on links
            const mobileLinks = mobileNavbar.querySelectorAll('a');
            mobileLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    console.log('Mobile link clicked, closing menu');
                    mobileMenuBtn.classList.remove('active');
                    mobileNavbar.classList.remove('active');
                    document.body.classList.remove('menu-open');
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileNavbar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    mobileMenuBtn.classList.remove('active');
                    mobileNavbar.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            });
        } else {
            console.log('Mobile menu elements not found!');
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 767) {
                if (mobileMenuBtn && mobileNavbar) {
                    mobileMenuBtn.classList.remove('active');
                    mobileNavbar.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            }
        });
    });
    </script>
