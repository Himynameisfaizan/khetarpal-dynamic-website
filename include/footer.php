<?php
$footer_about_text = "Khetarpal Trading Co. is a leading exporter of premium agricultural commodities from India.";
if(isset($conn)) {
    $about_q = mysqli_query($conn, "SELECT content FROM about_us LIMIT 1");
    if($about_q && mysqli_num_rows($about_q) > 0){
        $about_row = mysqli_fetch_assoc($about_q);
        $clean_about = strip_tags(html_entity_decode($about_row['content']));
        $footer_about_text = mb_strlen($clean_about) > 130 ? mb_substr($clean_about, 0, 130) . "..." : $clean_about;
    }
}
?>

    <footer class="site-footer mt-5">
        <div class="container">
            <!-- Footer Top Content -->
            <div class="footer-top">
                <div class="row">

                    <!-- Widget 1: Brand & Social -->
                    <div class="col-lg-3 col-md-6 footer-widget">
                        <div class="footer-brand">
                            <a href="index.php" class="footer-text-logo">
                                KHETARPAL<br>
                                <span>TRADING CO.</span>
                            </a>
                            
                            <!-- Dynamic About Text -->
                            <p style="font-size: 14px; color: #b0b0b0; margin-top: 15px; margin-bottom: 20px; line-height: 1.6;">
                                <?php echo $footer_about_text; ?>
                            </p>

                            <!-- Social Links matching design -->
                            <ul class="footer-social">
                                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Widget 2: Quick Links -->
                    <div class="col-lg-3 col-md-6 footer-widget">
                        <h4 class="footer-title">QUICK LINKS</h4>
                        <div class="row">
                            <div class="col-6">
                                <ul class="footer-links">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="services.php">Services</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="footer-links">
                                    <li><a href="blogs.php">Blog</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                    <li><a href="product.php">All Products</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Widget 3: Dynamic Categories -->
                    <div class="col-lg-3 col-md-6 footer-widget">
                        <h4 class="footer-title">CATEGORIES</h4>
                        <div class="row">
                            <?php 
                            if(isset($conn)) {
                                $footer_cat_query = "SELECT categories, slug_url FROM categories WHERE status = 1 ORDER BY categories ASC LIMIT 8";
                                $footer_cat_result = mysqli_query($conn, $footer_cat_query);
                                
                                if($footer_cat_result && mysqli_num_rows($footer_cat_result) > 0) {
                                    $all_cats = [];
                                    while($c = mysqli_fetch_assoc($footer_cat_result)){
                                        $all_cats[] = $c;
                                    }
                                    
                                    // Split categories into two columns automatically
                                    $half = ceil(count($all_cats) / 2);
                                    $col1 = array_slice($all_cats, 0, $half);
                                    $col2 = array_slice($all_cats, $half);
                                    
                                    echo '<div class="col-6"><ul class="footer-links">';
                                    foreach($col1 as $cat1){
                                        echo '<li><a href="category.php?slug='.htmlspecialchars($cat1['slug_url']).'">'.htmlspecialchars($cat1['categories']).'</a></li>';
                                    }
                                    echo '</ul></div>';
                                    
                                    echo '<div class="col-6"><ul class="footer-links">';
                                    foreach($col2 as $cat2){
                                        echo '<li><a href="category.php?slug='.htmlspecialchars($cat2['slug_url']).'">'.htmlspecialchars($cat2['categories']).'</a></li>';
                                    }
                                    echo '</ul></div>';
                                } else {
                                    echo "<p style='color:#777; font-size:14px;'>Categories unavailable.</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Widget 4: Contact Us -->
                    <div class="col-lg-3 col-md-6 footer-widget">
                        <h4 class="footer-title">CONTACT US</h4>
                        <ul class="footer-contact">
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <span>155, APMC Market Yard,<br>Tharad, Gujarat, India - 385565</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:+918980432156">+91 89804 32156</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:+916354765516">+91 63547 65516</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:khetarpaltradingc@gmail.com">khetarpaltradingc@gmail.com</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-globe"></i>
                                <a href="https://www.khetarpalinternational.com" target="_blank">www.khetarpalinternational.com</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Bottom (Copyright) -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="copyright-text">
                            &copy; <?php echo date("Y"); ?> <span>Khetarpal Trading Co.</span> All Rights Reserved. Design & Developed by <a href="https://www.digitalwebtrackers.com" target="_blank" style="text-decoration: none;"><span>Digital Web Trackers</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ::::::  End  Footer ::::::  -->

    <!-- ::::::  Start Request to Qoute ::::::  -->
    <div class="modal fade quote-modal" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="quote-modal-header">
                    <h5 class="quote-modal-title" id="quoteModalLabel">Request A Quote</h5>
                    <p class="quote-modal-subtitle">Fill out the form below and our export team will get back to you with the best wholesale prices.</p>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="quote-modal-body">
                    <!-- Action set to your backend processing file -->
                    <form action="admin/process-quote.php" method="POST">
                        <div class="row">

                            <!-- Personal Info -->
                            <div class="col-md-6 quote-form-group">
                                <label>Full Name *</label>
                                <input type="text" name="name" class="quote-form-control" placeholder="John Doe" required>
                            </div>

                            <div class="col-md-6 quote-form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" class="quote-form-control" placeholder="john@company.com" required>
                            </div>

                            <!-- Business Info -->
                            <div class="col-md-6 quote-form-group">
                                <label>Phone / WhatsApp *</label>
                                <input type="tel" name="phone" class="quote-form-control" placeholder="With Country Code (+xx)" required>
                            </div>

                            <div class="col-md-6 quote-form-group">
                                <label>Company Name</label>
                                <input type="text" name="company" class="quote-form-control" placeholder="Your Business Name">
                            </div>

                            <!-- Export Requirements -->
                            <div class="col-md-4 quote-form-group">
                                <label>Interested Product *</label>
                                <select name="product" class="quote-form-control" required>
                                    <option value="" disabled selected>Select Product...</option>
                                    <option value="Jeera / Cumin Seeds">Jeera / Cumin Seeds</option>
                                    <option value="Ajmo / Ajwain">Ajmo / Ajwain</option>
                                    <option value="Isabgul / Psyllium">Isabgul / Psyllium</option>
                                    <option value="Chana / Chickpeas">Chana / Chickpeas</option>
                                    <option value="Other">Other Agro Product</option>
                                </select>
                            </div>

                            <div class="col-md-4 quote-form-group">
                                <label>Required Quantity *</label>
                                <input type="text" name="quantity" class="quote-form-control" placeholder="e.g. 20 MT, 1 FCL" required>
                            </div>

                            <div class="col-md-4 quote-form-group">
                                <label>Destination Port / Country *</label>
                                <input type="text" name="destination" class="quote-form-control" placeholder="e.g. Jebel Ali, UAE" required>
                            </div>

                            <!-- Additional Details -->
                            <div class="col-12 quote-form-group">
                                <label>Additional Requirements</label>
                                <textarea name="message" class="quote-form-control" placeholder="Tell us about packaging needs, quality specifications, or any other details..."></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn-submit-quote">
                                    Get Your Quote <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
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

    <script src="assets/js/main.js"></script>


</body>

</html>