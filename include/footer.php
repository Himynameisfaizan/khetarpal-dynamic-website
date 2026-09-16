<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <footer class="site-footer">
        <div class="container">
            <!-- Footer Top Content -->
            <div class="footer-top">
                <div class="row">

                    <!-- Widget 1: Brand & Social -->
                    <div class="col-lg-3 col-md-6 footer-widget">
                        <div class="footer-brand">
                            <!-- Optional Logo Image (Uncomment and set src if you have one) -->
                            <!-- <img src="assets/img/logo/khetarpal-logo-light.png" alt="Khetarpal Trading Co." class="footer-logo"> -->

                            <!-- Text Logo (Used as fallback based on design) -->
                            <a href="index.php" class="footer-text-logo">
                                KHETARPAL<br>
                                <span>TRADING CO.</span>
                            </a>

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
                            <!-- Split links into 2 columns for neatness -->
                            <div class="col-6">
                                <ul class="footer-links">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="product.php">Products</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="footer-links">
                                    <li><a href="blogs.php">Blog</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                    <li><a href="privacy.php">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Widget 3: Our Products -->
                    <div class="col-lg-3 col-md-6 footer-widget">
                        <h4 class="footer-title">OUR PRODUCTS</h4>
                        <div class="row">
                            <div class="col-6">
                                <ul class="footer-links">
                                    <li><a href="#">Cumin Seeds</a></li>
                                    <li><a href="#">Psyllium Husk</a></li>
                                    <li><a href="#">Castor Seeds</a></li>
                                    <li><a href="#">Fennel Seeds</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="footer-links">
                                    <li><a href="#">Ajwain Seeds</a></li>
                                    <li><a href="#">Desi Chickpeas</a></li>
                                    <li><a href="#">Peanuts</a></li>
                                    <li><a href="#">Green Chilli</a></li>
                                </ul>
                            </div>
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
                                <a href="tel:+919876543210">+91 89804 32156</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:+919876543210"> +91 63547 65516</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:khetarpaltradingc@gmail.com">khetarpaltradingc@gmail.com</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-globe"></i>
                                <a href="[http://www.khetarpaltradingco.com](http://www.khetarpaltradingco.com)" target="_blank">[www.khetarpaltradingco.com](https://www.khetarpaltradingco.com)</a>
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
                            &copy; 2024 <span>Khetarpal Trading Co.</span> All Rights Reserved.
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

    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="assets/js/main.js"></script>


</body>

</html>