<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db-conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-product'])) {
    $pro_id = intval($_POST['pro_id']);
    $pro_name = $_POST['pro_name'] ?? '';
    $brand_name = $_POST['brand_name'] ?? '';
    $pro_cate = intval($_POST['pro_cate'] ?? 0);
    $pro_sub_cate = intval($_POST['pro_sub_cate'] ?? 0);
    $short_desc = $_POST['short_desc'] ?? '';
    $description = $_POST['pro_desc'] ?? '';
    $new_arrival = intval($_POST['new_arrival'] ?? 0);
    $trending = intval($_POST['trending'] ?? 0);
    $qty = intval($_POST['qty'] ?? 0);
    $mrp = floatval($_POST['mrp'] ?? 0);
    $selling_price = floatval($_POST['selling_price'] ?? 0);
    $whole_sale_selling_price = floatval($_POST['whole_sale_selling_price'] ?? 0);
    $stock = $_POST['stock'] ?? '';
    $meta_title = $_POST['meta_title'] ?? '';
    $meta_desc = $_POST['meta_desc'] ?? '';
    $meta_key = $_POST['meta_key'] ?? '';
    
    $schema_markup = trim($_POST['schema_markup'] ?? '');
    
    $status = intval($_POST['status'] ?? 0);
    $slug_url = $_POST['slug_url'] ?? '';

    $current_images = [];
    $stmt_img = $conn->prepare("SELECT pro_img FROM products WHERE pro_id = ?");
    $stmt_img->bind_param("i", $pro_id);
    $stmt_img->execute();
    $result_img = $stmt_img->get_result();
    
    if ($result_img && $result_img->num_rows > 0) {
        $row = $result_img->fetch_assoc();
        $current_images = !empty($row['pro_img']) ? explode(',', $row['pro_img']) : [];
    }
    $stmt_img->close();

    $removed_images = isset($_POST['removed_images']) ? explode(',', $_POST['removed_images']) : [];
    foreach ($removed_images as $removed) {
        $removed = trim($removed);
        if (!empty($removed) && ($key = array_search($removed, $current_images)) !== false) {
            unset($current_images[$key]);
            $file_path = "assets/img/uploads/" . $removed;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    $new_images = [];
    if (!empty($_FILES['pro_img']['name'][0])) {
        $upload_dir = "assets/img/uploads/";

        foreach ($_FILES['pro_img']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['pro_img']['name'][$key];
            $file_size = $_FILES['pro_img']['size'][$key];
            $file_error = $_FILES['pro_img']['error'][$key];

            if ($file_error === 0) {
                // Ensure unique name and check extensions
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($file_ext, $allowed)) {
                    $new_file_name = time() . '_' . uniqid() . '.' . $file_ext;
                    $destination = $upload_dir . $new_file_name;

                    if (move_uploaded_file($tmp_name, $destination)) {
                        $new_images[] = $new_file_name;
                    }
                }
            }
        }
    }

    $all_images = array_merge($current_images, $new_images);
    $pro_img = !empty($all_images) ? implode(',', $all_images) : '';

    $update_sql = "UPDATE products SET 
                pro_name = ?, 
                brand_name = ?, 
                pro_cate = ?, 
                pro_sub_cate = ?, 
                short_desc = ?, 
                description = ?, 
                new_arrival = ?, 
                trending = ?, 
                qty = ?, 
                mrp = ?, 
                selling_price = ?, 
                whole_sale_selling_price = ?, 
                stock = ?, 
                pro_img = ?, 
                meta_title = ?, 
                meta_desc = ?, 
                meta_key = ?, 
                schema_markup = ?, 
                status = ?, 
                slug_url = ?
              WHERE pro_id = ?";

    $stmt = $conn->prepare($update_sql);
    
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>Please ensure you added 'schema_markup' column in database.");
    }
    
    $stmt->bind_param("ssiisssiidddssssssisi", 
        $pro_name, 
        $brand_name, 
        $pro_cate, 
        $pro_sub_cate, 
        $short_desc, 
        $description, 
        $new_arrival, 
        $trending, 
        $qty, 
        $mrp, 
        $selling_price, 
        $whole_sale_selling_price, 
        $stock, 
        $pro_img, 
        $meta_title, 
        $meta_desc, 
        $meta_key, 
        $schema_markup, 
        $status, 
        $slug_url,
        $pro_id
    );

    if ($stmt->execute()) {
        $stmt->close();
        // Option to display alert and redirect using JS instead of header for a smoother feel
        echo "<script>alert('Product Updated Successfully!'); window.location.href='edit_products.php?edit_product_details=$pro_id&success=1';</script>";
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
        $stmt->close();
        echo "<script>alert('Error Update Product!'); window.location.href='edit_products.php?edit_product_details=$pro_id&error=1';</script>";
        exit();
    }
} else {
    header("Location: show-products.php");
    exit();
}
?>