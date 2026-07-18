<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $pageTitle = "Contact us";
    include("./include/header.php");
    include("./include/breadcrumb.php");
    ?>


    <section class="contact-page-section">
        <div class="container">

            <h2 class="section-main-title">Get In Touch With Us</h2>

            <!-- ==========================================
             TOP ROW: CONTACT INFORMATION CARDS
        =============================================== -->
            <div class="row g-4 justify-content-center">

                <!-- Address Card -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-card">
                        <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <h4>Head Office</h4>
                        <p>Bharuch, Gujarat<br>India</p>
                    </div>
                </div>

                <!-- Phone Card -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-card">
                        <div class="contact-icon"><i class="fa-solid fa-phone-volume"></i></div>
                        <h4>Call Us Directly</h4>
                        <a href="tel:+916354765516">+91 63547 65516</a>
                        <a href="tel:+918980432156">+91 89804 32156</a>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-card">
                        <div class="contact-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                        <h4>Email Support</h4>
                        <a href="mailto:Khetarpaltradingc@gmail.com">Khetarpaltradingc@gmail.com</a>
                        <p>We usually reply within 24 hours.</p>
                    </div>
                </div>

            </div>

            <!-- ==========================================
             BOTTOM ROW: CONTACT FORM & MAP SPLIT
        =============================================== -->
            <div class="form-map-wrapper">
                <div class="row g-0"> <!-- g-0 removes gap between columns to stick map and form together -->

                    <!-- Left Side: Contact Form (Backend ready) -->
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-form-box">
                            <h3>Send Us a Message</h3>

                            <!-- Form processing logic yahan add hogi -->
                            <form action="admin/process-contact.php" method="POST">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name *" required>
                                    </div>
                                    <!-- Email -->
                                    <div class="col-md-6 form-group">
                                        <input type="email" name="email_id" class="form-control" placeholder="Email Address *" required>
                                    </div>
                                    <!-- Phone -->
                                    <div class="col-md-6 form-group">
                                        <input type="tel" name="phone_no" class="form-control" placeholder="Phone / WhatsApp No. *" required>
                                    </div>
                                    <!-- Company Name (B2B specific) -->
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                                    </div>
                                    <!-- Interested Product -->
                                    <div class="col-12 form-group">
                                        <select name="interested_product" class="form-control">
                                            <option value="" disabled selected>Interested Product Inquiry...</option>
                                            <option value="Jeera / Cumin Seeds">Jeera / Cumin Seeds</option>
                                            <option value="Ajmo / Ajwain">Ajmo / Ajwain</option>
                                            <option value="Isabgul / Psyllium">Isabgul / Psyllium Husk</option>
                                            <option value="Chana / Chickpeas">Chana / Chickpeas</option>
                                            <option value="Other">Other Products</option>
                                        </select>
                                    </div>
                                    <!-- Message -->
                                    <div class="col-12 form-group">
                                        <textarea name="message" class="form-control" placeholder="Your Requirements (Quantity, Destination Port, etc.) *" required></textarea>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn-submit-form">Send Inquiry <i class="fa-solid fa-paper-plane ms-2"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Right Side: Google Map -->
                    <div class="col-lg-6 col-md-12">
                        <div class="map-box">
                            <!-- Google Map Embed Code for Bharuch, Gujarat -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118106.70010221667!2d72.92348395!3d21.7051358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be020a1122a6139%3A0x803d21b7596ffeb2!2sBharuch%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1716380000000!5m2!1sen!2sin"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <?php
    include("./include/footer.php");
    ?>
</body>

</html>