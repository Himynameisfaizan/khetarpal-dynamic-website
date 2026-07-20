<?php
// Ye logic check karega ki browser mein kaunsi file open hai
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Khetarpal | Trading</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/vendor/fontawesome.css">
    <link rel="stylesheet" href="assets/css/vendor/plaza-icon.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/plugin/slick.css">
    <link rel="stylesheet" href="assets/css/plugin/material-scrolltop.css">
    <link rel="stylesheet" href="assets/css/plugin/price_range_style.css">
    <link rel="stylesheet" href="assets/css/plugin/in-number.css">
    <link rel="stylesheet" href="assets/css/plugin/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugin/jquery.lineProgressbar.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/service.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<body>
    <header>
        <!-- Top Bar Start -->
        <div class="topbar d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8 topbar-info d-flex flex-wrap gap-3">
                        <span><i class="fas fa-envelope"></i> Khetarpaltradingc@gmail.com</span>
                        <span><i class="fas fa-phone-alt"></i> +91 63547 65516</span>
                        <span><i class="fas fa-phone-alt"></i> +91 89804 32156</span>
                    </div>
                    <div class="col-md-4 text-end social-links">
                        <span class="me-2">Follow Us:</span>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Main Header Start -->
        <div class="main-header shadow-sm">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light py-2">

                    <!-- Logo -->
                    <a class="navbar-brand header-logo" href="index.php">
                        <img src="assets/img/logo/logo.png" alt="Khetarpal Trading Co." style="max-height: 60px;">
                    </a>

                    <!-- Mobile Toggle Button -->
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center d-none d-lg-collapse" id="navbarNav">
                        <ul class="navbar-nav align-items-center">
                            
                            <!-- Dynamic Active Class Logic -->
                            <li class="nav-item <?= ($current_page == 'index.php' || $current_page == '') ? 'active' : ''; ?>">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            
                            <li class="nav-item <?= ($current_page == 'about.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="about.php">About Us</a>
                            </li>
                            
                            <li class="nav-item <?= ($current_page == 'services.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="services.php">Services</a>
                            </li>

                            <!-- Dropdown fixed: Removed data-bs-toggle to make main link clickable -->
                            <li class="nav-item dropdown <?= ($current_page == 'product.php' || $current_page == 'product-details.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="product.php" id="navbarDropdown">
                                    Products <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Cumin Seeds</a></li>
                                    <li><a class="dropdown-item" href="#">Psyllium Husk</a></li>
                                    <li><a class="dropdown-item" href="#">Castor Seeds</a></li>
                                    <li><a class="dropdown-item" href="product.php">View All Products</a></li>
                                </ul>
                            </li>

                            <li class="nav-item <?= ($current_page == 'blogs.php' || $current_page == 'blog.php' || $current_page == 'blog-details.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="blogs.php">Blog</a>
                            </li>
                            
                            <li class="nav-item <?= ($current_page == 'contact.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>

                            <li class="nav-item ms-3">
                                <a href="javascript:void(0);" class="btn-quote" data-bs-toggle="modal" data-bs-target="#quoteModal">
                                    <i class="fas fa-paper-plane me-1"></i> Request a Quote
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Mobile Offcanvas Menu -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-bold" id="mobileMenuLabel" style="color: var(--primary-blue, #0A192F);">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item <?= ($current_page == 'index.php' || $current_page == '') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="index.php">Home</a></li>
                    <li class="nav-item <?= ($current_page == 'about.php') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="about.php">About Us</a></li>
                    <li class="nav-item <?= ($current_page == 'product.php') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="product.php">Products</a></li>
                    <li class="nav-item <?= ($current_page == 'export-market.php') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="export-market.php">Export Markets</a></li>
                    <li class="nav-item <?= ($current_page == 'services.php') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="services.php">Services</a></li>
                    <li class="nav-item <?= ($current_page == 'blog.php' || $current_page == 'blogs.php') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="blog.php">Blog</a></li>
                    <li class="nav-item <?= ($current_page == 'contact.php') ? 'active' : ''; ?>"><a class="nav-link text-dark" href="contact.php">Contact Us</a></li>
                </ul>
                <hr>
                <div class="mt-4">
                    <p><i class="fas fa-phone-alt" style="color: var(--primary-gold, #C49B3B);"></i> +91 63547 65516</p>
                    <p><i class="fas fa-phone-alt" style="color: var(--primary-gold, #C49B3B);"></i> +91 89804 32156</p>
                    <p><i class="fas fa-envelope" style="color: var(--primary-gold, #C49B3B);"></i> khetarpaltradingc@gmail.com</p>
                    <a href="javascript:void(0);" class="btn-quote mt-3 w-100 text-center" data-bs-toggle="modal" data-bs-target="#quoteModal">
                        <i class="fas fa-paper-plane me-1"></i> Request a Quote
                    </a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>