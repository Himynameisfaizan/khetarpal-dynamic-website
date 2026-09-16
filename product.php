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

        // Variables (Price logic removed completely)
        $pro_id = $row['pro_id'];
        $pro_name = htmlspecialchars($row['pro_name'] ?? '');
        $category = !empty($row['category_name']) ? htmlspecialchars($row['category_name']) : "Agro Products";
        $packaging = !empty($row['qty']) ? htmlspecialchars($row['qty']) : "Custom packaging available";
        
        $img_path = !empty($row['pro_img']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['pro_img']) : "https://placehold.co/600x500/eeeeee/999999?text=No+Image";
?>

        <!-- Single Premium Product Card -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4"> <!-- mb-4 for perfect vertical spacing -->
            <div class="b2b-product-card d-flex flex-column h-100 shadow-sm bg-white rounded-3 overflow-hidden" style="border: 1px solid #f0f0f0; transition: transform 0.3s ease;">
                
                <!-- Product Image -->
                <div class="prod-img-box" style="height: 250px; overflow: hidden;">
                    <a href="product-details.php?id=<?php echo $pro_id; ?>" style="display: block; width: 100%; height: 100%;">
                    <img src="<?php echo $img_path; ?>" alt="<?php echo $pro_name; ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onerror="this.src='https://placehold.co/600x500/eeeeee/999999?text=Image+Not+Found'" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </a>
                </div>
                
                <!-- Product Content -->
                <div class="prod-content p-4 d-flex flex-column flex-grow-1">
                    <h3 class="prod-title mb-3" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-blue, #0A192F); text-transform: uppercase;">
                        <a href="product-details.php?id=<?php echo $pro_id; ?>" style="text-decoration: none; color: inherit;" onmouseover="this.style.color='var(--primary-gold, #C49B3B)'" onmouseout="this.style.color='inherit'">
                            <?php echo $pro_name; ?>
                        </a>
                    </h3>

                    <!-- Specifications (No Price) -->
                    <ul class="prod-specs list-unstyled mb-4" style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #555; line-height: 1.8;">
                        <li><i class="fa-solid fa-layer-group me-2" style="color: var(--primary-gold, #C49B3B);"></i> <strong>Category:</strong> <?php echo $category; ?></li>
                        <li><i class="fa-solid fa-box-open me-2" style="color: var(--primary-gold, #C49B3B);"></i> <strong>Packaging:</strong> <?php echo $packaging; ?></li>
                        <li><i class="fa-solid fa-truck-fast me-2" style="color: var(--primary-gold, #C49B3B);"></i> <strong>Status:</strong> Ready for Export</li>
                    </ul>

                    <!-- Action Buttons (Bottom Aligned Automatically) -->
                    <div class="mt-auto d-flex gap-2">
                        <a href="product-details.php?id=<?php echo $pro_id; ?>" class="btn-custom-outline flex-fill text-center">
                            <i class="fa-regular fa-eye me-1"></i> Details
                        </a>
                        
                        <!-- Contact page link with Product Name pre-filled in URL -->
                        <a href="contact.php?product=<?php echo urlencode($pro_name); ?>" class="btn-custom-solid flex-fill text-center">
                            <i class="fa-solid fa-paper-plane me-1"></i> Quote
                        </a>
                    </div>
                </div>
                
            </div>
        </div>

<?php 
    } // End While Loop
} else {
    // Agar kisi category mein products nahi hain
    echo "<div class='col-12 text-center py-5'>
            <i class='fas fa-box-open fa-3x mb-3 text-muted'></i>
            <h4 class='text-muted'>No products found in this category.</h4>
          </div>";
} 
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

    

    </div>
</section>

<?php include("./include/footer.php"); ?>