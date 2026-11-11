<?php
// XML header define kar rahe hain taki browser isko valid sitemap samjhe
header("Content-Type: application/xml; charset=utf-8");
include './admin/db-conn.php'; 

// Base URL set karo (Live server ke liye)
$baseUrl = "https://www.khetarpalinternational.com/";

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // 1. Static Pages
    $staticPages = [
    ["url" => "", "priority" => "1.0", "changefreq" => "daily"],
    ["url" => "about", "priority" => "0.8", "changefreq" => "monthly"],
    ["url" => "product", "priority" => "0.9", "changefreq" => "daily"],
    ["url" => "services", "priority" => "0.9", "changefreq" => "monthly"],
    ["url" => "blogs", "priority" => "0.8", "changefreq" => "weekly"],
    ["url" => "contact", "priority" => "0.8", "changefreq" => "monthly"]
    ];

    foreach ($staticPages as $page) {
    echo '<url>' . "\n";
        echo ' <loc>' . $baseUrl . $page['url'] . '</loc>' . "\n";
        echo ' <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
        echo ' <priority>' . $page['priority'] . '</priority>' . "\n";
        echo '</url>' . "\n";
    }

    if (isset($conn)) {

    // 2. Dynamic Categories
    $catQuery = mysqli_query($conn, "SELECT slug_url FROM categories WHERE status = 1");
    if ($catQuery && mysqli_num_rows($catQuery) > 0) {
    while ($row = mysqli_fetch_assoc($catQuery)) {
    if (!empty($row['slug_url'])) {
    // Spaces ko url-safe format mein convert karna
    $safe_slug = str_replace(' ', '%20', trim($row['slug_url']));
    echo '<url>' . "\n";
        echo ' <loc>' . $baseUrl . 'category/' . $safe_slug . '</loc>' . "\n";
        echo ' <changefreq>weekly</changefreq>' . "\n";
        echo ' <priority>0.8</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 3. Dynamic Products
    $prodQuery = mysqli_query($conn, "SELECT slug_url FROM products WHERE status = 1");
    if ($prodQuery && mysqli_num_rows($prodQuery) > 0) {
    while ($row = mysqli_fetch_assoc($prodQuery)) {
    if (!empty($row['slug_url'])) {
    $safe_slug = str_replace(' ', '%20', trim($row['slug_url']));
    echo '<url>' . "\n";
        echo ' <loc>' . $baseUrl . 'product/' . $safe_slug . '</loc>' . "\n";
        echo ' <changefreq>weekly</changefreq>' . "\n";
        echo ' <priority>0.9</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 4. Dynamic Blogs (Fixed: Changed 'slug_url' to 'slug')
    $blogQuery = mysqli_query($conn, "SELECT slug FROM blogs WHERE status = 'published'");
    if ($blogQuery && mysqli_num_rows($blogQuery) > 0) {
    while ($row = mysqli_fetch_assoc($blogQuery)) {
    if (!empty($row['slug'])) {
    $safe_slug = str_replace(' ', '%20', trim($row['slug']));
    echo '<url>' . "\n";
        echo ' <loc>' . $baseUrl . 'blog/' . $safe_slug . '</loc>' . "\n";
        echo ' <changefreq>weekly</changefreq>' . "\n";
        echo ' <priority>0.7</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 5. Dynamic Services
    $serviceQuery = mysqli_query($conn, "SELECT slug_url FROM services");
    if ($serviceQuery && mysqli_num_rows($serviceQuery) > 0) {
    while ($row = mysqli_fetch_assoc($serviceQuery)) {
    if (!empty($row['slug_url'])) {
    $safe_slug = str_replace(' ', '%20', trim($row['slug_url']));
    echo '<url>' . "\n";
        echo ' <loc>' . $baseUrl . 'service/' . $safe_slug . '</loc>' . "\n";
        echo ' <changefreq>monthly</changefreq>' . "\n";
        echo ' <priority>0.8</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 6. DYNAMIC CUSTOM PAGES (Admin Panel Created)
    $pageQuery = mysqli_query($conn, "SELECT slug_url FROM custom_pages WHERE status = 1");
    if ($pageQuery && mysqli_num_rows($pageQuery) > 0) {
    while ($row = mysqli_fetch_assoc($pageQuery)) {
    if (!empty($row['slug_url'])) {
    echo " <url>\n";
        echo " <loc>" . $baseUrl . 'page/' . rawurlencode(trim($row['slug_url'])) . "</loc>\n";
        echo " <changefreq>monthly</changefreq>\n";
        echo " <priority>0.8</priority>\n";
        echo " </url>\n";
    }
    }
    }

    }

    echo '</urlset>';
?>