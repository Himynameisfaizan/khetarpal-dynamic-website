<?php
include("./admin/db-conn.php");

// Fetch saari services database se
$sql = "SELECT * FROM services ORDER BY id DESC";
$result = $conn->query($sql);

$pageTitle = 'Our Services';
include("./include/header.php");
include("./include/breadcrumb.php");
?>

<style>
    .btn-view-service {
        display: inline-block;
        background: var(--primary-gold, #C49B3B);
        color: #fff;
        padding: 10px 25px;
        border-radius: 6px;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 15px;
    }
    .btn-view-service:hover {
        background: var(--primary-blue, #0A192F);
        color: #fff;
    }
</style>

<section class="services-page-section">
    <div class="container">

        <h2 class="section-main-title">Our Premium Services</h2>

        <div class="row g-4 justify-content-center">

            <?php
            if ($result && $result->num_rows > 0) {
                $counter = 1;

                while ($row = $result->fetch_assoc()) {
                    $service_id = $row['id'];
                    $service_slug = htmlspecialchars($row['slug_url'] ?? '');
                    $service_name = htmlspecialchars($row['service_name']);
                    $short_desc = htmlspecialchars($row['short_desc']);
                    $long_desc = html_entity_decode($row['long_desc']); 
                    
                    $img_path = !empty($row['img_path']) ? "admin/assets/img/uploads/" . htmlspecialchars($row['img_path']) : "https://placehold.co/600x400/eeeeee/999999?text=Service";
            ?>

            <!-- DYNAMIC SERVICE CARD -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="service-card" style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                    <div class="service-img-wrapper" style="height: 220px; overflow: hidden;">
                        <a href="service-details.php?slug=<?php echo $service_slug; ?>">
                            <img src="<?php echo $img_path; ?>" alt="<?php echo $service_name; ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                    <div class="service-content" style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">
                        <h3 class="service-title" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: var(--primary-blue, #0A192F); margin-bottom: 12px;">
                            <a href="service-details.php?slug=<?php echo $service_slug; ?>" style="text-decoration: none; color: inherit;"><?php echo $counter . ". " . $service_name; ?></a>
                        </h3>
                        <p class="service-desc" style="font-size: 14px; color: #666; margin-bottom: 20px; line-height: 1.6;"><?php echo $short_desc; ?></p>
                        
                        <div class="mt-auto">
                            <a href="service-details.php?slug=<?php echo $service_slug; ?>" class="btn-view-service">
                                View Details <i class="fa-solid fa-arrow-right-long ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                    $counter++; 
                } 
            } else {
                echo "<div class='col-12 text-center py-5 text-muted'><h4>No services added yet. Please check back later.</h4></div>";
            }
            ?>

        </div>
    </div>
</section>

<?php
include("./include/footer.php");
?>