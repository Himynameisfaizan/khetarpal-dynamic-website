<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db-conn.php";

// 1. Slug Generator Function
function SlugUrl($string) {
    $slug = preg_replace('/[^a-zA-Z0-9 -]/', '',$string);
    $slug = str_replace(' ', '-',$slug);
    $slug = strtolower($slug);
    return $slug;
}

// ==========================================
// 2. ADD CATEGORY
// ==========================================
if (isset($_POST["add-categories"])) {
    $fileName = '';
    
    // Handle Image Upload
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {$fileTmpPath = $_FILES['imageUpload']['tmp_name'];$fileNameRaw = $_FILES['imageUpload']['name'];$fileExtension = strtolower(pathinfo($fileNameRaw, PATHINFO_EXTENSION));$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        
        if (in_array($fileExtension,$allowedExtensions)) {
            $fileName = uniqid('img_', true) . '.' .$fileExtension;
            $uploadDir = 'uploads/category/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
            move_uploaded_file($fileTmpPath, $uploadDir .$fileName);
        }
    }

    $cate_id = mt_rand(11111, 99999);$cate_name = mysqli_real_escape_string($conn, trim($_POST["cate_name"]));
    $meta_title = mysqli_real_escape_string($conn, trim($_POST["meta_title"]));
    $meta_key = mysqli_real_escape_string($conn, trim($_POST["meta_key"]));
    $meta_desc = mysqli_real_escape_string($conn, trim($_POST["meta_desc"]));
    $schema_markup = isset($_POST["schema_markup"]) ? mysqli_real_escape_string($conn, trim($_POST["schema_markup"])) : "";
    
    // Setup Slug (Manual ya Automatic)
    $slug_url = !empty($_POST["slug_url"]) ? SlugUrl($_POST["slug_url"]) : SlugUrl($cate_name);

    $sql = "INSERT INTO `categories` (`cate_id`, `categories`, `meta_title`, `meta_desc`, `meta_key`, `schema_markup`, `image`, `slug_url`, `status`, `added_on`) 
            VALUES ('$cate_id', '$cate_name', '$meta_title', '$meta_desc', '$meta_key', '$schema_markup', '$fileName', '$slug_url', 1, NOW())";

    $check = mysqli_query($conn,$sql);

    if (!$check) {
        die("SQL Error: " . mysqli_error($conn)); 
    } else {
        echo "<script>alert('Category Inserted Successfully!'); window.location.href = 'view-categories.php';</script>";
    }
}

// ==========================================
// 3. UPDATE CATEGORY
// ==========================================
if (isset($_POST["update-category"])) {
    $cat_id = mysqli_real_escape_string($conn,$_POST["cat_id"]);
    $cate_name = mysqli_real_escape_string($conn, trim($_POST["cate_name"]));
    $slug_url = SlugUrl($_POST["slug_url"]);
    $meta_title = mysqli_real_escape_string($conn, trim($_POST["meta_title"]));
    $meta_key = mysqli_real_escape_string($conn, trim($_POST["meta_key"]));
    $meta_desc = mysqli_real_escape_string($conn, trim($_POST["meta_desc"]));
    $schema_markup = isset($_POST["schema_markup"]) ? mysqli_real_escape_string($conn, trim($_POST["schema_markup"])) : "";
    $status = mysqli_real_escape_string($conn,$_POST["status"]);
    
    $fileName =$_POST['old_image'] ?? '';

    // Handle New Image Upload
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {$fileExtension = strtolower(pathinfo($_FILES['imageUpload']['name'], PATHINFO_EXTENSION));$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        if (in_array($fileExtension,$allowedExtensions)) {
            $fileName = uniqid('img_', true) . '.' .$fileExtension;
            $uploadDir = 'uploads/category/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
            move_uploaded_file($_FILES['imageUpload']['tmp_name'], $uploadDir .$fileName);
        }
    }

    $updateSql = "UPDATE `categories` SET 
                    `categories`='$cate_name', 
                    `slug_url`='$slug_url', 
                    `meta_title`='$meta_title', 
                    `meta_key`='$meta_key', 
                    `meta_desc`='$meta_desc', 
                    `schema_markup`='$schema_markup', 
                    `image`='$fileName', 
                    `status`='$status' 
                  WHERE `cate_id`='$cat_id'";

    if (mysqli_query($conn,$updateSql)) {
        echo "<script>alert('Category Updated Successfully!'); window.location.href = 'view-categories.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// ==========================================
// 4. ADD SUB CATEGORY
// ==========================================
if (isset($_POST["add-sub-categories"])) {
    $uploadedImage = ''; 
    
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {$fileTmpPath = $_FILES['imageUpload']['tmp_name'];$fileName = $_FILES['imageUpload']['name'];$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');

        if (in_array($fileExtension,$allowedExtensions)) {
            $newFileName = uniqid('img_', true) . '.' .$fileExtension;
            $uploadDir = 'uploads/sub-category/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
            if (move_uploaded_file($fileTmpPath, $uploadDir .$newFileName)) {
                $uploadedImage =$newFileName; 
            }
        }
    }

    $cate_id    = mt_rand(11111, 99999);$cate_name  = mysqli_real_escape_string($conn,$_POST["cate_name"]);
    $meta_title = mysqli_real_escape_string($conn,$_POST["meta_title"]);
    $meta_key   = mysqli_real_escape_string($conn,$_POST["meta_key"]);
    $meta_desc  = mysqli_real_escape_string($conn,$_POST["meta_desc"]);
    $added_on   = date('M d, Y');$parent_id  = mysqli_real_escape_string($conn,$_POST['parent_id']);
    $slug_url   = SlugUrl($cate_name);

    $sql = "INSERT INTO `sub_categories` (`parent_id`, `cate_id`, `categories`, `meta_title`, `meta_desc`, `meta_key`, `sub_cat_img`, `slug_url`, `status`, `added_on`) 
            VALUES ('$parent_id', '$cate_id', '$cate_name', '$meta_title', '$meta_desc', '$meta_key', '$uploadedImage', '$slug_url', 1, '$added_on')";

    if (mysqli_query($conn,$sql)) {
        echo "<script>alert('Sub Category Inserted Successfully!'); window.location.href = 'view-sub-categories.php';</script>";
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }
}

// ==========================================
// 5. GET ALL CATEGORIES
// ==========================================
function get_Category() {
    global $conn;
    $sql = "SELECT * FROM `categories` ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);$sno = 1;
    while ($result = mysqli_fetch_assoc($check)) {
        echo "<tr>
        <td>" . $sno++ . "</td>
        <td>" . $result['cate_id'] . "</td>
        <td>" . $result['categories'] . "</td>
        <td>" . $result['slug_url'] . "</td>
        <td>" . $result['status'] . "</td>
        <td><a href='delete-category.php?id=" . $result['cate_id'] . "' onclick='return confirm(\"Are you sure you want to delete this category?\")'><i class='fa-solid fa-trash text-danger fs-4'></i></a></td>
        <td><a href='edit_category.php?id=" . $result['cate_id'] . "'><i class='fa-solid fa-file-pen fs-4'></i></a></td>
        <td>" . $result['added_on'] . "</td>
        </tr>";
    }
}

// ==========================================
// 6. ADD PRODUCT
// ==========================================
if (isset($_POST["add-product"])) {
    $pro_id = mt_rand(11111, 99999);
    $pro_name       = mysqli_real_escape_string($conn, $_POST['pro_name']);$brand_name     = mysqli_real_escape_string($conn,$_POST['brand_name']);
    $pro_cate       = mysqli_real_escape_string($conn, $_POST['pro_cate']);$pro_sub_cate   = mysqli_real_escape_string($conn,$_POST['pro_sub_cate']);
    $short_description = mysqli_real_escape_string($conn, $_POST['short_desc']);$description    = mysqli_real_escape_string($conn,$_POST['pro_desc']);
    $new_arrival    = mysqli_real_escape_string($conn, $_POST['new_arrival']);$trending       = mysqli_real_escape_string($conn,$_POST['trending']);
    $whole_sale_selling_price = isset($_POST['whole_selling_price']) ? mysqli_real_escape_string($conn,$_POST['whole_selling_price']) : '';
    $qty            = isset($_POST['qty']) ? mysqli_real_escape_string($conn,$_POST['qty']) : '';
    $mrp            = mysqli_real_escape_string($conn, $_POST['mrp']);$selling_price  = mysqli_real_escape_string($conn,$_POST['selling_price']);
    $stock          = mysqli_real_escape_string($conn, $_POST['stock']);$status         = mysqli_real_escape_string($conn,$_POST['status']);

    $folder = 'assets/img/uploads/';
    if (!is_dir($folder)) { mkdir($folder, 0755, true); }

    $filename = "";
    if(isset($_FILES['pro_img'])) {
        foreach ($_FILES['pro_img']['tmp_name'] as $key =>$tempname) {
            $filename =$_FILES['pro_img']['name'][$key];$destination = $folder .$filename;
            move_uploaded_file($tempname,$destination);
        }
    }

    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);$meta_key = mysqli_real_escape_string($conn,$_POST["meta_key"]);
    $meta_desc = mysqli_real_escape_string($conn,$_POST["meta_desc"]);
    $schema_markup = mysqli_real_escape_string($conn, trim($_POST['schema_markup']));$added_on = date('M d, Y');
    $slug_url = SlugUrl($pro_name);

    $sql = "INSERT INTO `products`(`pro_id`, `pro_name`,`brand_name` , `pro_cate`, `pro_sub_cate`, `short_desc`, `description`, `new_arrival`,`trending`, `qty`, `mrp`, `selling_price`, `whole_sale_selling_price`, `stock`, `pro_img`, `status`, `slug_url`, `meta_title`, `meta_desc`, `meta_key`, `schema_markup`, `added_on`) 
            VALUES ('$pro_id', '$pro_name', '$brand_name','$pro_cate', '$pro_sub_cate', '$short_description', '$description', '$new_arrival', '$trending', '$qty','$mrp', '$selling_price', '$whole_sale_selling_price', '$stock', '$filename', '$status', '$slug_url', '$meta_title', '$meta_desc', '$meta_key', '$schema_markup', '$added_on')";

    if (mysqli_query($conn,$sql)) {
        echo "<script>alert('Product Inserted Successfully!'); window.location.href = 'add-products.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// ==========================================
// 7. GET ALL SUB CATEGORIES
// ==========================================
function get_Sub_Category() {
    global $conn; 
    $searchQuery = "";
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);$searchQuery = " WHERE `categories` LIKE '%$search%' OR `slug_url` LIKE '%$search%' ";
    }

    $sql = "SELECT * FROM `sub_categories` $searchQuery ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);$sno = 1;

    if ($check && mysqli_num_rows($check) > 0) {
        while ($result = mysqli_fetch_assoc($check)) {$parent_id = $result['parent_id'];$sql2 = "SELECT `categories` FROM `categories` WHERE `cate_id` = '$parent_id'";
            $check2 = mysqli_query($conn, $sql2);$parent_cate = ""; 

            if ($check2 && mysqli_num_rows($check2) > 0) {
                $parent = mysqli_fetch_assoc($check2);
                $parent_cate =$parent['categories'];
            }

            echo "<tr>
                    <td>" . $sno++ . "</td>
                    <td>" . htmlspecialchars($result['cate_id']) . "</td>
                    <td>" . htmlspecialchars(ucwords($result['categories'])) . "</td>
                    <td>" . htmlspecialchars($parent_cate) . "</td>
                    <td>" . htmlspecialchars($result['slug_url']) . "</td>
                    <td>" . htmlspecialchars($result['status']) . "</td>
                    <td>
                        <a href='delete_sub_category.php?id=" . $result['cate_id'] . "' onclick='return confirm(\"Are you sure you want to delete this sub-category?\")' class='btn btn-danger'>Delete</a>
                    </td>
                    <td><a href='edit_sub_category.php?id=" . $result['cate_id'] . "'><i class='fa-solid fa-file-pen fs-4'></i></a></td>
                    <td>" . htmlspecialchars($result['added_on']) . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9' class='text-center'>No subcategories found</td></tr>";
    }
}

// ==========================================
// 8. GET SUB CATEGORIES VIA AJAX/POST
// ==========================================
if (isset($_POST['cate_id'])) {
    $p_id = mysqli_real_escape_string($conn, $_POST['cate_id']);$sql = "SELECT * FROM `sub_categories` where `parent_id` = '$p_id' ORDER BY id DESC";
    $check = mysqli_query($conn,$sql);
    echo '<option value="">Select</option>';
    while ($result = mysqli_fetch_assoc($check)) {
        echo "<option value=" . $result['cate_id'] . ">" . $result['categories'] . "</option>";
    }
}

// ==========================================
// 9. GET CATEGORY BY ID
// ==========================================
function get_category_by_id($cat_id) {
    global $conn;
    $cat_id = mysqli_real_escape_string($conn, $cat_id);$sql = "SELECT * FROM `categories` WHERE cate_id = '$cat_id' LIMIT 1";
    $result = mysqli_query($conn,$sql);
    return mysqli_fetch_assoc($result);
}

// ==========================================
// 10. GET SUB CATEGORY BY ID
// ==========================================
function get_sub_category_by_id($cat_id) {
    global $conn;
    $cat_id = mysqli_real_escape_string($conn, $cat_id);$sql = "SELECT * FROM `sub_categories` WHERE cate_id = '$cat_id' LIMIT 1";
    $result = mysqli_query($conn,$sql);
    return mysqli_fetch_assoc($result);
}
?>