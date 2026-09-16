<?php

include("./admin/db-conn.php");

$sqlProduct = "SELECT p.*, c.categories AS category_name 
        FROM products p
        LEFT JOIN categories c ON p.pro_cate = c.cate_id 
        WHERE p.status = 1 
        ORDER BY p.pro_id DESC LIMIT 6";

$sqlBlog = "SELECT * FROM blogs WHERE status = 'published' LIMIT 3";
$sqlTestimonial = "SELECT * From testimonials ORDER BY id DESC";
$sqlCountry = "SELECT * From country ORDER BY id DESC";

$resultProduct = $conn->query($sqlProduct);
$resultBLog = $conn->query($sqlBlog);
$resultTestimonial = $conn->query($sqlTestimonial);
$resultCountry = $conn->query($sqlCountry);

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
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#quoteModal" class="btn-solid-gold">
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
                <div class="section-title text-center mb-5">
                    <h2>Our Premium Products</h2>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            <?php
            if ($resultProduct && $resultProduct->num_rows > 0) {
                while ($row = $resultProduct->fetch_assoc()) {

                    $pro_id = $row['pro_id'];
                    $pro_name = htmlspecialchars($row['pro_name']);
                    $category = !empty($row['category_name']) ? htmlspecialchars($row['category_name']) : "Agro Products";
                    $packaging = !empty($row['qty']) ? htmlspecialchars($row['qty']) : "Custom packaging available";
                    
                    // Price variables hata diye gaye hain

                    $img_path = !empty($row['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['pro_img']) : "https://placehold.co/600x500/eeeeee/999999?text=No+Image";
            ?>

                    <!-- Single Product Card -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="b2b-product-card d-flex flex-column h-100 shadow-sm bg-white rounded-3 overflow-hidden" style="border: 1px solid #f0f0f0; transition: transform 0.3s ease;">
                            <div class="prod-img-box" style="height: 250px; overflow: hidden;">
                                 <a href="product-details.php?id=<?php echo $pro_id; ?>" >
                                <img src="<?php echo $img_path; ?>" alt="<?php echo $pro_name; ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Image+Not+Found'" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                 </a>
                            </div>
                            
                            <div class="prod-content p-4 d-flex flex-column flex-grow-1">
                                 <a href="product-details.php?id=<?php echo $pro_id; ?>" style="text-decoration: none; color: inherit;" onmouseover="this.style.color='var(--primary-gold, #C49B3B)'" onmouseout="this.style.color='inherit'">
                                <h3 class="prod-title mb-3" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-blue, #0A192F); text-transform: uppercase;"><?php echo $pro_name; ?></h3>
                                </a>

                                <ul class="prod-specs list-unstyled mb-4" style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #555; line-height: 1.8;">
                                    <li><i class="fa-solid fa-layer-group me-2" style="color: var(--primary-gold, #C49B3B);"></i> <strong>Category:</strong> <?php echo $category; ?></li>
                                    <li><i class="fa-solid fa-box-open me-2" style="color: var(--primary-gold, #C49B3B);"></i> <strong>Packaging:</strong> <?php echo $packaging; ?></li>
                                    <li><i class="fa-solid fa-truck-fast me-2" style="color: var(--primary-gold, #C49B3B);"></i> <strong>Status:</strong> Ready for Export</li>
                                </ul>

                                <!-- NEW DUAL BUTTON LAYOUT -->
                                <div class="mt-auto d-flex gap-2">
                                    <a href="product-details.php?id=<?php echo $pro_id; ?>" class="btn-custom-outline flex-fill text-center">
                                        <i class="fa-regular fa-eye me-1"></i> Details
                                    </a>
                                    <!-- URL mein product ka naam pass kiya hai -->
                                    <a href="contact.php?product=<?php echo urlencode($pro_name); ?>" class="btn-custom-solid flex-fill text-center">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php 
                }
            } else {
                echo "<div class='col-12 text-center py-5'><p class='text-muted'>No premium products available at the moment.</p></div>";
            } 
            ?>
        </div>
        
        <!-- View All Products Button -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="product.php" class="btn-custom-outline px-4 py-2" style="border-width: 2px;">View All Products <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
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

                <?php

                if ($resultCountry && $resultCountry->num_rows > 0) {
                    while ($row = $resultCountry->fetch_assoc()) {
                        $con_name = htmlspecialchars($row['country_name']);

                        // Spelling theek ki ('country_flag') aur Semicolon lagaya
                        $con_flag = htmlspecialchars($row['country_flag']);

                        // Dynamic Image Path (Agar admin folder me upload ho raha hai)
                        $img_path = !empty($con_flag) ? "admin/assets/img/uploads/" . $con_flag : "https://placehold.co/160x100?text=No+Flag";
                ?>
                        <!-- Country 1 -->
                        <div class="country-card">
                            <div class="flag-wrapper">
                                <!-- Replace src with your database flag image path -->
                                <img src="<?php echo $img_path ?>" alt="<?php echo $con_name ?>">
                            </div>
                            <h4 class="country-name"><?php echo $con_name ?></h4>
                        </div>

                <?php }
                } ?>

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
                <a href="product.php" class="btn-cta-gold">Shop Now</a>
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


                <?php
                if ($resultTestimonial && $resultTestimonial->num_rows > 0) {
                    while ($row = $resultTestimonial->fetch_assoc()) {

                        // ERROR FIXED HERE: Added ?? ''
                        $client_name = htmlspecialchars($row['client_name'] ?? '');
                        $client_title = htmlspecialchars($row['client_title'] ?? '');
                        $client_company = htmlspecialchars($row['client_company'] ?? '');
                        $text = htmlspecialchars($row['testimonial_text'] ?? '');
                        $client_photo = htmlspecialchars($row['client_photo'] ?? '');

                        // ==========================================
                        // DYNAMIC IMAGE LOGIC
                        // ==========================================
                        if (!empty($client_photo)) {
                            $img_path = "admin/assets/img/uploads/" . $client_photo;
                        } else {
                            $img_path = "https://ui-avatars.com/api/?name=" . urlencode($client_name) . "&background=C49B3B&color=fff";
                        }

                        // ==========================================
                        // DESIGNATION LOGIC (Title, Company)
                        // ==========================================
                        $designation = $client_title;
                        if (!empty($client_company)) {
                            // Agar title nahi hai par company hai, toh comma aage na aaye
                            $designation .= (!empty($designation) ? ", " : "") . $client_company;
                        }
                ?>

                        <!-- DYNAMIC TESTIMONIAL CARD -->
                        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                            <div class="testimonial-box">
                                <i class="fa-solid fa-quote-left quote-icon"></i>

                                <p class="testimonial-text">
                                    <?php echo $text; ?>
                                </p>

                                <div class="client-info">
                                    <!-- Dynamic Image -->
                                    <img src="<?php echo $img_path; ?>" alt="<?php echo $client_name; ?>" class="client-img" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($client_name); ?>&background=C49B3B&color=fff'">

                                    <div class="client-details">
                                        <h5><?php echo $client_name; ?></h5>
                                        <span><?php echo $designation; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>


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
            <div class="section-header-flex" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
                <h2 class="section-main-title title-with-line">Latest News</h2>
                <a href="blogs.php" class="btn-view-all">View All News <i class="fa-solid fa-arrow-right-long ms-1"></i></a>
            </div>

            <!-- Blog Grid -->
            <div class="row g-4">

                <?php
                if ($resultBLog && $resultBLog->num_rows > 0) {
                    while ($row = $resultBLog->fetch_assoc()) {
                        $blog_id = $row['id'];
                        $title = htmlspecialchars($row['title']);
                        $author = !empty($row['author']) ? htmlspecialchars($row['author']) : "Admin";
                        $date = date('d M, Y', strtotime($row['created_at']));

                        // Decode full content (For Modal)
                        $raw_content = html_entity_decode($row['content']);

                        // Excerpt for the Card (stripped of tags)
                        $clean_text = strip_tags($raw_content);
                        $excerpt = mb_strlen($clean_text) > 120 ? mb_substr($clean_text, 0, 120) . "..." : $clean_text;

                        $img_path = !empty($row['image']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['image']) : "https://placehold.co/800x600/eeeeee/999999?text=Blog+Image";
                ?>
                        <!-- DYNAMIC BLOG POST -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="blog-card" style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">

                                <div class="blog-img-wrapper" style="height: 220px; overflow: hidden;">
                                    <img src="<?php echo $img_path; ?>" alt="<?php echo $title; ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'">
                                </div>

                                <div class="blog-content" style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">

                                    <div class="blog-meta" style="font-size: 13px; color: #777; margin-bottom: 10px;">
                                        <span class="me-3"><i class="fa-regular fa-calendar" style="color: var(--primary-gold, #C49B3B);"></i> <?php echo $date; ?></span>
                                        <span><i class="fa-solid fa-user-pen" style="color: var(--primary-gold, #C49B3B);"></i> <?php echo $author; ?></span>
                                    </div>

                                    <h3 class="blog-title" style="font-size: 18px; font-weight: 700; margin-bottom: 12px; color: var(--primary-blue, #0A192F);"><?php echo $title; ?></h3>

                                    <!-- Excerpt (Short details) add kiya hai -->
                                    <p style="font-size: 14px; color: #666; margin-bottom: 20px; line-height: 1.6;"><?php echo $excerpt; ?></p>

                                    <!-- MODAL TRIGGER BUTTON (href hata kar data-bs-target lagaya hai) -->
                                    <div class="mt-auto">
                                        <a href="javascript:void(0);" class="read-more-link" style="font-weight: 600; color: var(--primary-blue, #0A192F); text-decoration: none;" data-bs-toggle="modal" data-bs-target="#homeBlogModal<?php echo $blog_id; ?>">
                                            Read Article <i class="fa-solid fa-chevron-right" style="font-size: 12px; margin-left: 5px;"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- ==========================================
                             START: MODAL POPUP FOR THIS SPECIFIC BLOG 
                        =============================================== -->
                        <div class="modal fade" id="homeBlogModal<?php echo $blog_id; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" style="border: none; border-radius: 12px;">

                                    <div class="modal-header" style="background-color: var(--primary-blue, #0A192F); color: #ffffff; border-bottom: 4px solid var(--primary-gold, #C49B3B); padding: 20px 25px;">
                                        <h5 class="modal-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;"><?php echo $title; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1) grayscale(100%) brightness(200%);"></button>
                                    </div>

                                    <div class="modal-body" style="padding: 30px;">
                                        <!-- Featured Image in Modal -->
                                        <img src="<?php echo $img_path; ?>" alt="<?php echo $title; ?>" onerror="this.style.display='none'" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">

                                        <!-- Meta Info -->
                                        <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #555; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eaeaea;">
                                            <span class="me-4"><i class="fa-solid fa-user-pen" style="color: var(--primary-gold, #C49B3B);"></i> Author: <strong><?php echo $author; ?></strong></span>
                                            <span><i class="fa-regular fa-calendar-days" style="color: var(--primary-gold, #C49B3B);"></i> Published: <strong><?php echo $date; ?></strong></span>
                                        </div>

                                        <!-- Full HTML Content (From CKEditor) -->
                                        <div style="font-family: 'Poppins', sans-serif; color: #444; line-height: 1.8; font-size: 15.5px;">
                                            <?php echo $raw_content; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                <?php
                    } // end while loop
                } else {
                    echo "<div class='col-12 text-center py-4'><p class='text-muted'>No latest news available right now.</p></div>";
                }
                ?>

            </div>
        </div>
    </section>
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