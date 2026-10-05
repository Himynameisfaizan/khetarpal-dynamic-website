    <?php
    include("./admin/db-conn.php");
    $pageTitle = 'About us';
    include("./include/header.php");
    include('./include/breadcrumb.php');
    ?>

    <main>
        <!-- ==========================================
         1. COMPANY INTRODUCTION SECTION (Left/Right)
    =============================================== -->
        <section class="about-intro-sec section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Image Side -->
                    <div class="col-lg-5">
                        <div class="intro-img-box">
                            <img src="assets/img/blog/feed/castor.jpg" alt="Company Intro" onerror="this.src='https://placehold.co/600x700/eeeeee/999999?text=Company+Building'">
                        </div>
                    </div>
                    <!-- Content Side -->
                    <div class="col-lg-7">
                        <div class="intro-content">
                            <span class="intro-subtitle">Who We Are</span>
                            <h2 class="intro-title">Welcome to Khetarpal Trading Co.</h2>
                            <div class="intro-text">
                                <!-- EXPANDED CONTENT -->
                                <p>Khetarpal Trading Co. is a premier Indian agricultural export company, deeply committed to sourcing, processing, and delivering high-quality spices and agro products to international markets.</p>
                                <p>With a rich heritage in agriculture and a passion for excellence, we bridge the gap between local Indian farmers and global buyers. Our dedicated team ensures that the authentic taste, aroma, and purity of Indian spices reach every corner of the world, making us a preferred partner in the global food industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================
         2. WHAT WE DO SECTION (Centered)
    =============================================== -->
        <section class="wwd-sec section-padding">
            <div class="container">
                <h2 class="section-title-center">What We Do</h2>
                <div class="wwd-content">
                    <!-- EXPANDED CONTENT -->
                    <p>We specialize in the bulk export of premium agricultural commodities. Meticulously overseeing every step of the supply chain—from procurement at local farms to processing and customized packaging—we maintain strict quality standards to meet the diverse and exacting needs of our international clients.</p>

                    <!-- Nice visual tags for products -->
                    <div class="wwd-tags">
                        <span>Jeera (Cumin)</span>
                        <span>Ajmo (Ajwain)</span>
                        <span>Isabgul (Psyllium)</span>
                        <span>Chana (Chickpeas)</span>
                        <span>Premium Spices</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================
         3. MISSION & VISION SECTION (2 Columns)
    =============================================== -->
        <section class="mv-sec section-padding">
            <div class="container">
                <div class="row g-4">

                    <!-- Mission Card -->
                    <div class="col-md-6">
                        <div class="mv-card">
                            <i class="fa-solid fa-bullseye mv-icon"></i>
                            <h3 class="mv-title">Our Mission</h3>
                            <!-- EXPANDED CONTENT -->
                            <p>Our mission is to provide pure, authentic, and premium Indian agricultural products to customers worldwide. We strive to maintain the highest levels of food safety and hygiene, while promoting sustainable farming practices that benefit both our growers and the global community.</p>
                        </div>
                    </div>

                    <!-- Vision Card -->
                    <div class="col-md-6">
                        <div class="mv-card">
                            <i class="fa-solid fa-eye mv-icon"></i>
                            <h3 class="mv-title">Our Vision</h3>
                            <!-- EXPANDED CONTENT -->
                            <p>To become a globally recognized and trusted supplier of Indian spices and agro commodities. We aim to build long-lasting, mutually beneficial relationships with our clients by consistently delivering excellence, reliability, and value in every single shipment we dispatch.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ==========================================
         4. OUR STRENGTHS SECTION (Grid Layout)
    =============================================== -->
        <section class="strengths-sec section-padding">
            <div class="container">
                <h2 class="section-title-center">Our Strengths</h2>

                <div class="row g-4 justify-content-center">
                    <!-- Strength 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="strength-item">
                            <i class="fa-solid fa-award strength-icon"></i>
                            <h5>Quality Products</h5>
                            <p>We supply 100% natural, sorted, and hygienic agricultural commodities passing rigorous quality checks.</p>
                        </div>
                    </div>
                    <!-- Strength 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="strength-item">
                            <i class="fa-solid fa-network-wired strength-icon"></i>
                            <h5>Strong Supplier Network</h5>
                            <p>Direct sourcing from trusted local farmers ensures freshness and competitive pricing.</p>
                        </div>
                    </div>
                    <!-- Strength 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="strength-item">
                            <i class="fa-solid fa-box-open strength-icon"></i>
                            <h5>Export Packaging</h5>
                            <p>Customized, moisture-proof, and safe packaging solutions tailored to buyer requirements.</p>
                        </div>
                    </div>
                    <!-- Strength 4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="strength-item">
                            <i class="fa-solid fa-ship strength-icon"></i>
                            <h5>Timely Shipment</h5>
                            <p>Efficient logistics and documentation processing to guarantee on-time global deliveries.</p>
                        </div>
                    </div>
                    <!-- Strength 5 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="strength-item">
                            <i class="fa-solid fa-handshake-angle strength-icon"></i>
                            <h5>Customer Satisfaction</h5>
                            <p>Dedicated 24/7 support and transparent communication to build lasting B2B relationships.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("./include/footer.php"); ?>
    </body>

    </html>