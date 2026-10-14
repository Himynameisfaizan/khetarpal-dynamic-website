<?php
include("./admin/db-conn.php");

// 1. Fetch Blog by Slug
if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $blog_slug = $_GET['slug'];
} else {
    header("Location: blogs.php");
    exit;
}

$sql = "SELECT * FROM blogs WHERE slug_url = ? AND status = 'published'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $blog_slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2 style='text-align:center; padding: 100px 0;'>Blog not found!</h2>";
    echo "<div style='text-align:center;'><a href='blogs.php'>Go Back to Blogs</a></div>";
    exit;
}

$blog = $result->fetch_assoc();

$blog_id = $blog['blog_id'];
$title = htmlspecialchars($blog['title']);
$author = !empty($blog['author']) ? htmlspecialchars($blog['author']) : "Admin";
$date = date('F d, Y', strtotime($blog['created_at']));
$content = html_entity_decode($blog['description']);
$img_path = !empty($blog['image']) ? "admin/assets/img/uploads/" . htmlspecialchars($blog['image']) : "https://placehold.co/800x600/eeeeee/999999?text=Blog+Image";

$pageTitle = $title;

// ==========================================
// SEO SETUP (Meta, Canonical, Schema)
// ==========================================
$clean_excerpt = trim(preg_replace('/\s+/', ' ', strip_tags($content)));
$excerpt_short = mb_strlen($clean_excerpt) > 150 ? mb_substr($clean_excerpt, 0, 150) . "..." : $clean_excerpt;

$meta_title = !empty($blog['meta_title']) ? $blog['meta_title'] : $title . " | Khetarpal Trading";
$meta_desc = !empty($blog['meta_desc']) ? $blog['meta_desc'] : $excerpt_short;
$meta_keywords = !empty($blog['meta_key']) ? $blog['meta_key'] : "agricultural export blog, spices export, $title";

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$canonical_url = $protocol . $domainName . "/office_php_project/khetarpal/blog-details.php?slug=" . urlencode($blog_slug);
// Live server url logic: "/blog-details.php?slug="

// Blog Article JSON-LD Schema (Agar DB me schema blank hai toh automatic generate karega)
if (!empty($blog['schema_markup'])) {
    $schema_code = $blog['schema_markup'];
} else {
    $schema_arr = [
        "@context" => "https://schema.org",
        "@type" => "BlogPosting",
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $canonical_url
        ],
        "headline" => $title,
        "description" => $excerpt_short,
        "image" => $protocol . $domainName . "/" . ltrim($img_path, './'),
        "author" => [
            "@type" => "Person",
            "name" => $author
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => "Khetarpal Trading Co.",
            "logo" => [
                "@type" => "ImageObject",
                "url" => $protocol . $domainName . "/assets/img/logo/logo.png"
            ]
        ],
        "datePublished" => date('c', strtotime($blog['created_at']))
    ];
    $schema_code = "<script type=\"application/ld+json\">\n" . json_encode($schema_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n</script>";
}

include("./include/header.php");
include("./include/breadcrumb.php");

// Fetch Categories for Sidebar
$catSql = "SELECT * FROM categories WHERE status = 1 ORDER BY categories ASC";
$catResult = $conn->query($catSql);

// Fetch Recent Blogs for Sidebar
$recentBlogSql = "SELECT title, slug_url, image, created_at FROM blogs WHERE status = 'published' AND blog_id != $blog_id ORDER BY blog_id DESC LIMIT 4";
$recentBlogResult = $conn->query($recentBlogSql);
?>

<style>
    .blog-details-sec {
        padding: 60px 0;
        background-color: #f9fafb;
    }

    /* Left Content Styles */
    .bd-image-wrapper {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .bd-image-wrapper img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
    }

    .bd-meta {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
        display: flex;
        gap: 20px;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 15px;
    }

    .bd-meta i {
        color: var(--primary-gold, #C49B3B);
        margin-right: 5px;
    }

    .bd-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 32px;
        color: var(--primary-blue, #0A192F);
        margin-bottom: 25px;
        line-height: 1.3;
    }

    .bd-content {
        font-family: 'Poppins', sans-serif;
        color: #444;
        line-height: 1.8;
        font-size: 16px;
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
    }

    .bd-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    /* Right Sidebar Styles */
    .sidebar-widget {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
        margin-bottom: 30px;
    }

    .widget-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--primary-blue, #0A192F);
        border-bottom: 2px solid var(--primary-gold, #C49B3B);
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: inline-block;
    }

    /* Search Box */
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
        background: var(--primary-gold, #C49B3B);
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 0 6px 6px 0;
        cursor: pointer;
        transition: 0.3s;
    }

    .search-box button:hover {
        background: var(--primary-blue, #0A192F);
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

    .cat-list a:hover {
        color: var(--primary-gold, #C49B3B);
        padding-left: 5px;
    }

    /* Recent Blogs List */
    .recent-blog-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eaeaea;
    }

    .recent-blog-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .rb-img {
        width: 70px;
        height: 70px;
        border-radius: 6px;
        object-fit: cover;
    }

    .rb-content h6 {
        margin: 0 0 5px 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
    }

    .rb-content h6 a {
        color: var(--primary-blue, #0A192F);
        text-decoration: none;
        transition: 0.3s;
    }

    .rb-content h6 a:hover {
        color: var(--primary-gold, #C49B3B);
    }

    .rb-content span {
        font-size: 12px;
        color: #888;
    }

    /* Sidebar Quote Banner */
    .quote-banner {
        background: var(--primary-blue, #0A192F);
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
        background: var(--primary-gold, #C49B3B);
        border-color: var(--primary-gold, #C49B3B);
        padding: 10px 25px;
        width: 100%;
        border-radius: 30px;
    }

    .quote-banner .btn-custom-solid:hover {
        background: #fff;
        color: var(--primary-blue, #0A192F);
    }

    /* Inquiry Section (Bottom) */
    .inquiry-bottom-sec {
        padding: 60px 0;
        background: #fff;
        border-top: 1px solid #eaeaea;
    }

    .inquiry-box {
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        overflow: hidden;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        min-height: 400px;
        border: none;
    }

    .form-container {
        padding: 40px;
        background: #fcfcfc;
        height: 100%;
    }

    .form-container h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--primary-blue, #0A192F);
        margin-bottom: 25px;
    }
</style>

<main>
    <section class="blog-details-sec">
        <div class="container">
            <div class="row">

                <!-- ===============================
                     LEFT COLUMN: BLOG CONTENT
                ==================================== -->
                <div class="col-lg-8">
                    <div class="bd-image-wrapper">
                        <img src="<?php echo $img_path; ?>" alt="<?php echo $title; ?>">
                    </div>

                    <h1 class="bd-title"><?php echo $title; ?></h1>

                    <div class="bd-meta">
                        <span><i class="fa-solid fa-user-pen"></i> <?php echo $author; ?></span>
                        <span><i class="fa-regular fa-calendar-days"></i> <?php echo $date; ?></span>
                    </div>

                    <div class="bd-content">
                        <?php echo $content; ?>
                    </div>
                </div>

                <!-- ===============================
                     RIGHT COLUMN: SIDEBAR
                ==================================== -->
                <div class="col-lg-4 mt-5 mt-lg-0">

                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Search</h4>
                        <form action="blogs.php" method="GET" class="search-box">
                            <input type="text" name="q" placeholder="Search news...">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <!-- Product Categories Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Product Categories</h4>
                        <ul class="cat-list">
                            <?php
                            if ($catResult && $catResult->num_rows > 0) {
                                while ($cat = $catResult->fetch_assoc()) {
                                    $cat_slug_link = htmlspecialchars($cat['slug_url'] ?? '');
                                    $cat_name = htmlspecialchars($cat['categories']);
                                    // Naya category page slug link
                                    echo "<li><a href='category.php?slug={$cat_slug_link}'>{$cat_name} <i class='fa-solid fa-angle-right'></i></a></li>";
                                }
                            } else {
                                echo "<li><a href='product.php'>All Products <i class='fa-solid fa-angle-right'></i></a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Recent Blogs Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Recent Updates</h4>
                        <?php
                        if ($recentBlogResult && $recentBlogResult->num_rows > 0) {
                            while ($rb = $recentBlogResult->fetch_assoc()) {
                                $rb_slug = htmlspecialchars($rb['slug_url']);
                                $rb_title = htmlspecialchars($rb['title']);
                                $rb_date = date('M d, Y', strtotime($rb['created_at']));
                                $rb_img = !empty($rb['image']) ? "admin/assets/img/uploads/" . htmlspecialchars($rb['image']) : "https://placehold.co/100x100";
                        ?>
                                <div class="recent-blog-item">
                                    <img src="<?php echo $rb_img; ?>" alt="<?php echo $rb_title; ?>" class="rb-img">
                                    <div class="rb-content">
                                        <h6><a href="blog-details.php?slug=<?php echo $rb_slug; ?>"><?php echo $rb_title; ?></a></h6>
                                        <span><i class="fa-regular fa-clock" style="color: var(--primary-gold, #C49B3B); margin-right: 5px;"></i> <?php echo $rb_date; ?></span>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p class='text-muted' style='font-size: 14px;'>No recent updates available.</p>";
                        }
                        ?>
                    </div>

                    <!-- Quote Banner Widget -->
                    <div class="quote-banner">
                        <h4>Need Bulk Export?</h4>
                        <p>Get premium quality agricultural products delivered globally at competitive prices.</p>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#quoteModal" class="btn-custom-solid">Request a Quote</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         INQUIRY & MAP SECTION (BOTTOM)
    =============================================== -->
    <section class="inquiry-bottom-sec">
        <div class="container">
            <div class="inquiry-box">
                <div class="row g-0">
                    <!-- Left Side: Map -->
                    <div class="col-lg-6">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14534.243247152754!2d71.62298093263792!3d24.39657714359742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395b49aea3d42e4f%3A0xa876e35b5517f7c4!2z4Kqu4Kq-4Kqw4KuN4KqV4KuH4Kqf4Kqv4Kq-4Kqw4KuN4Kqh!5e0!3m2!1sen!2sin!4v1784628885692!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <!-- Right Side: Contact Form -->
                    <div class="col-lg-6">
                        <div class="form-container">
                            <h3>Have a Question? Drop a Line</h3>
                            <form action="admin/process-contact.php" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name *" required style="padding: 12px; font-family: 'Poppins';">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email_id" class="form-control" placeholder="Email Address *" required style="padding: 12px; font-family: 'Poppins';">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" name="phone_no" class="form-control" placeholder="Phone No. *" required style="padding: 12px; font-family: 'Poppins';">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="interested_product" class="form-control" style="padding: 12px; font-family: 'Poppins';">
                                            <option value="" disabled selected>Interested Product...</option>
                                            <option value="Jeera / Cumin Seeds">Cumin Seeds</option>
                                            <option value="Ajmo / Ajwain">Ajmo / Ajwain</option>
                                            <option value="Isabgul / Psyllium">Psyllium Husk</option>
                                            <option value="Chana / Chickpeas">Chickpeas</option>
                                            <option value="Other">Other Products</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" class="form-control" rows="4" placeholder="Your Message *" required style="padding: 12px; font-family: 'Poppins';"></textarea>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn-custom-solid w-100" style="padding: 12px; border-radius: 6px;">
                                            Send Inquiry <i class="fa-solid fa-paper-plane ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include("./include/footer.php"); ?>