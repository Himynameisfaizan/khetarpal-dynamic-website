<?php
include("./admin/db-conn.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    header("Location: product.php");
    exit;
}

$sql = "SELECT p.*, c.categories AS category_name 
        FROM products p
        LEFT JOIN categories c ON p.pro_cate = c.cate_id 
        WHERE p.pro_id = ? AND p.status = 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2 style='text-align:center; padding: 100px 0;'>Product not found!</h2>";
    echo "<div style='text-align:center;'><a href='product.php'>Go Back to Products</a></div>";
    exit;
}

$product = $result->fetch_assoc();

$pro_name = htmlspecialchars($product['pro_name']);
$category = !empty($product['category_name']) ? htmlspecialchars($product['category_name']) : "Agro Product";
$packaging = !empty($product['qty']) ? htmlspecialchars($product['qty']) : "Custom packaging available";
$short_desc = !empty($product['short_desc']) ? html_entity_decode($product['short_desc']) : "Premium quality agricultural product exported by Khetarpal Trading Co.";
$long_desc = !empty($product['description']) ? $product['description'] : "<p>Detailed description will be updated soon.</p>";

$mrp = !empty($product['mrp']) ? floatval($product['mrp']) : 0;
$selling_price = !empty($product['selling_price']) ? floatval($product['selling_price']) : 0;

$img_path = !empty($product['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($product['pro_img']) : "https://placehold.co/800x800/eeeeee/999999?text=No+Image";

$pageTitle = $pro_name;
include("./include/header.php");
include("./include/breadcrumb.php");
?>

<main>
    <section class="product-details-section">
        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="product-main-img-box">
                        <img src="<?php echo $img_path; ?>" alt="<?php echo $pro_name; ?>" onerror="this.src='https://placehold.co/800x800/eeeeee/999999?text=Image+Not+Found'">
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="product-info-wrapper">

                        <h1 class="product-detail-title"><?php echo $pro_name; ?></h1>

                        <div class="prod-price-box" style="margin-bottom: 20px;">
                            <?php if ($mrp > $selling_price && $selling_price > 0) { ?>
                                <span style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 26px; color: var(--primary-gold, #C49B3B);">
                                    ₹<?php echo number_format($selling_price, 2); ?>
                                </span>
                                <del style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 18px; color: #999999; margin-left: 10px;">
                                    ₹<?php echo number_format($mrp, 2); ?>
                                </del>
                            <?php } elseif ($selling_price > 0) { ?>
                                <span style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 26px; color: var(--primary-gold, #C49B3B);">
                                    ₹<?php echo number_format($selling_price, 2); ?>
                                </span>
                            <?php } else { ?>
                                <span style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 20px; color: var(--primary-blue, #0A192F);">
                                    Price on Request
                                </span>
                            <?php } ?>
                        </div>

                        <div class="product-short-desc"><?php echo $short_desc; ?></div>

                        <div class="spec-grid">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-layer-group"></i></div>
                                <div class="spec-text">
                                    <h6>Category</h6>
                                    <p><?php echo $category; ?></p>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-box-open"></i></div>
                                <div class="spec-text">
                                    <h6>Packaging</h6>
                                    <p><?php echo $packaging; ?></p>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-certificate"></i></div>
                                <div class="spec-text">
                                    <h6>Status</h6>
                                    <p>Ready for Export</p>
                                </div>
                            </div>
                            <?php if (!empty($product['sku'])) { ?>
                                <div class="spec-item">
                                    <div class="spec-icon"><i class="fa-solid fa-barcode"></i></div>
                                    <div class="spec-text">
                                        <h6>SKU</h6>
                                        <p><?php echo htmlspecialchars($product['sku']); ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="product-action-btns mt-4">
                            <a href="javascript:void(0);" class="btn-action-primary" data-bs-toggle="modal" data-bs-target="#quoteModal">
                                Request A Quote <i class="fa-solid fa-paper-plane"></i>
                            </a>
                            <a href="contact.php" class="btn-action-outline">
                                Contact Us <i class="fa-solid fa-headset"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-full-details">
                <div class="col-12">
                    <h3 class="detail-heading">Product Description</h3>
                    <div class="detail-content-box">
                        <?php echo $long_desc; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <section class="related-products-section">
                        <h3 class="related-title">Explore More Products</h3>
                        <div class="related-slider-container">

                            <?php
                            $rel_sql = "SELECT * FROM products WHERE status = 1 AND pro_id != $product_id ORDER BY RAND() LIMIT 6";
                            $rel_result = $conn->query($rel_sql);

                            if ($rel_result && $rel_result->num_rows > 0) {
                                while ($rel_row = $rel_result->fetch_assoc()) {
                                    $rel_id = $rel_row['pro_id'];
                                    $rel_name = htmlspecialchars($rel_row['pro_name']);
                                    $rel_img = !empty($rel_row['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($rel_row['pro_img']) : "https://placehold.co/600x500/eeeeee/999999?text=No+Image";
                                    $rel_mrp = !empty($rel_row['mrp']) ? floatval($rel_row['mrp']) : 0;
                                    $rel_sp = !empty($rel_row['selling_price']) ? floatval($rel_row['selling_price']) : 0;
                            ?>

                                    <div class="related-slide-item">
                                        <div class="b2b-product-card">
                                            <div class="prod-img-box">
                                                <img src="<?php echo $rel_img; ?>" alt="<?php echo $rel_name; ?>">
                                            </div>
                                            <div class="prod-content">
                                                <h3 class="prod-title"><?php echo $rel_name; ?></h3>

                                                <div class="prod-price-box" style="margin-bottom: 10px;">
                                                    <?php if ($rel_mrp > $rel_sp && $rel_sp > 0) { ?>
                                                        <span style="font-weight: 700; font-size: 18px; color: var(--primary-gold, #C49B3B);">₹<?php echo number_format($rel_sp, 2); ?></span>
                                                        <del style="font-size: 13px; color: #999999; margin-left: 5px;">₹<?php echo number_format($rel_mrp, 2); ?></del>
                                                    <?php } elseif ($rel_sp > 0) { ?>
                                                        <span style="font-weight: 700; font-size: 18px; color: var(--primary-gold, #C49B3B);">₹<?php echo number_format($rel_sp, 2); ?></span>
                                                    <?php } else { ?>
                                                        <span style="font-weight: 600; font-size: 14px; color: var(--primary-blue, #0A192F);">Price on Request</span>
                                                    <?php } ?>
                                                </div>

                                                <a href="product-details.php?id=<?php echo $rel_id; ?>" class="btn-details-page mt-3">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                }
                            } else {
                                echo "<p class='text-muted'>No other products found.</p>";
                            }
                            ?>

                        </div>
                    </section>
                </div>
            </div>

        </div>
    </section>
</main>

<?php include("./include/footer.php"); ?>