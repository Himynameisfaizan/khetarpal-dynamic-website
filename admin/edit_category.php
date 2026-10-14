<?php
session_start();
include "db-conn.php";
include "functions.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $cat_id = $_GET['id'];
    $category = get_category_by_id($cat_id);
    if (!$category) {
        $_SESSION['error'] = "Category not found.";
        header("Location: view-categories.php");
        exit;
    }
} else {
    header("Location: view-categories.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Category | Admin</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <?php include "links.php"; ?>
</head>

<body class="crm_body_bg">

    <?php include "header.php"; ?>
    <section class="main_content dashboard_part large_header_bg">

        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <?php include "top_nav.php"; ?>
                </div>
            </div>
        </div>

        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="white_card card_height_100 mb_30">
                            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between">
                                <h4 class="mb-0 fw-bold">Edit Category: <?= htmlspecialchars($category['categories']) ?></h4>
                                <a href="view-categories.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Back</a>
                            </div>

                            <div class="white_card_body">
                                <form action="functions.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="cat_id" value="<?= htmlspecialchars($category['cate_id']) ?>">
                                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($category['image']) ?>">

                                    <div class="row">
                                        <!-- Category Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cate_name" class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                                            <input type="text" id="cate_name" name="cate_name" value="<?= htmlspecialchars($category['categories']) ?>" class="form-control" required>
                                        </div>

                                        <!-- Slug URL -->
                                        <div class="col-md-6 mb-3">
                                            <label for="slug_url" class="form-label fw-bold">Slug URL</label>
                                            <input type="text" id="slug_url" name="slug_url" value="<?= htmlspecialchars($category['slug_url']) ?>" class="form-control" required>
                                        </div>

                                        <!-- Meta Title -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="<?= htmlspecialchars($category['meta_title'] ?? '') ?>">
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Meta Keywords</label>
                                            <input type="text" class="form-control" name="meta_key" value="<?= htmlspecialchars($category['meta_key'] ?? '') ?>">
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Meta Description</label>
                                            <textarea class="form-control" name="meta_desc" rows="3"><?= htmlspecialchars($category['meta_desc'] ?? '') ?></textarea>
                                        </div>

                                        <!-- Schema Markup -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Schema Markup (JSON-LD)</label>
                                            <textarea class="form-control" name="schema_markup" rows="3"><?= htmlspecialchars($category['schema_markup'] ?? '') ?></textarea>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label fw-bold">Status</label>
                                            <select id="status" name="status" class="form-select" required>
                                                <option value="1" <?= ($category['status'] == '1') ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= ($category['status'] == '0') ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-md-6 mb-3">
                                            <label for="imageUpload" class="form-label fw-bold">Update Image</label>
                                            <input type="file" id="imageUpload" name="imageUpload" class="form-control" accept="image/*">
                                            
                                            <?php if (!empty($category['image'])): ?>
                                                <div class="mt-2">
                                                    <small class="text-muted d-block mb-1">Current Image:</small>
                                                    <img src="uploads/category/<?= htmlspecialchars($category['image']) ?>" alt="Category Image" class="img-thumbnail" style="max-height:80px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="view-categories.php" class="btn btn-secondary me-2">Cancel</a>
                                        <button type="submit" name="update-category" class="btn btn-primary">Update Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>
    </section>
</body>
</html>