<?php
include("./admin/db-conn.php");

// PAGINATION SETUP
$limit = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$countSql = "SELECT COUNT(id) as total FROM blogs WHERE status = 'published'";
$countResult = $conn->query($countSql);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

$sql = "SELECT * FROM blogs 
        WHERE status = 'published' 
        ORDER BY id DESC 
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
    .blog-title { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-blue, #0A192F); margin-bottom: 15px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .blog-excerpt { font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 25px; flex-grow: 1; }
    .btn-read-more { display: inline-block; font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--primary-blue, #0A192F); text-transform: uppercase; font-size: 14px; letter-spacing: 0.5px; text-decoration: none; transition: color 0.3s ease; cursor: pointer; border: none; background: transparent; padding: 0;}
    .btn-read-more i { transition: transform 0.3s ease; }
    .btn-read-more:hover { color: var(--primary-gold, #C49B3B); }
    .btn-read-more:hover i { transform: translateX(5px); }

    /* --- CUSTOM CSS FOR BLOG MODAL --- */
    .blog-modal .modal-content { border: none; border-radius: 12px; overflow: hidden; }
    .blog-modal .modal-header { background-color: var(--primary-blue, #0A192F); color: #ffffff; padding: 20px 25px; border-bottom: 4px solid var(--primary-gold, #C49B3B); }
    .blog-modal .modal-title { font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px; line-height: 1.4; }
    .blog-modal .btn-close { filter: invert(1) grayscale(100%) brightness(200%); } /* Makes bootstrap close button white */
    .blog-modal .modal-body { padding: 30px; }
    .blog-modal-img { width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .modal-blog-meta { font-family: 'Poppins', sans-serif; font-size: 14px; color: #555; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eaeaea; }
    .modal-blog-meta span { margin-right: 15px; }
    .modal-blog-meta i { color: var(--primary-gold, #C49B3B); margin-right: 5px; }
    .modal-full-content { font-family: 'Poppins', sans-serif; color: #444; line-height: 1.8; font-size: 15.5px; }
    .modal-full-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 15px 0; }
    
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

                    $blog_id = $row['id'];
                    $title = htmlspecialchars($row['title']);
                    $author = !empty($row['author']) ? htmlspecialchars($row['author']) : "Admin";
                    $date = date('d M, Y', strtotime($row['created_at']));

                    // Decode full content (For Modal)
                    $raw_content = html_entity_decode($row['content']);

                    // Excerpt for the Card (stripped of tags)
                    $clean_text = strip_tags($raw_content);
                    $excerpt = mb_strlen($clean_text) > 120 ? mb_substr($clean_text, 0, 120) . "..." : $clean_text;

                    $img_path = !empty($row['image']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['image']) : "https://placehold.co/800x600/eeeeee/999999?text=Blog+Image";
            ?>

                    <!-- SINGLE BLOG CARD -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="blog-card">
                            <div class="blog-img-box">
                                <span class="blog-date-badge"><?php echo $date; ?></span>
                                <img src="<?php echo $img_path; ?>" alt="<?php echo $title; ?>" onerror="this.src='https://placehold.co/800x600/eeeeee/999999?text=No+Image'">
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <i class="fa-solid fa-user-pen"></i> By <?php echo $author; ?>
                                </div>
                                <h3 class="blog-title"><?php echo $title; ?></h3>
                                <p class="blog-excerpt"><?php echo $excerpt; ?></p>

                                <div class="mt-auto">
                                    <!-- YAHAN MAGIC HAI: Link ki jagah Modal Trigger laga diya -->
                                    <button class="btn-read-more" data-bs-toggle="modal" data-bs-target="#blogModal<?php echo $blog_id; ?>">
                                        Read Full Article <i class="fa-solid fa-arrow-right-long ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==========================================
                         START: MODAL FOR THIS SPECIFIC BLOG 
                         (Ye hide rahega jab tak button click na ho)
                    =============================================== -->
                    <div class="modal fade blog-modal" id="blogModal<?php echo $blog_id; ?>" tabindex="-1" aria-hidden="true">
                        <!-- modal-dialog-scrollable lagaya hai taaki lamba blog andar scroll ho -->
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $title; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- Featured Image inside Modal -->
                                    <img src="<?php echo $img_path; ?>" class="blog-modal-img" alt="<?php echo $title; ?>" onerror="this.style.display='none'">

                                    <!-- Meta Info in Modal -->
                                    <div class="modal-blog-meta">
                                        <span><i class="fa-solid fa-user-pen"></i> Author: <strong><?php echo $author; ?></strong></span>
                                        <span><i class="fa-regular fa-calendar-days"></i> Published: <strong><?php echo $date; ?></strong></span>
                                    </div>

                                    <!-- FULL HTML CONTENT RENDERING -->
                                    <div class="modal-full-content">
                                        <?php echo $raw_content; ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END: MODAL -->

                <?php
                } // End while loop
                ?>

        </div> <!-- End Row -->

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

    <?php
            } else {
    ?>
        <!-- Empty State -->
        <div class="col-12 text-center py-5">
            <i class="fa-regular fa-newspaper" style="font-size: 50px; color: #ccc; margin-bottom: 20px;"></i>
            <h4 class="text-muted">No blog posts available right now. Check back soon!</h4>
        </div>
    <?php } ?>

    </div>
</section>

<?php include("./include/footer.php"); ?>