<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rudra | Temaplate first</title>
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
                    <div class="col-md-8 topbar-info d-flex gap-4">
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
                        <img src="assets/img/logo/logo.png" alt="Khetarpal Trading Co.">
                    </a>

                    <!-- Mobile Toggle Button -->
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Desktop Navigation -->
                    <div class="collapse navbar-collapse justify-content-center d-none d-lg-collapse" id="navbarNav">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>

                            <!-- Dropdown (Easy for PHP dynamic loop) -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="product.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Products <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i>
                                </a>
                                <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Cumin Seeds</a></li>
                                    <li><a class="dropdown-item" href="#">Psyllium Husk</a></li>
                                    <li><a class="dropdown-item" href="#">Castor Seeds</a></li>
                                </ul>
                            </li>

                            <!-- <li class="nav-item"><a class="nav-link" href="export-market.php">Export Markets</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="blogs.php">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>

                            <!-- Request Quote Button -->
                            <li class="nav-item ms-3">
                                <a href="javascript:void(0);" class="btn-quote" data-bs-toggle="modal" data-bs-target="#quoteModal">
                                    <i class="fas fa-paper-plane"></i> Request a Quote
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Main Header End -->

        <!-- Mobile Offcanvas Menu Start (Very clean for PHP) -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-dark" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="export-market.php">Export Markets</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="blogs.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="contact-us.php">Contact Us</a></li>
                </ul>
                <hr>
                <div class="mt-4">
                    <p><i class="fas fa-phone-alt text-primary"></i> +91 63547 65516</p>
                    <p><i class="fas fa-phone-alt text-primary"></i> +91 89804 32156</p>
                    <p><i class="fas fa-envelope text-primary"></i> khetarpaltradingc@gmail.com</p>
                    <a href="javascript:void(0);" class="btn-quote" data-bs-toggle="modal" data-bs-target="#quoteModal">
                        <i class="fas fa-paper-plane"></i> Request a Quote
                    </a>
                </div>
            </div>
        </div>
        <!-- Mobile Offcanvas Menu End -->
    </header>
</body>

</html>