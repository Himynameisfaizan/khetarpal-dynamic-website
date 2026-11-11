<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("./admin/db-conn.php");

// 1. Dynamic Base URL Fix (Top of the file)
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$script_dir = rtrim($script_dir, '/') . '/';
$base_url = $protocol . $host . $script_dir;

// 2. Fetch Product by Slug
if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $product_slug = mysqli_real_escape_string($conn, $_GET['slug']);
} else {
    header("Location: " . $base_url . "product.php");
    exit;
}

$sql = "SELECT p.*, c.categories AS category_name 
        FROM products p
        LEFT JOIN categories c ON p.pro_cate = c.cate_id 
        WHERE p.slug_url = '$product_slug' AND p.status = 1";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    header("Location: " . $base_url . "404.php");
    exit;
}

$product = mysqli_fetch_assoc($result);

$pro_id = $product['pro_id'];
$pro_name = htmlspecialchars($product['pro_name']);
$pro_brand = !empty($product['brand_name']) ? htmlspecialchars($product['brand_name']) : "Khetarpal Trading Co.";
$category = !empty($product['category_name']) ? htmlspecialchars($product['category_name']) : "Agro Product";
$packaging = !empty($product['qty']) ? htmlspecialchars($product['qty']) : "Custom packaging available";
$short_desc = !empty($product['short_desc']) ? html_entity_decode($product['short_desc']) : "Premium quality agricultural product exported by Khetarpal Trading Co.";
$long_desc = !empty($product['description']) ? $product['description'] : "<p>Detailed description will be updated soon.</p>";

// FIXED MAIN IMAGE PATH: Now uses $base_url correctly
$img_path = !empty($product['pro_img']) ? $base_url . "admin/assets/img/uploads/" . htmlspecialchars($product['pro_img']) : "https://placehold.co/800x800/eeeeee/999999?text=No+Image";

$pageTitle = $pro_name;

// ==========================================
// Meta Tags & Canonical Setup
// ==========================================
$meta_title = !empty($product['meta_title']) ? $product['meta_title'] : $pro_name . " Export | Khetarpal Trading Co.";
$meta_desc = !empty($product['meta_desc']) ? $product['meta_desc'] : strip_tags($short_desc);
$meta_keywords = !empty($product['meta_key']) ? $product['meta_key'] : "$pro_name, Indian Spices Export, $category";

$canonical_url = $base_url . "product/" . urlencode($product_slug);

// ==========================================
// Dynamic Schema Markup (JSON-LD)
// ==========================================
$schema_arr = [
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => $pro_name,
    "image" => $img_path,
    "description" => trim(preg_replace('/\s+/', ' ', strip_tags($short_desc))),
    "brand" => [
        "@type" => "Brand",
        "name" => $pro_brand
    ],
    "offers" => [
        "@type" => "Offer",
        "url" => $canonical_url,
        "priceCurrency" => "USD",
        "price" => "0.00",
        "availability" => "https://schema.org/InStock"
    ]
];
$schema_code = "<script type=\"application/ld+json\">\n" . json_encode($schema_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n</script>";

include("./include/header.php");
$pageTitle = "Our Products";
include ('include/breadcrumb.php');
?>

<style>
/* KTC Theme Variables */
:root {
    --ktc-navy: #0e1b2e;
    --ktc-gold: #c59b27;
    --ktc-bg: #f9fafb;
}

.product-details-section {
    padding: 70px 0;
    background-color: var(--ktc-bg);
}

/* Product Top Section */
.product-main-img-box {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    background: #fff;
    padding: 15px;
}

.product-main-img-box img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
}

.product-detail-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 36px;
    color: var(--ktc-navy);
    margin-bottom: 20px;
    line-height: 1.2;
}

.product-short-desc {
    font-family: 'Poppins', sans-serif;
    color: #555;
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 30px;
}

/* Specs Grid */
.spec-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.spec-item {
    display: flex;
    align-items: center;
    background: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    border: 1px solid #eaeaea;
}

.spec-icon {
    font-size: 24px;
    color: var(--ktc-gold);
    margin-right: 15px;
}

.spec-text h6 {
    margin: 0 0 5px 0;
    font-size: 12px;
    text-transform: uppercase;
    color: #888;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.spec-text p {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: var(--ktc-navy);
}

/* Buttons */
.product-action-btns {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-action-primary {
    background: var(--ktc-gold);
    color: #fff;
    padding: 12px 30px;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
    border: 2px solid var(--ktc-gold);
}

.btn-action-primary:hover {
    background: var(--ktc-navy);
    border-color: var(--ktc-navy);
    color: #fff;
}

.btn-action-outline {
    background: transparent;
    color: var(--ktc-navy);
    padding: 12px 30px;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
    border: 2px solid var(--ktc-navy);
}

.btn-action-outline:hover {
    background: var(--ktc-navy);
    color: #fff;
}

/* Long Description Database Content Styling Fix */
.detail-heading {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 28px;
    color: var(--ktc-navy);
    border-bottom: 3px solid var(--ktc-gold);
    padding-bottom: 15px;
    margin-bottom: 30px;
    display: inline-block;
}

.detail-content-box {
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
    font-family: 'Poppins', sans-serif;
    color: #444;
    line-height: 1.8;
    border: 1px solid #eaeaea;
}

.detail-content-box h1,
.detail-content-box h2 {
    color: var(--ktc-navy);
    font-weight: 700;
    font-size: 24px;
    margin-top: 40px;
    margin-bottom: 20px;
}

.detail-content-box h2 {
    border-left: 4px solid var(--ktc-gold);
    padding-left: 15px;
}

.detail-content-box h3 {
    color: var(--ktc-navy);
    font-weight: 600;
    font-size: 20px;
    margin-top: 30px;
    margin-bottom: 15px;
}

.detail-content-box ul {
    padding-left: 20px;
    margin-bottom: 30px;
}

.detail-content-box ul li {
    margin-bottom: 12px;
    position: relative;
    list-style: none;
}

.detail-content-box ul li::before {
    content: "\f00c";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    color: var(--ktc-gold);
    position: absolute;
    left: -25px;
    top: 2px;
    font-size: 14px;
}

.detail-content-box hr {
    border-top: 1px dashed #ccc;
    margin: 40px 0;
    opacity: 0.5;
}

/* Related Products Grid */
.related-products-section {
    padding-top: 40px;
    margin-top: 20px;
    border-top: 1px solid #eaeaea;
}

.b2b-product-card {
    border: 1px solid #eaeaea;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.b2b-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(14, 27, 46, 0.08);
    border-color: var(--ktc-gold);
}
</style>

<main>

    <section class="product-details-section">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                    <div class="product-main-img-box">
                        <img src="<?php echo $img_path; ?>" alt="<?php echo $pro_name; ?>"
                            onerror="this.src='https://placehold.co/800x800/eeeeee/999999?text=Image+Not+Found'">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-7 col-md-12">
                    <div class="product-info-wrapper ps-lg-4">
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

                        <div class="product-action-btns">
                            <a href="javascript:void(0);" class="btn-action-primary" data-bs-toggle="modal"
                                data-bs-target="#quoteModal">
                                Request A Quote <i class="fa-solid fa-paper-plane ms-2"></i>
                            </a>
                            <a href="<?php echo $base_url; ?>contact.php?product=<?php echo urlencode($pro_name); ?>"
                                class="btn-action-outline">
                                Contact Us <i class="fa-solid fa-headset ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Long Description Block -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="detail-heading">Product Overview</h3>
                    <div class="detail-content-box">
                        <?php echo $long_desc; ?>
                    </div>
                </div>
            </div>

            <!-- RELATED PRODUCTS SECTION -->
            <div class="row">
                <div class="col-12">
                    <section class="related-products-section">
                        <h3 class="detail-heading mb-4" style="border: none; font-size: 24px;">
                            Explore More Products
                        </h3>
                        <div class="row g-4">
                            <?php
                            $rel_sql = "SELECT * FROM products WHERE status = 1 AND pro_id != '$pro_id' ORDER BY RAND() LIMIT 3";
                            $rel_result = $conn->query($rel_sql);

                            if ($rel_result && $rel_result->num_rows > 0) {
                                while ($rel_row = $rel_result->fetch_assoc()) {
                                    $rel_slug = htmlspecialchars($rel_row['slug_url'] ?? '');
                                    $rel_name = htmlspecialchars($rel_row['pro_name']);
                                    $rel_img = !empty($rel_row['pro_img']) ? $base_url . "admin/assets/img/uploads/" . htmlspecialchars($rel_row['pro_img']) : "https://placehold.co/600x500/eeeeee/999999?text=No+Image";
                                    $prod_link = $base_url . "product/" . $rel_slug;
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div
                                    class="b2b-product-card d-flex flex-column h-100 bg-white rounded-3 overflow-hidden">
                                    <div class="prod-img-box" style="height: 250px; overflow: hidden;">
                                        <a href="<?php echo $prod_link; ?>"
                                            style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $rel_img; ?>" alt="<?php echo $rel_name; ?>"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                                onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Image+Not+Found'"
                                                onmouseover="this.style.transform='scale(1.08)'"
                                                onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </div>
                                    <div class="prod-content p-4 d-flex flex-column flex-grow-1 text-center">
                                        <h3 class="mb-3"
                                            style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px;">
                                            <a href="<?php echo $prod_link; ?>"
                                                style="text-decoration: none; color: var(--ktc-navy);"
                                                onmouseover="this.style.color='var(--ktc-gold)'"
                                                onmouseout="this.style.color='var(--ktc-navy)'">
                                                <?php echo $rel_name; ?>
                                            </a>
                                        </h3>
                                        <div class="mt-auto">
                                            <a href="<?php echo $prod_link; ?>" class="btn-action-outline px-4 py-2"
                                                style="font-size: 13px; display: inline-block;">
                                                View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                            } else {
                                echo "<p class='text-muted'>No other products found.</p>";
                            } ?>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </section>
</main>

<?php include("./include/footer.php"); ?>