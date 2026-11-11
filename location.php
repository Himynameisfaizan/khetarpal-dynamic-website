<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include 'admin/db-conn.php';

// Safe Base URL fallback in case header is not processed first
$safe_base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/office_php_project/khetarpal/";
if (isset($base_url)) {
    $safe_base_url = $base_url;
}

// Global SEO Setup for Header
$meta_title = 'Export Hubs & Information | Khetarpal Trading Co.';
$meta_desc = 'Explore regional export locations, agricultural commodities, premium spices, and B2B agro services by Khetarpal Trading Co.';
$meta_key = 'Khetarpal locations, Spices exporter, Agricultural Solutions, B2B agro projects, custom export pages';

// Fetch active custom pages
$customPages = [];
$sql = "SELECT id, page_title, breadcrumb_title, slug_url, content, meta_title, meta_desc, created_at
        FROM custom_pages
        WHERE status = 1 AND slug_url <> ''
        ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $customPages[] = $row;
    }
}
$totalPages = count($customPages);

// Fetch Contact Info for CTA
$contactQuery = mysqli_query($conn, "SELECT phone, email, address FROM contacts LIMIT 1");
$contactInfo = $contactQuery ? mysqli_fetch_assoc($contactQuery) : [];
$sitePhone = !empty($contactInfo['phone']) ? $contactInfo['phone'] : '+91 63547 65516';
$siteEmail = !empty($contactInfo['email']) ? $contactInfo['email'] : 'khetarpaltradingc@gmail.com';

function ktcCleanText($value): string {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

// Ensure header is included correctly (This defines $base_url properly)
include 'include/header.php';
?>

<style>
:root {
    --ktc-navy: #0e1b2e;
    --ktc-gold: #c59b27;
    --ktc-gold-hover: #ab841d;
}

/* KTC Custom Pages Grid Styling */
.ktc-page-card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #eaeaea;
    padding: 25px;
    height: 100%;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
}

.ktc-page-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(14, 27, 46, 0.1);
    border-color: var(--ktc-navy);
}

.ktc-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
}

.ktc-card-icon {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    background: rgba(197, 155, 39, 0.1);
    color: var(--ktc-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.ktc-page-card:hover .ktc-card-icon {
    background: var(--ktc-navy);
    color: #ffffff;
}

.ktc-card-tag {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 4px;
    background: #f8f9fa;
    color: #475569;
}

.ktc-page-card h3 {
    color: var(--ktc-navy);
    font-family: 'Poppins', sans-serif;
    font-size: 1.2rem;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 10px;
    transition: 0.3s;
}

.ktc-page-card:hover h3 {
    color: var(--ktc-gold);
}

.ktc-page-card p {
    color: #64748b;
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
    display: -webkit-box;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ktc-card-footer {
    padding-top: 15px;
    border-top: 1px solid #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--ktc-navy);
    text-transform: uppercase;
    transition: 0.3s;
}

.ktc-page-card:hover .ktc-card-footer {
    color: var(--ktc-gold);
}

/* Filter Search Bar */
.search-filter-box {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    margin-top: -30px;
    position: relative;
    z-index: 9;
    border: 1px solid #eaeaea;
}

.badge-gold {
    background-color: var(--ktc-gold);
    color: #fff;
}
</style>

<main class="main">
    <!-- Breadcrumb using Khetarpal Theme with Inline CSS for stability -->
    <div class="site-breadcrumb"
        style="background-image: url('<?php echo isset($base_url) ? $base_url : ''; ?>assets/img/bg/breadcrumb-bg.jpg'); background-size: cover; background-position: center; padding: 100px 0; text-align: center; position: relative;">
        <!-- Overlay -->
        <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(14, 27, 46, 0.7); z-index: 1;">
        </div>

        <div class="container" style="position: relative; z-index: 2;">
            <h2 class="breadcrumb-title"
                style="color: #fff; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 36px; margin-bottom: 10px;">
                Export Hubs & Information</h2>

            <ul class="breadcrumb-menu"
                style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; gap: 10px; color: #fff; font-size: 15px;">
                <li><a href="<?php echo isset($base_url) ? $base_url : ''; ?>index.php"
                        style="color: var(--ktc-gold); text-decoration: none;">Home</a> <i
                        class="fa fa-angle-double-right" style="font-size: 12px; margin-left: 5px;"></i></li>
                <li class="active">Pages</li>
            </ul>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="container">
        <div class="search-filter-box">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="m-0 fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">
                        <span class="badge badge-gold me-2"><?= $totalPages; ?></span> Active Export Pages
                    </h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i
                                class="fa fa-search text-muted"></i></span>
                        <input type="text" id="pageSearchInput" class="form-control border-start-0"
                            placeholder="Search by location, product or service..." style="box-shadow: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pages Grid Section -->
    <section class="py-5 bg-light mt-4">
        <div class="container pb-5">
            <?php if (!empty($customPages)): ?>
            <div class="row g-4" id="customPagesGrid">
                <?php 
                // Agricultural / Export Icons Array
                $icons = ['fa-leaf', 'fa-seedling', 'fa-wheat-awn', 'fa-earth-americas', 'fa-truck-fast', 'fa-box-open'];
                $index = 0;
                
                foreach ($customPages as $customPage):
                    $cardTitle = trim($customPage['page_title'] ?: $customPage['breadcrumb_title']);
                    $badgeText = trim($customPage['breadcrumb_title'] ?: 'Export Service');
                    
                    $rawDesc = trim(strip_tags($customPage['meta_desc']));
                    if (empty($rawDesc)) {
                        $rawDesc = mb_strimwidth(trim(strip_tags($customPage['content'])), 0, 120, '...');
                    }

                    $slug = trim($customPage['slug_url']);
                    // Clean URL logic matching .htaccess
                    $pageUrl = (isset($base_url) ? $base_url : $safe_base_url) . 'page/' . rawurlencode($slug);
                    $iconClass = $icons[$index % count($icons)];
                    $index++;
                ?>
                <div class="col-lg-4 col-md-6 page-grid-item"
                    data-search="<?= ktcCleanText(strtolower($cardTitle . ' ' . $badgeText . ' ' . $rawDesc)); ?>">
                    <a href="<?= $pageUrl; ?>" class="ktc-page-card">
                        <div class="ktc-card-top">
                            <div class="ktc-card-icon">
                                <i class="fa-solid <?= $iconClass; ?>"></i>
                            </div>
                            <span class="ktc-card-tag"><?= ktcCleanText($badgeText); ?></span>
                        </div>
                        <h3><?= ktcCleanText($cardTitle); ?></h3>
                        <p><?= ktcCleanText($rawDesc); ?></p>
                        <div class="ktc-card-footer">
                            <span>Explore Details</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <div id="noMatchMsg" class="text-center py-5 d-none">
                <h4 class="fw-bold text-muted" style="font-family: 'Poppins', sans-serif;">No matching pages found</h4>
                <p>Try searching with a different product or location keyword.</p>
            </div>

            <?php else: ?>
            <div class="text-center py-5">
                <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                <h3 style="font-family: 'Poppins', sans-serif; color: var(--ktc-navy);">No Custom Pages Found</h3>
                <p class="text-muted">Pages created from the admin panel will appear here.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('pageSearchInput');
    const items = document.querySelectorAll('.page-grid-item');
    const noMatch = document.getElementById('noMatchMsg');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let visibleCount = 0;

            items.forEach(function(item) {
                const text = item.getAttribute('data-search') || '';
                if (text.includes(query)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (noMatch) {
                noMatch.classList.toggle('d-none', visibleCount > 0);
            }
        });
    }
});
</script>

<?php include 'include/footer.php'; ?>