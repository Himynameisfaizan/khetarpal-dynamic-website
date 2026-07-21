<?php
include("./admin/db-conn.php");

// Fetch saari services database se
$sql = "SELECT * FROM services ORDER BY id DESC";
$result = $conn->query($sql);

$pageTitle = 'Our Services';
include("./include/header.php");
include("./include/breadcrumb.php");
?>

<section class="services-page-section">
    <div class="container">

        <h2 class="section-main-title">Our Premium Services</h2>

        <!-- justify-content-center centers the cards nicely -->
        <div class="row g-4 justify-content-center">

            <?php
            if ($result && $result->num_rows > 0) {
                // Ek counter lagate hain service number dikhane ke liye (jaise tumhare purane code mein "1. ", "2." likha tha)
                $counter = 1;

                while ($row = $result->fetch_assoc()) {
                    $service_id = $row['id'];
                    $service_name = htmlspecialchars($row['service_name']);
                    $short_desc = htmlspecialchars($row['short_desc']);
                    // Long desc CKEditor se aayega isliye htmlspecialchars nahi lagaya
                    $long_desc = html_entity_decode($row['long_desc']); 
                    
                    // Image Path
                    $img_path = !empty($row['img_path']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['img_path']) : "https://placehold.co/600x400/eeeeee/999999?text=Service";
            ?>

            <!-- ==========================================
                 DYNAMIC SERVICE CARD 
            =============================================== -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="service-card">
                    <div class="service-img-wrapper">
                        <img src="<?php echo $img_path; ?>" alt="<?php echo $service_name; ?>" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'">
                    </div>
                    <div class="service-content">
                        <!-- Number + Title -->
                        <h3 class="service-title"><?php echo $counter . ". " . $service_name; ?></h3>
                        <p class="service-desc"><?php echo $short_desc; ?></p>
                        
                        <!-- Modal Trigger Button (Dynamic target ID) -->
                        <button type="button" class="btn-view-service" data-bs-toggle="modal" data-bs-target="#serviceModal<?php echo $service_id; ?>">
                            View Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 DYNAMIC MODAL POPUP
            =============================================== -->
            <div class="modal fade" id="serviceModal<?php echo $service_id; ?>" tabindex="-1" aria-labelledby="serviceModalLabel<?php echo $service_id; ?>" aria-hidden="true">
                <!-- modal-dialog-scrollable added so long text doesn't break screen -->
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: var(--primary-blue, #0A192F); color: #fff; border-bottom: 3px solid var(--primary-gold, #C49B3B);">
                            <h5 class="modal-title" id="serviceModalLabel<?php echo $service_id; ?>"><?php echo $service_name; ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1) grayscale(100%) brightness(200%);"></button>
                        </div>
                        <div class="modal-body" style="padding: 30px;">
                            <!-- Modal Image -->
                            <img src="<?php echo $img_path; ?>" alt="<?php echo $service_name; ?>" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" onerror="this.style.display='none'">
                            
                            <!-- Bold Short Description -->
                            <p style="font-size: 18px; color: var(--primary-gold, #C49B3B);"><strong><?php echo $short_desc; ?></strong></p>
                            
                            <!-- Full HTML Long Description -->
                            <div style="font-family: 'Poppins', sans-serif; color: #444; line-height: 1.8;">
                                <?php 
                                    // Agar long_desc khali hai toh kam se kam short_desc wapas dikha de
                                    echo !empty(trim($long_desc)) ? $long_desc : "<p>Detailed information will be updated soon.</p>"; 
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                    $counter++; // Number badhate jao (1, 2, 3...)
                } // While loop ends
            } else {
                // Empty state if database is empty
                echo "<div class='col-12 text-center py-5 text-muted'><h4>No services added yet. Please check back later.</h4></div>";
            }
            ?>

        </div>
    </div>
</section>

<?php
include("./include/footer.php");
?>