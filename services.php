<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $pageTitle = 'Our Services';
    include("./include/header.php");
    include ("./include/breadcrumb.php");
    ?>

    <section class="services-page-section">
        <div class="container">

            <h2 class="section-main-title">Our Premium Services</h2>

            <!-- justify-content-center centers the 4th and 5th card -->
            <div class="row g-4 justify-content-center">

                <!-- SERVICE 1 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="service-card">
                        <div class="service-img-wrapper">
                            <img src="assets/img/blog/feed/ajwain.jpg" alt="Agricultural Product Export" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Agro+Export'">
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">1. Agricultural Product Export</h3>
                            <p class="service-desc">We export premium quality Indian spices and agro products globally.</p>
                            <!-- Modal Trigger Button -->
                            <button type="button" class="btn-view-service" data-bs-toggle="modal" data-bs-target="#serviceModal1">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SERVICE 2 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="service-card">
                        <div class="service-img-wrapper">
                            <img src="assets/img/blog/feed/castor.jpg" alt="Bulk Supply" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Bulk+Supply'">
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">2. Bulk Supply</h3>
                            <p class="service-desc">We provide bulk quantity supply for wholesalers, importers, and distributors.</p>
                            <button type="button" class="btn-view-service" data-bs-toggle="modal" data-bs-target="#serviceModal2">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SERVICE 3 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="service-card">
                        <div class="service-img-wrapper">
                            <img src="assets/img/blog/feed/fennel.jpg" alt="Custom Packaging" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Custom+Packaging'">
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">3. Custom Packaging</h3>
                            <p class="service-desc">Export-standard customized packaging solutions available as per buyer requirements.</p>
                            <button type="button" class="btn-view-service" data-bs-toggle="modal" data-bs-target="#serviceModal3">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SERVICE 4 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="service-card">
                        <div class="service-img-wrapper">
                            <img src="assets/img/blog/feed/chickpeas.jpg" alt="Quality Inspection" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Quality+Inspection'">
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">4. Quality Inspection</h3>
                            <p class="service-desc">Every shipment is rigorously quality checked before dispatch.</p>
                            <button type="button" class="btn-view-service" data-bs-toggle="modal" data-bs-target="#serviceModal4">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SERVICE 5 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="service-card">
                        <div class="service-img-wrapper">
                            <img src="assets/img/product/category/mustard.jpg" alt="International Shipping" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Shipping+Support'">
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">5. International Shipping</h3>
                            <p class="service-desc">Complete export documentation and shipping support for smooth delivery.</p>
                            <button type="button" class="btn-view-service" data-bs-toggle="modal" data-bs-target="#serviceModal5">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
     MODALS (Popups for Services)
=============================================== -->

    <!-- Modal 1 -->
    <div class="modal fade" id="serviceModal1" tabindex="-1" aria-labelledby="serviceModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel1">Agricultural Product Export</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/blog/feed/ajwain.jpg" alt="Agro Export" onerror="this.src='https://placehold.co/800x400/eeeeee/999999?text=Agro+Export'">
                    <p><strong>We export premium quality Indian spices and agro products globally.</strong></p>
                    <p>Our expansive network and deep-rooted connections with local Indian farmers allow us to source the finest quality agricultural commodities. From authentic spices to staple agro products, we ensure that the global market experiences the true essence and purity of Indian agriculture.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="serviceModal2" tabindex="-1" aria-labelledby="serviceModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel2">Bulk Supply</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/blog/feed/castor.jpg" alt="Bulk Supply" onerror="this.src='https://placehold.co/800x400/eeeeee/999999?text=Bulk+Supply'">
                    <p><strong>We provide bulk quantity supply for wholesalers, importers, and distributors.</strong></p>
                    <p>Scalability is at the core of our operations. Khetarpal Trading Co. is fully equipped to handle large-scale volume requirements consistently. We guarantee a steady supply chain, ensuring our B2B partners, distributors, and wholesalers never face inventory shortages.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="serviceModal3" tabindex="-1" aria-labelledby="serviceModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel3">Custom Packaging</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/blog/feed/fennel.jpg" alt="Custom Packaging" onerror="this.src='https://placehold.co/800x400/eeeeee/999999?text=Custom+Packaging'">
                    <p><strong>Export-standard customized packaging solutions available as per buyer requirements.</strong></p>
                    <p>We understand that packaging plays a vital role in preserving the freshness and quality of agricultural products during transit. We offer highly customizable packing options—from bulk 50kg PP bags to customized retail-ready packaging—strictly adhering to international hygiene and moisture-control standards.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4 -->
    <div class="modal fade" id="serviceModal4" tabindex="-1" aria-labelledby="serviceModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel4">Quality Inspection</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/blog/feed/chickpeas.jpg" alt="Quality Inspection" onerror="this.src='https://placehold.co/800x400/eeeeee/999999?text=Quality+Inspection'">
                    <p><strong>Every shipment is quality checked before dispatch.</strong></p>
                    <p>Quality is non-negotiable. Our dedicated quality assurance team conducts rigorous multi-stage inspections. We utilize advanced cleaning, sorting, and grading processes to ensure that only 100% pure, unadulterated, and export-grade products make it into your shipment.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 5 -->
    <div class="modal fade" id="serviceModal5" tabindex="-1" aria-labelledby="serviceModalLabel5" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel5">International Shipping Support</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/product/category/mustard.jpg" alt="Shipping Support" onerror="this.src='https://placehold.co/800x400/eeeeee/999999?text=Shipping+Support'">
                    <p><strong>Complete export documentation and shipping support for smooth delivery.</strong></p>
                    <p>Navigating cross-border trade can be complex. We simplify this for our clients by handling end-to-end logistics. From managing port forwarding and customs clearances to preparing all mandatory export documentation (Phytosanitary certificates, Certificate of Origin, etc.), we ensure a hassle-free delivery to your destination port.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("./include/footer.php");
    ?>
</body>

</html>