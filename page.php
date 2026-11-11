<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include('admin/db-conn.php'); // Changed path from config/connect.php to match your existing setup

// 1. URL LOGIC & REDIRECTION (Error Prevention)
$rawSlug = $_GET['slug_url'] ?? $_GET['slug'] ?? '';
$slug = mysqli_real_escape_string($conn, trim((string)$rawSlug));

// Use $base_url fallback if header is not yet included
$safe_base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";

if (empty($slug)) {
    header("Location: " . $safe_base_url . "404.php");
    exit();
}

$pageQuery = mysqli_query($conn, "SELECT * FROM custom_pages WHERE slug_url = '$slug' AND status = 1 LIMIT 1");
if (!$pageQuery || mysqli_num_rows($pageQuery) == 0) {
    header("Location: " . $safe_base_url . "404.php");
    exit();
}
$pageData = mysqli_fetch_assoc($pageQuery);

// 2. SEO & META VARIABLES SETUP
$cleanContentText = trim(preg_replace('/\s+/', ' ', strip_tags((string)$pageData['content'])));
$defaultMetaDesc = mb_substr($cleanContentText, 0, 160);

$meta_title = !empty($pageData['meta_title']) ? $pageData['meta_title'] : $pageData['page_title'] . " | Khetarpal Trading Co.";
$meta_desc  = !empty($pageData['meta_desc']) ? $pageData['meta_desc'] : $defaultMetaDesc;
$meta_key   = !empty($pageData['meta_key']) ? $pageData['meta_key'] : 'Khetarpal Trading, Agro Export India, B2B Spices';

$breadcrumb_name  = !empty($pageData['breadcrumb_title']) ? $pageData['breadcrumb_title'] : $pageData['page_title'];

// 3. AGRICULTURAL / B2B EXPORT SCHEMA MARKUP
$page_schema = trim($pageData['schema_markup'] ?? '');
if (empty($page_schema)) {
    $autoSchema = [
        "@context" => "https://schema.org",
        "@type" => "WholesaleStore",
        "name" => "Khetarpal Trading Co.",
        "description" => $meta_desc,
        "telephone" => "+91-6354765516",
        "email" => "khetarpaltradingc@gmail.com",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "155, APMC Market Yard",
            "addressLocality" => "Tharad",
            "addressRegion" => "Gujarat",
            "postalCode" => "385565",
            "addressCountry" => "IN"
        ]
    ];
    $page_schema = '<script type="application/ld+json">' . json_encode($autoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
}

// Add schema global variable so header.php prints it properly
$schema_code = $page_schema; 

// 4. NOW WE CAN INCLUDE HEADER
// Use the updated header.php which defines $base_url
include 'include/header.php';
?>

<style>
/* KTC Content Page Styling */
.page-content-wrapper {
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    border: 1px solid #eaeaea;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
}

.ktc-trust-strip {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
    background: var(--primary-blue, #0e1b2e);
    color: #ffffff;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: center;
}

.ktc-trust-item strong {
    display: block;
    font-size: 1.8rem;
    font-weight: 800;
}

.ktc-trust-item strong span {
    color: var(--primary-gold, #c59b27);
}

.ktc-trust-item small {
    color: #cbd5e1;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    font-family: 'Poppins', sans-serif;
}

.page-content-body {
    line-height: 1.8;
    color: #444;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
}

.page-content-body h2 {
    color: var(--primary-blue, #0e1b2e);
    font-size: 24px;
    font-weight: 700;
    margin-top: 30px;
    margin-bottom: 15px;
    border-left: 4px solid var(--primary-gold, #c59b27);
    padding-left: 15px;
}

.page-content-body h3 {
    color: var(--primary-blue, #0e1b2e);
    font-size: 20px;
    font-weight: 600;
    margin-top: 25px;
}

.page-content-body ul {
    padding-left: 20px;
}

.page-content-body ul li {
    margin-bottom: 10px;
}

/* Sidebar Widget Adjustments */
.sidebar-widget {
    background: #fcfcfc;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    border: 1px solid #eaeaea;
}

.sidebar-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary-blue, #0e1b2e);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--primary-gold, #c59b27);
}

.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    margin-bottom: 12px;
    border-bottom: 1px dashed #e2e8f0;
    padding-bottom: 12px;
}

.category-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.category-list a {
    color: #444 !important;
    text-decoration: none;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    transition: color 0.2s;
    display: flex;
    justify-content: space-between;
}

.category-list a:hover {
    color: var(--primary-gold, #c59b27) !important;
}

.btn-custom-solid {
    background-color: var(--primary-gold, #c59b27);
    color: #fff;
    border-radius: 6px;
    padding: 10px 20px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: 0.3s;
}

.btn-custom-solid:hover {
    background-color: #fff;
    color: var(--primary-blue, #0e1b2e);
}
</style>

<main class="main bg-light">
    <!-- Use this Breadcrumb block -->
    <div class="site-breadcrumb"
        style="background-image: url('<?php echo isset($base_url) ? $base_url : ''; ?>assets/img/bg/breadcrumb-bg.jpg'); background-size: cover; background-position: center; padding: 100px 0; text-align: center; position: relative;">

        <!-- Add an overlay if the text is not readable -->
        <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(14, 27, 46, 0.7); z-index: 1;">
        </div>

        <div class="container" style="position: relative; z-index: 2;">
            <h2 class="breadcrumb-title"
                style="color: #fff; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 36px; margin-bottom: 10px;">
                <?= htmlspecialchars($breadcrumb_name) ?></h2>

            <ul class="breadcrumb-menu"
                style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; gap: 10px; color: #fff; font-size: 15px;">
                <li><a href="<?php echo isset($base_url) ? $base_url : ''; ?>index.php"
                        style="color: var(--primary-gold, #c59b27); text-decoration: none;">Home</a> <i
                        class="fa fa-angle-double-right" style="font-size: 12px; margin-left: 5px;"></i></li>

                <li><a href="<?php echo isset($base_url) ? $base_url : ''; ?>locations.php"
                        style="color: var(--primary-gold, #c59b27); text-decoration: none;">Pages</a> <i
                        class="fa fa-angle-double-right" style="font-size: 12px; margin-left: 5px;"></i></li>

                <li class="active"><?= htmlspecialchars($breadcrumb_name) ?></li>
            </ul>
        </div>
    </div>

    <section class="py-5 mt-4 pb-5">
        <div class="container">
            <div class="row g-5">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <article class="page-content-wrapper">
                        <h1 class="mb-4 fw-bold"
                            style="color: var(--primary-blue, #0e1b2e); font-family: 'Poppins', sans-serif;">
                            <?= htmlspecialchars($pageData['page_title']); ?></h1>

                        <!-- KTC Agro Export Stats -->
                        <div class="ktc-trust-strip">
                            <div class="ktc-trust-item">
                                <strong>10<span>+</span></strong>
                                <small>Years Experience</small>
                            </div>
                            <div class="ktc-trust-item">
                                <strong>20<span>+</span></strong>
                                <small>Countries Exported</small>
                            </div>
                            <div class="ktc-trust-item">
                                <strong>500<span>+</span></strong>
                                <small>Happy Clients</small>
                            </div>
                            <div class="ktc-trust-item">
                                <strong>1000<span>+</span></strong>
                                <small>MT Monthly Supply</small>
                            </div>
                        </div>

                        <!-- Dynamic Content Rendered Here -->
                        <div class="page-content-body">
                            <?= $pageData['content']; ?>
                        </div>
                    </article>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    <aside class="sidebar">

                        <!-- Other Custom Pages -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Explore Other Pages</h3>
                            <ul class="category-list">
                                <?php
                                $otherPagesQuery = mysqli_query($conn, "SELECT page_title, slug_url FROM custom_pages WHERE status = 1 AND slug_url != '$slug' ORDER BY id DESC LIMIT 5");
                                if ($otherPagesQuery && mysqli_num_rows($otherPagesQuery) > 0) {
                                    while ($op = mysqli_fetch_assoc($otherPagesQuery)) {
                                        echo '<li><a href="'. (isset($base_url) ? $base_url : '') .'page/'.rawurlencode($op['slug_url']).'">'.htmlspecialchars($op['page_title']).' <i class="fa fa-angle-right"></i></a></li>';
                                    }
                                } else {
                                    echo '<li class="text-muted">No other pages found.</li>';
                                }
                                ?>
                            </ul>
                        </div>

                        <!-- Products Category Widget -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Export Categories</h3>
                            <ul class="category-list">
                                <?php
                                $catQuery = mysqli_query($conn, "SELECT categories, slug_url FROM categories WHERE status = 1 ORDER BY categories ASC LIMIT 6");
                                if ($catQuery && mysqli_num_rows($catQuery) > 0) {
                                    while ($c = mysqli_fetch_assoc($catQuery)) {
                                        echo '<li><a href="'. (isset($base_url) ? $base_url : '') .'category/'.htmlspecialchars($c['slug_url']).'">'.htmlspecialchars($c['categories']).' <i class="fa fa-angle-right"></i></a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <!-- Quick Contact Banner -->
                        <div class="sidebar-widget rounded-3 p-4 border-0 mt-4 text-center"
                            style="background-color: var(--primary-blue, #0e1b2e); color: #fff;">
                            <i class="fa-solid fa-ship fa-3x mb-3" style="color: var(--primary-gold, #c59b27);"></i>
                            <h4 class="text-white fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Need Bulk
                                Export?</h4>
                            <p class="small text-light mb-4">Partner with Khetarpal Trading Co. for premium quality
                                Indian spices and agricultural commodities.</p>
                            <a href="<?php echo isset($base_url) ? $base_url : ''; ?>contact.php"
                                class="btn-custom-solid w-100">Request A Quote</a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'include/footer.php'; ?>