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

// 2. Handle Search Query or Category Slug
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
$cat_slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// 3. Pagination Setup
$limit = 9;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Default SEO variables
$meta_title = "Products | Khetarpal Trading";
$meta_desc = "Browse our premium agricultural products and spices.";
$meta_keywords = "agricultural products, export, spices, khetarpal";
$page_heading = "All Products";
$current_cate_id = 0;

// 4. Database Fetch Logic
if (!empty($cat_slug)) {
    // Category Data Fetch
    $stmt_cat = $conn->prepare("SELECT * FROM categories WHERE slug_url = ? AND status = 1");
    $stmt_cat->bind_param("s", $cat_slug);
    $stmt_cat->execute();
    $cat_data = $stmt_cat->get_result()->fetch_assoc();

    if ($cat_data) {
        $current_cate_id = $cat_data['cate_id'];
        $page_heading = htmlspecialchars($cat_data['categories']);

        $meta_title = !empty($cat_data['meta_title']) ? $cat_data['meta_title'] : $page_heading . " Export | Khetarpal";
        $meta_desc = !empty($cat_data['meta_desc']) ? $cat_data['meta_desc'] : "High quality " . $page_heading . " for bulk export.";
        $meta_keywords = !empty($cat_data['meta_key']) ? $cat_data['meta_key'] : $page_heading . ", export, wholesale";
    } else {
        header("Location: " . $base_url . "category.php");
        exit;
    }

    $countSql = "SELECT COUNT(pro_id) as total FROM products WHERE pro_cate = $current_cate_id AND status = 1";
    $sql = "SELECT p.*, c.categories AS category_name 
            FROM products p 
            LEFT JOIN categories c ON p.pro_cate = c.cate_id 
            WHERE p.pro_cate = $current_cate_id AND p.status = 1 
            ORDER BY p.pro_id DESC LIMIT $limit OFFSET $offset";
} elseif (!empty($search_query)) {
    // Search Results Setup
    $page_heading = "Search Results: " . htmlspecialchars($search_query);
    $meta_title = "Products matching '" . htmlspecialchars($search_query) . "' | Khetarpal Trading";

    $search_esc = $conn->real_escape_string($search_query);
    $countSql = "SELECT COUNT(pro_id) as total FROM products WHERE pro_name LIKE '%$search_esc%' AND status = 1";
    $sql = "SELECT p.*, c.categories AS category_name 
            FROM products p 
            LEFT JOIN categories c ON p.pro_cate = c.cate_id 
            WHERE p.pro_name LIKE '%$search_esc%' AND p.status = 1 
            ORDER BY p.pro_id DESC LIMIT $limit OFFSET $offset";
} else {
    // Default Fallback: Show All Products
    $countSql = "SELECT COUNT(pro_id) as total FROM products WHERE status = 1";
    $sql = "SELECT p.*, c.categories AS category_name 
            FROM products p 
            LEFT JOIN categories c ON p.pro_cate = c.cate_id 
            WHERE p.status = 1 
            ORDER BY p.pro_id DESC LIMIT $limit OFFSET $offset";
}

$countResult = $conn->query($countSql);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);
$result = $conn->query($sql);

$pageTitle = $page_heading;

// ==========================================
// Canonical & Schema Markup Setup
// ==========================================
$current_uri = strtok($_SERVER["REQUEST_URI"], '?');
$query_string = "";
if (!empty($cat_slug)) {
    // HTACCESS friendly canonical link for categories
    $canonical_url = rtrim($base_url, '/') . "/category/" . urlencode($cat_slug);
} elseif (!empty($search_query)) {
    $canonical_url = $base_url . "category.php?q=" . urlencode($search_query);
} else {
    $canonical_url = $base_url . "category.php";
}

// JSON-LD CollectionPage Schema
$schema_arr = [
    "@context" => "https://schema.org",
    "@type" => "CollectionPage",
    "name" => $meta_title,
    "description" => $meta_desc,
    "url" => $canonical_url
];
$schema_code = "<script type=\"application/ld+json\">\n" . json_encode($schema_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n</script>";

include("./include/header.php");
$pageTitle= $page_heading;
include ('include/breadcrumb.php');

// Fetch All Categories for Left Sidebar
$allCatSql = "SELECT * FROM categories WHERE status = 1 ORDER BY categories ASC";
$allCatResult = $conn->query($allCatSql);
?>

<style>
/* KTC Base Colors */
:root {
    --ktc-navy: #0e1b2e;
    --ktc-gold: #c59b27;
}

.category-page-section {
    padding: 60px 0;
    background-color: #f9fafb;
}

/* Sidebar Styles */
.sidebar-widget {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
    margin-bottom: 30px;
    border: 1px solid #eaeaea;
}

.widget-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 18px;
    color: var(--ktc-navy);
    border-bottom: 2px solid var(--ktc-gold);
    padding-bottom: 10px;
    margin-bottom: 20px;
    display: inline-block;
}

/* Product Search Box */
.search-box {
    display: flex;
}

.search-box input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #eaeaea;
    border-radius: 6px 0 0 6px;
    font-family: 'Poppins';
    outline: none;
}

.search-box button {
    background: var(--ktc-gold);
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 0 6px 6px 0;
    cursor: pointer;
    transition: 0.3s;
}

.search-box button:hover {
    background: var(--ktc-navy);
}

/* Category List */
.cat-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.cat-list li {
    border-bottom: 1px dashed #eaeaea;
    padding: 10px 0;
}

.cat-list li:last-child {
    border-bottom: none;
}

.cat-list a {
    color: #555;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    transition: 0.3s;
    display: flex;
    justify-content: space-between;
}

.cat-list a:hover,
.cat-list a.active-cat {
    color: var(--ktc-gold);
    font-weight: 600;
    padding-left: 5px;
}

/* Sidebar Quote Banner */
.quote-banner {
    background: var(--ktc-navy);
    color: #fff;
    padding: 30px 20px;
    border-radius: 12px;
    text-align: center;
}

.quote-banner h4 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    margin-bottom: 15px;
    color: #fff;
}

.quote-banner p {
    font-size: 14px;
    color: #ccc;
    margin-bottom: 20px;
}

.quote-banner .btn-custom-solid {
    background: var(--ktc-gold);
    color: #fff;
    text-decoration: none;
    padding: 10px 25px;
    width: 100%;
    display: inline-block;
    border-radius: 30px;
    font-weight: 600;
    transition: 0.3s;
}

.quote-banner .btn-custom-solid:hover {
    background: #fff;
    color: var(--ktc-navy);
}

/* Product Cards */
.b2b-product-card {
    border: 1px solid #eaeaea;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.b2b-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(14, 27, 46, 0.08);
    border-color: var(--ktc-gold);
}

.btn-custom-outline {
    background: transparent;
    color: var(--ktc-navy);
    border: 1px solid var(--ktc-navy);
    border-radius: 4px;
    font-weight: 500;
    transition: 0.3s;
    text-decoration: none;
}

.btn-custom-outline:hover {
    background: var(--ktc-navy);
    color: #fff;
}

.btn-custom-solid-sm {
    background: var(--ktc-gold);
    color: #fff;
    border: 1px solid var(--ktc-gold);
    border-radius: 4px;
    font-weight: 500;
    transition: 0.3s;
    text-decoration: none;
}

.btn-custom-solid-sm:hover {
    background: var(--ktc-navy);
    border-color: var(--ktc-navy);
    color: #fff;
}

/* Pagination CSS */
.custom-pagination {
    margin-top: 50px;
    display: flex;
    justify-content: center;
    gap: 8px;
}

.custom-pagination .page-item .page-link {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: var(--ktc-navy);
    border: 1px solid #eaeaea;
    border-radius: 6px;
    padding: 10px 18px;
    transition: all 0.3s ease;
}

.custom-pagination .page-item.active .page-link {
    background-color: var(--ktc-gold);
    border-color: var(--ktc-gold);
    color: #ffffff;
}

.custom-pagination .page-item:not(.active) .page-link:hover {
    background-color: var(--ktc-navy);
    border-color: var(--ktc-navy);
    color: #ffffff;
}

.custom-pagination .page-item.disabled .page-link {
    color: #cccccc;
    background-color: #f9f9f9;
    pointer-events: none;
}
</style>

<main>

    <section class="category-page-section">
        <div class="container">
            <div class="row">

                <!-- ===============================
                     LEFT COLUMN: SIDEBAR
                ==================================== -->
                <div class="col-lg-3 mb-5 mb-lg-0">

                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Search Products</h4>
                        <form action="<?php echo $base_url; ?>category.php" method="GET" class="search-box">
                            <input type="text" name="q" placeholder="Keyword..."
                                value="<?php echo htmlspecialchars($search_query); ?>">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <!-- Product Categories Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="cat-list">
                            <!-- FIX: Absolute path for All Products -->
                            <li><a href="<?php echo $base_url; ?>product.php"
                                    class="<?php echo empty($cat_slug) ? 'active-cat' : ''; ?>">All Products <i
                                        class="fa-solid fa-angle-right"></i></a></li>
                            <?php
                            if ($allCatResult && $allCatResult->num_rows > 0) {
                                while ($cat = $allCatResult->fetch_assoc()) {
                                    $list_slug = htmlspecialchars($cat['slug_url'] ?? '');
                                    $list_name = htmlspecialchars($cat['categories']);
                                    $active_class = ($cat_slug === $list_slug) ? "active-cat" : "";

                                    // FIX: Added absolute $base_url so it doesn't nest into /category/category/...
                                    echo "<li><a href='{$base_url}category/{$list_slug}' class='{$active_class}'>{$list_name} <i class='fa-solid fa-angle-right'></i></a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Quote Banner Widget -->
                    <div class="quote-banner">
                        <h4>Need Bulk Export?</h4>
                        <p>Get premium quality agricultural products delivered globally at competitive prices.</p>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#quoteModal"
                            class="btn-custom-solid">Request a Quote</a>
                    </div>
                </div>

                <!-- ===============================
                     RIGHT COLUMN: PRODUCT GRID
                ==================================== -->
                <div class="col-lg-9">
                    <h2 class="section-main-title mb-4"
                        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 28px; color: var(--ktc-navy);">
                        <?php echo $page_heading; ?>
                    </h2>

                    <div class="row g-4">
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $pro_slug = htmlspecialchars($row['slug_url'] ?? '');
                                $pro_name = htmlspecialchars($row['pro_name'] ?? '');
                                $category_name = !empty($row['category_name']) ? htmlspecialchars($row['category_name']) : "Agro Products";
                                $packaging = !empty($row['qty']) ? htmlspecialchars($row['qty']) : "Custom packaging available";

                                // FIX: Added absolute $base_url to the image path
                                $img_path = !empty($row['pro_img']) ? $base_url . "admin/assets/img/uploads/" . htmlspecialchars($row['pro_img']) : $base_url . "assets/img/placeholder.jpg";

                                // FIX: Created absolute path for the product details link
                                $product_link = $base_url . "product/" . $pro_slug;
                        ?>

                        <!-- Product Card -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div
                                class="b2b-product-card d-flex flex-column h-100 shadow-sm bg-white rounded-3 overflow-hidden">

                                <div class="prod-img-box" style="height: 200px; overflow: hidden;">
                                    <a href="<?php echo $product_link; ?>"
                                        style="display: block; width: 100%; height: 100%;">
                                        <img src="<?php echo $img_path; ?>" alt="<?php echo $pro_name; ?>"
                                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                            onerror="this.src='<?php echo $base_url; ?>assets/img/placeholder.jpg'"
                                            onmouseover="this.style.transform='scale(1.05)'"
                                            onmouseout="this.style.transform='scale(1)'">
                                    </a>
                                </div>

                                <div class="prod-content p-4 d-flex flex-column flex-grow-1">
                                    <h3 class="prod-title mb-3"
                                        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; color: var(--ktc-navy); text-transform: uppercase;">
                                        <a href="<?php echo $product_link; ?>"
                                            style="text-decoration: none; color: inherit;"
                                            onmouseover="this.style.color='var(--ktc-gold)'"
                                            onmouseout="this.style.color='inherit'">
                                            <?php echo $pro_name; ?>
                                        </a>
                                    </h3>

                                    <ul class="prod-specs list-unstyled mb-4"
                                        style="font-family: 'Poppins', sans-serif; font-size: 13px; color: #555; line-height: 1.8;">
                                        <li><i class="fa-solid fa-layer-group me-2" style="color: var(--ktc-gold);"></i>
                                            <strong>Cat:</strong> <?php echo $category_name; ?>
                                        </li>
                                        <li><i class="fa-solid fa-box-open me-2" style="color: var(--ktc-gold);"></i>
                                            <strong>Pack:</strong> <?php echo $packaging; ?>
                                        </li>
                                    </ul>

                                    <div class="mt-auto d-flex gap-2">
                                        <a href="<?php echo $product_link; ?>"
                                            class="btn-custom-outline flex-fill text-center p-2"
                                            style="font-size: 13px;">
                                            <i class="fa-regular fa-eye me-1"></i> Details
                                        </a>
                                        <a href="<?php echo $base_url; ?>contact.php?product=<?php echo urlencode($pro_name); ?>"
                                            class="btn-custom-solid-sm flex-fill text-center p-2"
                                            style="font-size: 13px;">
                                            <i class="fa-solid fa-paper-plane me-1"></i> Quote
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        } else {
                            echo "<div class='col-12 text-center py-5'>
                                    <i class='fas fa-box-open fa-3x mb-3 text-muted'></i>
                                    <h4 class='text-muted'>No products found here.</h4>
                                  </div>";
                        }
                        ?>
                    </div> <!-- End Row -->

                    <!-- PAGINATION UI -->
                    <?php if ($totalPages > 1) { ?>
                    <nav aria-label="Product Category Navigation">
                        <ul class="pagination custom-pagination">
                            <?php
                                $query_append = "";
                                if (!empty($cat_slug)) {
                                    // Append using GET variable method to avoid rewrite conflicts in pagination
                                    $query_append = "&slug=" . urlencode($cat_slug);
                                } elseif (!empty($search_query)) {
                                    $query_append = "&q=" . urlencode($search_query);
                                }
                                ?>

                            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page - 1 . $query_append; ?>"><i
                                        class="fa-solid fa-angle-left"></i> Prev</a>
                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="?page=<?php echo $i . $query_append; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php } ?>

                            <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page + 1 . $query_append; ?>">Next <i
                                        class="fa-solid fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
</main>

<?php include("./include/footer.php"); ?>