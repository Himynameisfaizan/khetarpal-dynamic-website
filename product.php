<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $pageTitle = "Our Product";
    include("./include/header.php");
    include ("./include/breadcrumb.php");
    ?>

    <section class="products-page-section">
        <div class="container">

            <h2 class="section-main-title">Our Premium Agro Products</h2>

            <!-- Products Grid (PHP LOOP YAHAN SE START HOGA) -->
            <div class="row g-4 justify-content-center">

                <!-- Example of Dynamic PHP Loop Structure:
            <?php
            // $sql = "SELECT * FROM products WHERE status = 'active'";
            // $result = $conn->query($sql);
            // while($row = $result->fetch_assoc()) { 
            ?>
            -->

                <!-- PRODUCT CARD 1 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="b2b-product-card">
                        <div class="prod-img-box">
                            <!-- Yahan DB se image path aayega: src="<#?php echo $row['image']; ?>" -->
                            <img src="assets/img/blog/feed/ajwain.jpg" alt="Jeera (Cumin Seeds)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Cumin+Seeds'">
                        </div>
                        <div class="prod-content">
                            <!-- Title from DB -->
                            <h3 class="prod-title">Jeera (Cumin Seeds)</h3>

                            <!-- Short specs -->
                            <ul class="prod-specs">
                                <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg / 50kg PP Bags</li>
                                <li><i class="fa-solid fa-certificate"></i> <strong>Quality:</strong> &nbsp; 99% / 99.5% Purity</li>
                            </ul>

                            <!-- LINK TO DETAIL PAGE ALONG WITH ID -->
                            <!-- href="product-details.php?id=<#?php echo $row['id']; ?>" -->
                            <a href="product-details.php?id=1" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT CARD 2 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="b2b-product-card">
                        <div class="prod-img-box">
                            <img src="assets/img/blog/feed/fennel.jpg" alt="Ajmo (Ajwain)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Ajwain+Seeds'">
                        </div>
                        <div class="prod-content">
                            <h3 class="prod-title">Ajmo (Ajwain)</h3>
                            <ul class="prod-specs">
                                <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg / 50kg PP Bags</li>
                                <li><i class="fa-solid fa-certificate"></i> <strong>Quality:</strong> &nbsp; Sortex Clean</li>
                            </ul>
                            <!-- Yahan ID 2 paas ho raha hai example ke liye -->
                            <a href="product-details.php?id=2" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT CARD 3 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="b2b-product-card">
                        <div class="prod-img-box">
                            <img src="assets/img/blog/feed/castor.jpg" alt="Isabgul (Psyllium)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Psyllium+Husk'">
                        </div>
                        <div class="prod-content">
                            <h3 class="prod-title">Isabgul (Psyllium Husk)</h3>
                            <ul class="prod-specs">
                                <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg Paper Bags</li>
                                <li><i class="fa-solid fa-certificate"></i> <strong>Quality:</strong> &nbsp; 95% / 99% Purity</li>
                            </ul>
                            <a href="product-details.php?id=3" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT CARD 4 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="b2b-product-card">
                        <div class="prod-img-box">
                            <img src="assets/img/blog/feed/chickpeas.jpg" alt="Chana (Chickpeas)" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Chickpeas'">
                        </div>
                        <div class="prod-content">
                            <h3 class="prod-title">Chana (Chickpeas)</h3>
                            <ul class="prod-specs">
                                <li><i class="fa-solid fa-location-dot"></i> <strong>Origin:</strong> &nbsp; India</li>
                                <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; 25kg / 50kg PP Bags</li>
                                <li><i class="fa-solid fa-certificate"></i> <strong>Quality:</strong> &nbsp; 8mm / 9mm / 12mm</li>
                            </ul>
                            <a href="product-details.php?id=4" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <!-- PHP LOOP YAHAN KHATAM HOGA: <?php // } 
                                                    ?> -->

            </div>
        </div>
    </section>

    <?php
    include("./include/footer.php");
    ?>
</body>

</html>