<?php
include("./admin/db-conn.php");

// PAGINATION SETUP
$limit = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$countSql = "SELECT COUNT(blog_id) as total FROM blogs WHERE status = 'published'";
$countResult = $conn->query($countSql);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

$sql = "SELECT * FROM blogs 
        WHERE status = 'published' 
        ORDER BY blog_id DESC 
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$pageTitle = "Latest News & Blogs";
include("./include/header.php");
include("./include/breadcrumb.php");
?>

<style>
    .blog-page-section { padding: 80px 0; background-color: #fcfcfc; }
    .section-main-title { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 32px; color: var(--primary-blue, #0A192F); text-align: center; margin-bottom: 50px; position: relative; padding-bottom: 15px; }
    .section-main-title::after { content: ''; position: absolute; width: 70px; height: 3px; background-color: var(--primary-gold, #C49B3B); bottom: 0; left: 50%; transform: translateX(-50%); }
    
    .blog-card { background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column; }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .blog-img-box { position: relative; overflow: hidden; height: 240px; }
    .blog-img-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .blog-card:hover .blog-img-box img { transform: scale(1.05); }
    .blog-date-badge { position: absolute; top: 20px; right: 20px; background: var(--primary-gold, #C49B3B); color: #fff; padding: 8px 15px; border-radius: 30px; font-size: 13px; font-family: 'Poppins', sans-serif; font-weight: 600; box-shadow: 0 4px 10px rgba(196, 155, 59, 0.3); z-index: 1; }
    .blog-content { padding: 30px 25px; flex-grow: 1; display: flex; flex-direction: column; }
    .blog-meta { font-size: 13px; color: #777; margin-bottom: 12px; font-family: 'Poppins', sans-serif; }
    .blog-meta i { color: var(--primary-gold, #C49B3B); margin-right: 5px; }
    .blog-title a { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-blue, #0A192F); margin-bottom: 15px; line-height: 1.4; display: -webkit-box; line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-decoration: none; transition: color 0.3s; }
    .blog-title a:hover { color: var(--primary-gold, #C49B3B); }
    .blog-excerpt { font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 25px; flex-grow: 1; }
    .btn-read-more { display: inline-block; font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--primary-blue, #0A192F); text-transform: uppercase; font-size: 14px; letter-spacing: 0.5px; text-decoration: none; transition: color 0.3s ease; }
    .btn-read-more i { transition: transform 0.3s ease; }
    .btn-read-more:hover { color: var(--primary-gold, #C49B3B); }
    .btn-read-more:hover i { transform: translateX(5px); }

    /* Pagination CSS */
    .custom-pagination { margin-top: 60px; display: flex; justify-content: center; gap: 8px; }
    .custom-pagination .page-item .page-link { font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--primary-blue, #0A192F); border: 1px solid #eaeaea; border-radius: 6px; padding: 10px 18px; transition: all 0.3s ease; }
    .custom-pagination .page-item.active .page-link { background-color: var(--primary-gold, #C49B3B); border-color: var(--primary-gold, #C49B3B); color: #ffffff; }
    .custom-pagination .page-item:not(.active) .page-link:hover { background-color: var(--primary-blue, #0A192F); border-color: var(--primary-blue, #0A192F); color: #ffffff; }
    .custom-pagination .page-item.disabled .page-link { color: #cccccc; background-color: #f9f9f9; pointer-events: none; }
</style>

<section class="blog-page-section">
    <div class="container">
        <h2 class="section-main-title">Insights & Market Updates</h2>
        <div class="row g-4 justify-content-center">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $blog_slug = htmlspecialchars($row['slug']);
                    $title = htmlspecialchars($row['title']);
                    $author = !empty($row['author']) ? htmlspecialchars($row['author']) : "Admin";
                    $date = date('d M, Y', strtotime($row['created_at']));

                    $raw_content = html_entity_decode($row['description']);
                    $clean_text = strip_tags($raw_content);
                    $excerpt = mb_strlen($clean_text) > 120 ? mb_substr($clean_text, 0, 120) . "..." : $clean_text;

                    $img_path = !empty($row['image']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['image']) : "https://placehold.co/800x600/eeeeee/999999?text=Blog+Image";
            ?>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="blog-card">
                            <div class="blog-img-box">
                                <span class="blog-date-badge"><?php echo $date; ?></span>
                                <a href="blog-details.php?slug=<?php echo $blog_slug; ?>">
                                    <img src="<?php echo $img_path; ?>" alt="<?php echo $title; ?>" onerror="this.src='https://placehold.co/800x600/eeeeee/999999?text=No+Image'">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <i class="fa-solid fa-user-pen"></i> By <?php echo $author; ?>
                                </div>
                                <h3 class="blog-title">
                                    <a href="blog-details.php?slug=<?php echo $blog_slug; ?>"><?php echo $title; ?></a>
                                </h3>
                                <p class="blog-excerpt"><?php echo $excerpt; ?></p>
                                <div class="mt-auto">
                                    <a href="blog-details.php?slug=<?php echo $blog_slug; ?>" class="btn-read-more">
                                        Read Full Article <i class="fa-solid fa-arrow-right-long ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
        </div> 

        <!-- PAGINATION UI -->
        <?php if ($totalPages > 1) { ?>
            <nav aria-label="Blog Page Navigation">
                <ul class="pagination custom-pagination">
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>"><i class="fa-solid fa-angle-left"></i> Prev</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                    <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next <i class="fa-solid fa-angle-right"></i></a>
                    </li>
                </ul>
            </nav>
        <?php } ?>

    <?php } else { ?>
        <div class="col-12 text-center py-5">
            <i class="fa-regular fa-newspaper" style="font-size: 50px; color: #ccc; margin-bottom: 20px;"></i>
            <h4 class="text-muted">No blog posts available right now. Check back soon!</h4>
        </div>
    <?php } ?>

    </div>
</section>

<?php include("./include/footer.php"); ?>