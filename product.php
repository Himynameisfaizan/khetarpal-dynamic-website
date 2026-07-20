<?php
include("./admin/db-conn.php");

$limit = 9;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$countSql = "SELECT COUNT(pro_id) as total FROM products WHERE status = 1";
$countResult = $conn->query($countSql);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);


$sql = "SELECT p.*, c.categories AS category_name 
        FROM products p
        LEFT JOIN categories c ON p.pro_cate = c.cate_id 
        WHERE p.status = 1 
        ORDER BY p.pro_id DESC 
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$pageTitle = "Our Products";
include("./include/header.php");
include("./include/breadcrumb.php");
?>

<style>
    .custom-pagination {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .custom-pagination .page-item .page-link {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: var(--primary-blue, #0A192F);
        border: 1px solid #eaeaea;
        border-radius: 6px;
        padding: 10px 18px;
        transition: all 0.3s ease;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: var(--primary-gold, #C49B3B);
        border-color: var(--primary-gold, #C49B3B);
        color: #ffffff;
    }

    .custom-pagination .page-item:not(.active) .page-link:hover {
        background-color: var(--primary-blue, #0A192F);
        border-color: var(--primary-blue, #0A192F);
        color: #ffffff;
    }

    .custom-pagination .page-item.disabled .page-link {
        color: #cccccc;
        background-color: #f9f9f9;
        pointer-events: none;
    }
</style>

<section class="products-page-section">
    <div class="container">

        <h2 class="section-main-title">Our Premium Agro Products</h2>

        <div class="row g-4 justify-content-center">

            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $pro_id = $row['pro_id'];
                    $pro_name = htmlspecialchars($row['pro_name']);
                    $category = !empty($row['category_name']) ? htmlspecialchars($row['category_name']) : "Agro Product";
                    $packaging = !empty($row['qty']) ? htmlspecialchars($row['qty']) : "Custom packaging available";
                    $mrp = !empty($row['mrp']) ? floatval($row['mrp']) : 0;
                    $selling_price = !empty($row['selling_price']) ? floatval($row['selling_price']) : 0;

                    $img_path = !empty($row['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['pro_img']) : "https://placehold.co/600x500/eeeeee/999999?text=No+Image";
            ?>

                    <!-- PRODUCT CARD -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="b2b-product-card">
                            <div class="prod-img-box">
                                <img src="<?php echo $img_path; ?>" alt="<?php echo $pro_name; ?>" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Image+Not+Found'">
                            </div>
                            <div class="prod-content">
                                <h3 class="prod-title"><?php echo $pro_name; ?></h3>

                                <!-- Price Display Box -->
                                <div class="prod-price-box" style="margin-bottom: 15px;">
                                    <?php if ($mrp > $selling_price && $selling_price > 0) { ?>
                                        <!-- Discounted Price -->
                                        <span style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-gold, #C49B3B);">
                                            ₹<?php echo number_format($selling_price, 2); ?>
                                        </span>
                                        <!-- Crossed MRP -->
                                        <del style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; color: #999999; margin-left: 10px;">
                                            ₹<?php echo number_format($mrp, 2); ?>
                                        </del>
                                    <?php } elseif ($selling_price > 0) { ?>
                                        <!-- Normal Selling Price (Agar MRP nahi hai) -->
                                        <span style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-gold, #C49B3B);">
                                            ₹<?php echo number_format($selling_price, 2); ?>
                                        </span>
                                    <?php } else { ?>
                                        <!-- Agar dono price 0 hain toh -->
                                        <span style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 16px; color: var(--primary-blue, #0A192F);">
                                            Price on Request
                                        </span>
                                    <?php } ?>
                                </div>

                                <ul class="prod-specs">
                                    <li><i class="fa-solid fa-layer-group"></i> <strong>Category:</strong> &nbsp; <?php echo $category; ?></li>
                                    <li><i class="fa-solid fa-box-open"></i> <strong>Packaging:</strong> &nbsp; <?php echo $packaging; ?></li>
                                    <li><i class="fa-solid fa-truck-fast"></i> <strong>Status:</strong> &nbsp; Ready for Export</li>
                                </ul>

                                <a href="product-details.php?id=<?php echo $pro_id; ?>" class="btn-details-page">View Details <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
                            </div>
                        </div>
                    </div>

                <?php
                } // While loop ends
                ?>

        </div> <!-- End Row -->

        <!-- ==========================================
             START: PAGINATION UI
        =============================================== -->
        <?php if ($totalPages > 1) { ?>
            <nav aria-label="Product Page Navigation">
                <ul class="pagination custom-pagination">

                    <!-- Previous Button -->
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>"><i class="fa-solid fa-angle-left"></i> Prev</a>
                    </li>

                    <!-- Page Number Links -->
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>

                    <!-- Next Button -->
                    <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next <i class="fa-solid fa-angle-right"></i></a>
                    </li>

                </ul>
            </nav>
        <?php } ?>
        <!-- END PAGINATION UI -->

    <?php
            } else {
    ?>
        <!-- Empty State -->
        <div class="col-12 text-center py-5">
            <h4 class="text-muted">No products available at the moment. Please check back later.</h4>
        </div>
    <?php } ?>

    </div>
</section>

<?php include("./include/footer.php"); ?>