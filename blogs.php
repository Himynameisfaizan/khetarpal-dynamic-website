<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $pageTitle = "Blog";
    include("./include/header.php");
    include("./include/breadcrumb.php");
    ?>


    <section class="blog-page-section">
        <div class="container">

            <h2 class="section-main-title">Latest Market Insights</h2>

            <div class="row g-4 justify-content-center">

                <!-- PHP LOOP YAHAN SE SHURU HOGA -->
                <!-- 
            <?php
            // $sql = "SELECT * FROM blogs ORDER BY created_at DESC";
            // $result = $conn->query($sql);
            // while($row = $result->fetch_assoc()) { 
            ?> 
            -->

                <!-- BLOG CARD 1 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="blog-card">
                        <div class="blog-img-wrapper">
                            <!-- DB se image: src="<#?php echo $row['image']; ?>" -->
                            <img src="assets/img/blog/feed/ajwain.jpg" alt="Blog Title" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Blog+Image'">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa-regular fa-calendar"></i> May 20, 2024</span>
                                <span><i class="fa-solid fa-user-pen"></i> Admin</span>
                            </div>
                            <h3 class="blog-title">Cumin Seeds Export From India: Trends & Quality</h3>
                            <p class="blog-excerpt">Explore the latest trends in the export of premium Indian cumin seeds. Understand the quality parameters that global buyers look for.</p>

                            <!-- Modal Trigger Button (ID dynamically set hogi, e.g., #blogModal1) -->
                            <button type="button" class="btn-read-more" data-bs-toggle="modal" data-bs-target="#blogModal1">
                                Read More
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BLOG CARD 2 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="blog-card">
                        <div class="blog-img-wrapper">
                            <img src="assets/img/blog/feed/castor.jpg" alt="Blog Title" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Blog+Image'">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa-regular fa-calendar"></i> May 15, 2024</span>
                                <span><i class="fa-solid fa-user-pen"></i> Admin</span>
                            </div>
                            <h3 class="blog-title">Global Demand For Castor Seeds in 2024</h3>
                            <p class="blog-excerpt">An in-depth analysis of the rising global demand for Indian castor seeds and how Khetarpal Trading Co. is meeting international standards.</p>

                            <button type="button" class="btn-read-more" data-bs-toggle="modal" data-bs-target="#blogModal2">
                                Read More
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BLOG CARD 3 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="blog-card">
                        <div class="blog-img-wrapper">
                            <img src="assets/img/blog/feed/fennel.jpg" alt="Blog Title" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=Blog+Image'">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa-regular fa-calendar"></i> May 05, 2024</span>
                                <span><i class="fa-solid fa-user-pen"></i> Admin</span>
                            </div>
                            <h3 class="blog-title">India's Agricultural Export Growth and Future</h3>
                            <p class="blog-excerpt">Learn about the growth trajectory of India's agro-export sector and the key commodities driving this massive economic shift.</p>

                            <button type="button" class="btn-read-more" data-bs-toggle="modal" data-bs-target="#blogModal3">
                                Read More
                            </button>
                        </div>
                    </div>
                </div>

                <!-- PHP LOOP YAHAN KHATAM HOGA -->
                <!-- <?php // } 
                        ?> -->

            </div>
        </div>
    </section>


    <!-- ==========================================
     START: MODALS (Popups for Blogs)
     Ye modal bhi ek alag loop me chalenge taaki cards ke sath interfere na karein
=============================================== -->

    <!-- Modal 1 -->
    <div class="modal fade" id="blogModal1" tabindex="-1" aria-labelledby="blogModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel1">Cumin Seeds Export From India: Trends & Quality</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-blog-meta">
                        <span><i class="fa-regular fa-calendar"></i> Published on: May 20, 2024</span>
                        <span><i class="fa-solid fa-user-pen"></i> Author: Admin</span>
                    </div>

                    <img src="assets/img/blog/feed/ajwain.jpg" alt="Blog Image" class="modal-featured-img" onerror="this.src='https://placehold.co/1000x500/eeeeee/999999?text=Full+Blog+Image'">

                    <!-- Blog Full Content (DB se aayega) -->
                    <p>India holds a prominent position in the global spice market, and cumin seeds (Jeera) are among its top exports. With a robust agricultural framework, Indian cumin is renowned for its intense flavor, strong aroma, and high essential oil content, making it highly sought after in international markets such as the Middle East, Europe, and the Americas.</p>

                    <p>Ensuring export-quality cumin requires stringent quality control measures. Global buyers demand specific purity levels, typically ranging from 99% to 99.5%, along with proper moisture control to prevent fungal growth during long transits. At Khetarpal Trading Co., our automated sortex cleaning facilities guarantee that every batch meets these exacting standards, providing our B2B partners with uncompromised quality.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Article</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="blogModal2" tabindex="-1" aria-labelledby="blogModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel2">Global Demand For Castor Seeds in 2024</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-blog-meta">
                        <span><i class="fa-regular fa-calendar"></i> Published on: May 15, 2024</span>
                        <span><i class="fa-solid fa-user-pen"></i> Author: Admin</span>
                    </div>
                    <img src="assets/img/blog/feed/castor.jpg" alt="Blog Image" class="modal-featured-img" onerror="this.src='https://placehold.co/1000x500/eeeeee/999999?text=Full+Blog+Image'">
                    <p>The global demand for castor seeds and its derivatives has seen a significant surge in 2024. As industries shift towards sustainable and bio-based alternatives, castor oil is finding extensive applications in pharmaceuticals, cosmetics, lubricants, and bioplastics. India, being the world's largest producer of castor seeds, is at the forefront of supplying this crucial commodity to the global market.</p>
                    <p>For importers, securing a steady and reliable supply chain is critical. Partnering with established exporters like Khetarpal Trading Co. ensures consistent volume availability, competitive wholesale pricing, and adherence to international packaging and shipping standards.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Article</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="blogModal3" tabindex="-1" aria-labelledby="blogModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel3">India's Agricultural Export Growth and Future</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-blog-meta">
                        <span><i class="fa-regular fa-calendar"></i> Published on: May 05, 2024</span>
                        <span><i class="fa-solid fa-user-pen"></i> Author: Admin</span>
                    </div>
                    <img src="assets/img/blog/feed/fennel.jpg" alt="Blog Image" class="modal-featured-img" onerror="this.src='https://placehold.co/1000x500/eeeeee/999999?text=Full+Blog+Image'">
                    <p>India's agricultural export sector is undergoing a massive transformation. Government initiatives, improved farming techniques, and advanced processing infrastructure have propelled Indian agro-commodities to the global center stage. From premium spices to essential grains and pulses, the diversity and quality of Indian produce are unmatched.</p>
                    <p>Looking ahead, the focus is increasingly on value-added products and sustainable practices. As international buyers prioritize traceability and hygiene, Indian exporters are upgrading their facilities to meet these demands. Khetarpal Trading Co. is proud to be part of this growth story, delivering excellence in every shipment.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Article</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("./include/footer.php");
    ?>
</body>

</html>