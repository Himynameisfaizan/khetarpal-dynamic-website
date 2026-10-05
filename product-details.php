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

$img_path = !empty($product['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($product['pro_img']) : "https://placehold.co/800x800/eeeeee/999999?text=No+Image";

$pageTitle = $pro_name;

// SEO Variables Setup (Products table se)
$meta_title = !empty($product['meta_title']) ? $product['meta_title'] : $pro_name;
$meta_desc = !empty($product['meta_desc']) ? $product['meta_desc'] : strip_tags($short_desc);
$meta_keywords = !empty($product['meta_key']) ? $product['meta_key'] : "";

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

            <!-- RELATED PRODUCTS -->
            <div class="row mt-5">
                <div class="col-12">
                    <section class="related-products-section">
                        <h3 class="related-title mb-4" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 26px; color: var(--primary-blue, #0A192F); border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
                            Explore More Products
                        </h3>
                        <div class="related-slider-container row g-4">
                            <?php
                            $rel_sql = "SELECT * FROM products WHERE status = 1 AND pro_id != $product_id ORDER BY RAND() LIMIT 3";
                            $rel_result = $conn->query($rel_sql);

                            if ($rel_result && $rel_result->num_rows > 0) {
                                while ($rel_row = $rel_result->fetch_assoc()) {
                                    $rel_id = $rel_row['pro_id'];
                                    $rel_name = htmlspecialchars($rel_row['pro_name']);
                                    $rel_img = !empty($rel_row['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($rel_row['pro_img']) : "https://placehold.co/600x500/eeeeee/999999?text=No+Image";
                            ?>
                            <div class="related-slide-item col-lg-4 col-md-6 col-sm-12">
                                <div class="b2b-product-card d-flex flex-column h-100 shadow-sm bg-white rounded-3 overflow-hidden" style="border: 1px solid #f0f0f0; transition: transform 0.3s ease;">
                                    <div class="prod-img-box" style="height: 220px; overflow: hidden;">
                                          <a href="product-details.php?id=<?php echo $rel_id; ?>" style="display: block; width: 100%; height: 100%;">
                                        <img src="<?php echo $rel_img; ?>" alt="<?php echo $rel_name; ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Image+Not+Found'" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </div>
                                    <div class="prod-content p-4 d-flex flex-column flex-grow-1">
                                        <h3 class="prod-title mb-4" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 17px; color: var(--primary-blue, #0A192F); text-transform: uppercase;">
                                              <a href="product-details.php?id=<?php echo $rel_id; ?>" style="text-decoration: none; color: inherit;" onmouseover="this.style.color='var(--primary-gold, #C49B3B)'" onmouseout="this.style.color='inherit'">
                                            <?php echo $rel_name; ?>
                                        </a>
                                        </h3>
                                        <div class="mt-auto d-flex gap-2">
                                            <a href="product-details.php?id=<?php echo $rel_id; ?>" class="btn-custom-outline flex-fill text-center px-2 py-2" style="font-size: 12px;">
                                                <i class="fa-regular fa-eye me-1"></i> Details
                                            </a>
                                            <a href="contact.php?product=<?php echo urlencode($rel_name); ?>" class="btn-custom-solid flex-fill text-center px-2 py-2" style="font-size: 12px;">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Quote
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } } else { echo "<p class='text-muted'>No other products found.</p>"; } ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include("./include/footer.php"); ?>