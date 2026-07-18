<!DOCTYPE html>
<html lang="zxx">

<head>

</head>

<body>
    <!-- :::::: End Header Section ::::::  -->

    <?php
    include('./include/header.php');
    ?>

    <!-- :::::: Start Main Container Wrapper :::::: -->

    <main id="main-container" class="main-container">

        <!-- ::::::  Start Hero Section  ::::::  -->
        <section class="hero-section">
            <div class="container hero-content-wrapper">
                <div class="row">
                    <div class="col-lg-8 col-md-10">
                        <!-- Headings -->
                        <h1 class="hero-title">
                            Global Agricultural
                            <span>Export Company</span>
                        </h1>

                        <h3 class="hero-subtitle">From Farm To Global Markets</h3>

                        <p class="hero-desc">
                            We export premium quality agricultural commodities from India to the world.
                        </p>

                        <!-- Buttons -->
                        <div class="hero-btn-group">
                            <a href="quote.php" class="btn-solid-gold">
                                <i class="fas fa-paper-plane me-2"></i> Request a Quote
                            </a>
                            <a href="contact.php" class="btn-outline-gold">
                                <i class="fas fa-phone-alt me-2"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ::::::  End Hero Section  ::::::  -->


        <section class="features-strip">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div class="feature-text">
                                <h6>20+</h6>
                                <p>Countries<br>Worldwide</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-solid fa-ship"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Safe & Timely</h6>
                                <p>Global<br>Shipping</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <div class="feature-text">
                                <h6>100%</h6>
                                <p>Quality<br>Assurance</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-brands fa-pagelines"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Natural &</h6>
                                <p>Premium<br>Products</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="premium-products-section">
            <div class="container">

                <!-- Section Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Our Premium Products</h2>
                        </div>
                    </div>
                </div>

                <!-- Products Grid (PHP loop yahan lagega) -->
                <div class="row">

                    <!-- Single Product Card 1 -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="assets/img/product/category/peanuts.jpg" alt="Peanuts">
                            </div>
                            <h4>Peanuts</h4>
                            <div class="product-meta">
                                <span>Origin: India</span>
                                <span>Packaging: 25kg / 50kg</span>
                            </div>
                            <!-- Inquiry button pe id parameter pass kar sakte ho PHP se -->
                            <a href="inquiry.php?product=cumin-seeds" class="btn-inquiry">Send Inquiry</a>
                        </div>
                    </div>

                    <!-- Single Product Card 2 -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="assets/img/product/category/psyllium-husk.jpg" alt="Psyllium Husk">
                            </div>
                            <h4>Psyllium Husk</h4>
                            <div class="product-meta">
                                <span>Origin: India</span>
                                <span>Packaging: 25kg / 50kg</span>
                            </div>
                            <a href="inquiry.php?product=psyllium-husk" class="btn-inquiry">Send Inquiry</a>
                        </div>
                    </div>

                    <!-- Single Product Card 3 -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="assets/img/product/category/castor.jpg" alt="Castor Seeds">
                            </div>
                            <h4>Castor Seeds</h4>
                            <div class="product-meta">
                                <span>Origin: India</span>
                                <span>Packaging: 25kg / 50kg</span>
                            </div>
                            <a href="inquiry.php?product=castor-seeds" class="btn-inquiry">Send Inquiry</a>
                        </div>
                    </div>

                    <!-- Single Product Card 4 -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="assets/img/product/category/fennel.jpg" alt="Fennel Seeds">
                            </div>
                            <h4>Fennel Seeds</h4>
                            <div class="product-meta">
                                <span>Origin: India</span>
                                <span>Packaging: 25kg / 50kg</span>
                            </div>
                            <a href="inquiry.php?product=fennel-seeds" class="btn-inquiry">Send Inquiry</a>
                        </div>
                    </div>

                </div>

                <!-- View All Products Button -->
                <div class="row">
                    <div class="col-12">
                        <div class="view-all-wrapper">
                            <a href="products.php" class="btn-view-all">View All Products</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="about-stats-section">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Left Side: 4 Stats / Counters -->
                    <div class="col-lg-6">
                        <div class="row">
                            <!-- Stat 1 -->
                            <div class="col-6 col-md-3 col-lg-3">
                                <div class="stat-box">
                                    <i class="fa-solid fa-award stat-icon"></i>
                                    <h4 class="stat-number">10+</h4>
                                    <p class="stat-text">Years of<br>Experience</p>
                                </div>
                            </div>
                            <!-- Stat 2 -->
                            <div class="col-6 col-md-3 col-lg-3">
                                <div class="stat-box">
                                    <i class="fa-solid fa-users stat-icon"></i>
                                    <h4 class="stat-number">500+</h4>
                                    <p class="stat-text">Happy<br>Clients</p>
                                </div>
                            </div>
                            <!-- Stat 3 -->
                            <div class="col-6 col-md-3 col-lg-3">
                                <div class="stat-box">
                                    <i class="fa-solid fa-globe stat-icon"></i>
                                    <h4 class="stat-number">20+</h4>
                                    <p class="stat-text">Countries<br>Exported</p>
                                </div>
                            </div>
                            <!-- Stat 4 -->
                            <div class="col-6 col-md-3 col-lg-3">
                                <div class="stat-box">
                                    <i class="fa-solid fa-weight-scale stat-icon"></i> <!-- Use fa-box if scale looks odd -->
                                    <h4 class="stat-number">1000+</h4>
                                    <p class="stat-text">MT Monthly<br>Supply</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: About Text -->
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h3 class="about-title">About Khetarpal Trading Co.</h3>
                            <p class="about-desc">
                                Khetarpal Trading Co. is a trusted name in the field of agriculture export. We bring you the finest quality products sourced from reliable farmers and processed with utmost care to meet international standards.<br><br>
                                Our commitment to quality, timely delivery and customer satisfaction makes us a preferred export partner worldwide.
                            </p>
                            <a href="about.php" class="btn-read-more">Read More</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- ==========================================
     START: WHY CHOOSE US SECTION
        =============================================== -->
        <section class="why-choose-section">
            <div class="container">

                <h2 class="section-main-title">Why Choose Us?</h2>

                <div class="row g-4">

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="wcu-card">
                            <div class="wcu-icon"><i class="fa-solid fa-award"></i></div>
                            <h6>Premium Quality</h6>
                            <p>We ensure the best quality in every shipment from farm to destination.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="wcu-card">
                            <div class="wcu-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                            <h6>Competitive Pricing</h6>
                            <p>Best wholesale prices with consistent quality for our global buyers.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="wcu-card">
                            <div class="wcu-icon"><i class="fa-solid fa-truck-fast"></i></div>
                            <h6>Timely Delivery</h6>
                            <p>Fast, safe, and on-time shipping across the globe without delays.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="wcu-card">
                            <div class="wcu-icon"><i class="fa-solid fa-box-open"></i></div>
                            <h6>Custom Packaging</h6>
                            <p>Flexible packaging solutions designed strictly as per buyer requirements.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="wcu-card">
                            <div class="wcu-icon"><i class="fa-solid fa-file-contract"></i></div>
                            <h6>Quality Testing</h6>
                            <p>Strict quality checks and certifications at every stage of processing.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="wcu-card">
                            <div class="wcu-icon"><i class="fa-solid fa-headset"></i></div>
                            <h6>Customer Support</h6>
                            <p>Our dedicated team is here to support your import process 24/7.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- END: WHY CHOOSE US SECTION -->


        <!-- ==========================================
     START: OUR EXPORT MARKETS SECTION
        =============================================== -->
        <section class="export-markets-section">
            <div class="container">

                <h2 class="section-main-title">Our Global Export Markets</h2>

                <!-- The Grid (This is where your PHP while loop will go) -->
                <div class="country-grid">

                    <!-- Country 1 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <!-- Replace src with your database flag image path -->
                            <img src="https://flagcdn.com/w160/ae.png" alt="UAE Flag">
                        </div>
                        <h4 class="country-name">UAE</h4>
                    </div>

                    <!-- Country 2 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/sa.png" alt="Saudi Arabia Flag">
                        </div>
                        <h4 class="country-name">Saudi Arabia</h4>
                    </div>

                    <!-- Country 3 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/vn.png" alt="Vietnam Flag">
                        </div>
                        <h4 class="country-name">Vietnam</h4>
                    </div>

                    <!-- Country 4 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/np.png" alt="Nepal Flag">
                        </div>
                        <h4 class="country-name">Nepal</h4>
                    </div>

                    <!-- Country 5 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/om.png" alt="Oman Flag">
                        </div>
                        <h4 class="country-name">Oman</h4>
                    </div>

                    <!-- Country 6 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/my.png" alt="Malaysia Flag">
                        </div>
                        <h4 class="country-name">Malaysia</h4>
                    </div>

                    <!-- Country 7 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/qa.png" alt="Qatar Flag">
                        </div>
                        <h4 class="country-name">Qatar</h4>
                    </div>

                    <!-- Country 8 -->
                    <div class="country-card">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/w160/id.png" alt="Indonesia Flag">
                        </div>
                        <h4 class="country-name">Indonesia</h4>
                    </div>

                </div>

                <!-- Optional summary text at bottom -->
                <p class="global-reach-text">
                    And <span>many more countries</span> across the globe. We are constantly expanding our footprint!
                </p>

            </div>
        </section>

        <!-- ::::::  Start banner Section  ::::::  -->
        <section class="cta-banner-section">
            <!-- Backend Note: Yahan img src ko PHP se dynamic kar dena -->
            <img src="assets/img/banner/size-extra-large-wide/spice-banner.png" alt="Promo Banner" class="cta-banner-bg">

            <div class="cta-banner-overlay"></div>

            <div class="container">
                <div class="cta-banner-content">
                    <!-- Backend Note: In sabhi text elements ko apne DB column se replace kar dena -->
                    <h6 class="cta-subtitle">Special Discount</h6>

                    <h2 class="cta-title">For all Spice <br> products</h2>

                    <p class="cta-desc">Take now 20% off for all bulk and wholesale orders.</p>

                    <!-- Backend Note: Link aur Button text ko bhi dynamic kar sakte ho -->
                    <a href="shop.php" class="btn-cta-gold">Shop Now</a>
                </div>
            </div>
        </section> <!-- ::::::  End banner Section  ::::::  -->

        <!-- ::::::  Start Testimonial Section  ::::::  -->
        <section class="testimonial-section">
            <div class="container">
                <h2 class="section-main-title">What Our Clients Say</h2>

                <div class="row justify-content-center">
                    <!-- Using a standard row for simplicity instead of forcing a slider in static HTML.
                     If you use a slider (like Slick/Owl), this row becomes the slider container. -->

                    <!-- Testimonial 1 -->
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <div class="testimonial-box">
                            <i class="fa-solid fa-quote-left quote-icon"></i>
                            <p class="testimonial-text">
                                "Khetarpal Trading Co. has been our most reliable partner for agricultural products. The quality of their spices and their prompt service are always beyond our expectations. Highly recommended for bulk exports."
                            </p>
                            <div class="client-info">
                                <!-- Placeholder image, use real client image -->
                                <img src="https://ui-avatars.com/api/?name=Ahmed+Al+Mansoori&background=C49B3B&color=fff" alt="Ahmed" class="client-img">
                                <div class="client-details">
                                    <h5>Ahmed Al Mansoori</h5>
                                    <span>Importer, UAE</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 (Optional, to balance the grid) -->
                    <div class="col-lg-6 col-md-12">
                        <div class="testimonial-box">
                            <i class="fa-solid fa-quote-left quote-icon"></i>
                            <p class="testimonial-text">
                                "We have been importing seeds from them for the last two years. Their commitment to international packaging standards and timely delivery makes them stand out in the Indian export market."
                            </p>
                            <div class="client-info">
                                <img src="https://ui-avatars.com/api/?name=David+Smith&background=0A192F&color=fff" alt="David" class="client-img">
                                <div class="client-details">
                                    <h5>David Smith</h5>
                                    <span>Procurement Head, UK</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- END: TESTIMONIAL SECTION -->


        <!-- ==========================================
         START: LATEST NEWS / BLOG SECTION
    =============================================== -->
        <section class="blog-section">
            <div class="container">

                <!-- Custom Header for Blog Section (Title on left, Link on right) -->
                <div class="section-header-flex">
                    <h2 class="section-main-title title-with-line">Latest News</h2>
                    <a href="blog.php" class="btn-view-all">View All News <i class="fa-solid fa-arrow-right-long ms-1"></i></a>
                </div>

                <!-- Blog Grid -->
                <div class="row g-4">

                    <!-- Blog Post 1 -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <!-- Update image paths based on your actual assets -->
                                <img src="assets/img/blog/feed/ajwain.jpg" alt="Blog Image" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Cumin+Export'">
                            </div>
                            <div class="blog-content">
                                <a href="#" class="blog-title">Cumin Seeds Export From India: Trends & Quality</a>
                                <div class="blog-meta">
                                    <span><i class="fa-regular fa-calendar"></i> May 20, 2024</span>
                                    <span><i class="fa-solid fa-user-pen"></i> Admin</span>
                                </div>
                                <a href="#" class="read-more-link">Read Article <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 2 -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <img src="assets/img/blog/feed/castor.jpg" alt="Blog Image" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Global+Demand'">
                            </div>
                            <div class="blog-content">
                                <a href="#" class="blog-title">Global Demand For Castor Seeds in 2024</a>
                                <div class="blog-meta">
                                    <span><i class="fa-regular fa-calendar"></i> May 15, 2024</span>
                                    <span><i class="fa-solid fa-user-pen"></i> Admin</span>
                                </div>
                                <a href="#" class="read-more-link">Read Article <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 3 -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <img src="assets/img/blog/feed/fennel.jpg" alt="Blog Image" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Agriculture+Growth'">
                            </div>
                            <div class="blog-content">
                                <a href="#" class="blog-title">India's Agricultural Export Growth and Future</a>
                                <div class="blog-meta">
                                    <span><i class="fa-regular fa-calendar"></i> May 05, 2024</span>
                                    <span><i class="fa-solid fa-user-pen"></i> Admin</span>
                                </div>
                                <a href="#" class="read-more-link">Read Article <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- ::::::  End  Blog News   ::::::  -->

        <!-- ::::::  Start Newsletter Section  ::::::  -->
        <section class="newsletter-section">
            <!-- Backend Note: Img src ko admin panel se dynamic kar dena -->
            <img src="assets/img/newsletter/newsletter-bg.jpg" alt="Newsletter Background" class="newsletter-bg">

            <div class="newsletter-overlay"></div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-12 text-center newsletter-content">

                        <h2 class="newsletter-title">Subscribe To Our <span>Newsletter</span></h2>
                        <p class="newsletter-desc">Get the latest updates on agricultural commodities, market trends, and exclusive offers.</p>

                        <!-- Newsletter Form -->
                        <!-- Backend Note: Jab PHP script likhoge tab 'action' update kar dena -->
                        <form class="newsletter-form" action="#" method="post">
                            <div class="input-group-custom">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input type="email" name="newsletter-mail" id="newsletter-mail" placeholder="Enter your email address" required>
                                <button type="submit" class="btn-subscribe">Subscribe</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section> <!-- ::::::  End newsletter Section  ::::::  -->

    </main> <!-- :::::: End MainContainer Wrapper :::::: -->

    <!-- ::::::  Start  Footer ::::::  -->
    <?php
    include("./include/footer.php");
    ?>
    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"></button>

    <!-- Start Modal Add cart -->
    <div class="modal fade" id="modalAddCart" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fal fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal__product-img">
                                            <img class="img-fluid" src="assets/img/product/size-normal/product-home-1-img-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="link--green link--icon-left"><i class="fal fa-check-square"></i>Added to cart successfully!</div>
                                        <div class="modal__product-cart-buttons m-tb-15">
                                            <a href="#" class="btn btn--box  btn--tiny btn--green btn--green-hover-black btn--uppercase">View Cart</a>
                                            <a href="#" class="btn btn--box  btn--tiny btn--green btn--green-hover-black btn--uppercaset">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal__border">
                                <ul class="modal__product-shipping-info">
                                    <li class="link--icon-left"><i class="icon-shopping-cart"></i> There Are 5 Items In Your Cart.</li>
                                    <li>TOTAL PRICE: <span>$187.00</span></li>
                                    <li><a href="#" class="btn text-underline color-green" data-bs-dismiss="modal">CONTINUE SHOPPING</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Add cart -->

    <!-- Start Modal Quickview cart -->
    <div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fal fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery-box m-b-60">
                                    <div class="modal-product-image--large">
                                        <img class="img-fluid" src="assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-box">
                                    <h5 class="title title--normal m-b-20">Aliquam lobortis</h5>
                                    <div class="product__price">
                                        <span class="product__price-del">$35.90</span>
                                        <span class="product__price-reg">$31.69</span>
                                    </div>
                                    <ul class="product__review m-t-15">
                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                        <li class="product__review--blank"><i class="icon-star"></i></li>
                                    </ul>
                                    <div class="product__desc m-t-25 m-b-30">
                                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will</p>
                                    </div>

                                    <div class="product-var p-t-30">
                                        <div class="product-quantity product-var__item d-flex align-items-center flex-wrap">
                                            <span class="product-var__text">Quantity: </span>
                                            <form class="modal-quantity-scale m-l-20">
                                                <div class="value-button" id="modal-decrease" onclick="decreaseValueModal()">-</div>
                                                <input type="number" id="modal-number" value="1" />
                                                <div class="value-button" id="modal-increase" onclick="increaseValueModal()">+</div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="product-links">
                                        <div class="product-social m-tb-30">
                                            <span>SHARE THIS PRODUCT</span>
                                            <ul class="product-social-link">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview cart -->


    <!-- Vendor JS Files -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Plugins JS Files -->
    <script src="assets/js/plugin/slick.min.js"></script>
    <script src="assets/js/plugin/jquery.countdown.min.js"></script>
    <script src="assets/js/plugin/material-scrolltop.js"></script>
    <script src="assets/js/plugin/price_range_script.js"></script>
    <script src="assets/js/plugin/in-number.js"></script>
    <script src="assets/js/plugin/jquery.elevateZoom-3.0.8.min.js"></script>
    <script src="assets/js/plugin/venobox.min.js"></script>
    <script src="assets/js/plugin/jquery.waypoints.js"></script>
    <script src="assets/js/plugin/jquery.lineProgressbar.js"></script>

    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="assets/js/main.js"></script>
</body>


<!-- Mirrored from template.hasthemes.com/gsore/gsore/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jul 2026 09:45:02 GMT -->

</html>