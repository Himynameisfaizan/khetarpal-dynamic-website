<?php

$pageTitle = "Jeera (Cumin Seeds)";

include("./include/header.php");
include("./include/breadcrumb.php");
?>

<section class="product-details-section">
    <div class="container">

        <!-- TOP SPLIT SECTION -->
        <div class="row">

            <!-- Left: Product Image -->
            <div class="col-lg-5 col-md-12">
                <div class="product-main-img-box">
                    <!-- DB Image here: src="<#?php echo $product['image']; ?>" -->
                    <img src="assets/img/blog/feed/ajwain.jpg" alt="Jeera (Cumin Seeds)" onerror="this.src='https://placehold.co/800x800/eeeeee/999999?text=Product+Image'">
                </div>
            </div>

            <!-- Right: Product Information -->
            <div class="col-lg-7 col-md-12">
                <div class="product-info-wrapper">

                    <!-- DB Title here -->
                    <h1 class="product-detail-title">Jeera (Cumin Seeds)</h1>

                    <!-- DB Short Description -->
                    <p class="product-short-desc">
                        We export premium quality, machine-cleaned, and sortex Indian Cumin Seeds (Jeera). Known for its distinctive aroma and high essential oil content, our cumin meets strict international food safety standards.
                    </p>

                    <!-- Specifications Grid (B2B essential data) -->
                    <div class="spec-grid">

                        <div class="spec-item">
                            <div class="spec-icon"><i class="fa-solid fa-earth-americas"></i></div>
                            <div class="spec-text">
                                <h6>Origin</h6>
                                <p>Gujarat/Rajasthan, India</p> <!-- DB data -->
                            </div>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon"><i class="fa-solid fa-certificate"></i></div>
                            <div class="spec-text">
                                <h6>Purity / Quality</h6>
                                <p>99% / 99.5% Sortex Clean</p> <!-- DB data -->
                            </div>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon"><i class="fa-solid fa-box-open"></i></div>
                            <div class="spec-text">
                                <h6>Packaging</h6>
                                <p>25kg / 50kg PP & Paper Bags</p> <!-- DB data -->
                            </div>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                            <div class="spec-text">
                                <h6>Loading Capacity</h6>
                                <p>14 MT in 20ft Container</p> <!-- DB data -->
                            </div>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="product-action-btns">
                        <!-- YAHAN MAGIC HAI: Ye button wahi footer wala quote modal open karega -->
                        <!-- Extra Javascript lagakar tum modal ke dropdown me is product ko auto-select bhi karwa sakte ho -->
                        <a href="javascript:void(0);" class="btn-action-primary" data-bs-toggle="modal" data-bs-target="#quoteModal">
                            Request A Quote <i class="fa-solid fa-paper-plane"></i>
                        </a>

                        <!-- Contact redirect ya WhatsApp link -->
                        <a href="contact.php" class="btn-action-outline">
                            Contact Us <i class="fa-solid fa-headset"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- BOTTOM: FULL DESCRIPTION TABS/BOX -->
        <div class="row product-full-details">
            <div class="col-12">
                <h3 class="detail-heading">Product Description</h3>

                <div class="detail-content-box">
                    <!-- DB Long Description (Rich text editor content) -->
                    <p><strong>Cumin Seeds (Jeera)</strong> is an essential spice widely used in global cuisines. Cultivated primarily in the fertile lands of Gujarat and Rajasthan, our cumin seeds boast a rich, earthy flavor and an unparalleled aroma due to their high volatile oil content.</p>

                    <p>At Khetarpal Trading Co., we ensure that every batch of cumin is subjected to rigorous cleaning processes, including machine cleaning and advanced Sortex technology. This guarantees the removal of all foreign matter, dust, and immature seeds, leaving only the finest quality product for export.</p>

                    <p><strong>Why Buy From Us?</strong><br>
                        - Guaranteed Moisture levels below 9% to prevent fungal growth during transit.<br>
                        - Cultivated using safe farming practices without harmful pesticides.<br>
                        - Customized packaging solutions tailored exactly to buyer specifications.<br>
                        - Complete export documentation and prompt shipping support provided.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-12">
            <section class="related-products-section">
                <h3 class="related-title">Explore More Products</h3>

                <div class="related-slider-container">
                    <!-- Slide Item 1 -->
                    <div class="related-slide-item">
                        <div class="b2b-product-card">
                            <div class="prod-img-box">
                                <img src="assets/img/blog/feed/fennel.jpg" alt="Ajmo (Ajwain)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Ajwain+Seeds'">
                            </div>
                            <div class="prod-content">
                                <h3 class="prod-title">Ajmo (Ajwain)</h3>
                                <ul class="prod-specs">
                                    <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                    <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg / 50kg Bags</li>
                                </ul>
                                <!-- Yahan backend ID paas hogi -->
                                <a href="product-details.php?id=2" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Item 2 -->
                    <div class="related-slide-item">
                        <div class="b2b-product-card">
                            <div class="prod-img-box">
                                <img src="assets/img/blog/feed/castor.jpg" alt="Isabgul (Psyllium)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Psyllium+Husk'">
                            </div>
                            <div class="prod-content">
                                <h3 class="prod-title">Isabgul (Psyllium)</h3>
                                <ul class="prod-specs">
                                    <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                    <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg Paper Bags</li>
                                </ul>
                                <a href="product-details.php?id=3" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Item 3 -->
                    <div class="related-slide-item">
                        <div class="b2b-product-card">
                            <div class="prod-img-box">
                                <img src="assets/img/blog/feed/chickpeas.jpg" alt="Chana (Chickpeas)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Chickpeas'">
                            </div>
                            <div class="prod-content">
                                <h3 class="prod-title">Chana (Chickpeas)</h3>
                                <ul class="prod-specs">
                                    <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                    <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg / 50kg PP Bags</li>
                                </ul>
                                <a href="product-details.php?id=4" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Item 4 -->
                    <div class="related-slide-item">
                        <div class="b2b-product-card">
                            <div class="prod-img-box">
                                <img src="assets/img/product/category/mustard.jpg" alt="Mustard Seeds" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Mustard+Seeds'">
                            </div>
                            <div class="prod-content">
                                <h3 class="prod-title">Mustard Seeds</h3>
                                <ul class="prod-specs">
                                    <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                    <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg / 50kg Bags</li>
                                </ul>
                                <a href="product-details.php?id=5" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Yahan PHP loop khatam hoga -->

                </div>
            </section>
        </div>
    </div>
</div>
</main>


<?php include("./include/footer.php"); ?>