<?php
// SEO ke liye proper 404 HTTP status code send karein
http_response_code(404);
include 'admin/db-conn.php';

if (file_exists('include/header.php')) {
    include 'include/header.php';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Khetarpal Trading Co.</title>
    <meta name="description"
        content="The page you are looking for could not be found. Explore Khetarpal Trading Co.'s premium export-quality Indian spices, seeds, and agricultural commodities.">
    <meta name="robots" content="noindex, follow">

    <style>
    :root {
        --ktc-navy: #0e1b2e;
        /* Homepage Dark Navy Theme */
        --ktc-navy-light: #16263f;
        /* Secondary Navy */
        --ktc-gold: #c59b27;
        /* Homepage Golden Mustard Accent */
        --ktc-gold-hover: #ab841d;
        /* Darker Gold for Hover */
        --ktc-bg-light: #f8f9fa;
        /* Soft Section Background */
        --ktc-text-dark: #1e293b;
        --ktc-text-muted: #64748b;
    }

    .ktc-404-wrap {
        background-color: var(--ktc-bg-light);
        background-image:
            radial-gradient(circle at 85% 15%, rgba(197, 155, 39, 0.10), transparent 45%),
            radial-gradient(circle at 15% 85%, rgba(14, 27, 46, 0.06), transparent 45%);
        color: var(--ktc-text-dark);
        padding: 90px 20px;
        min-height: 72vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-bottom: 4px solid var(--ktc-gold);
    }

    .ktc-404-card {
        position: relative;
        z-index: 2;
        max-width: 700px;
        width: 100%;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid rgba(14, 27, 46, 0.08);
        border-top: 5px solid var(--ktc-navy);
        padding: 55px 45px;
        border-radius: 10px;
        box-shadow: 0 18px 40px rgba(14, 27, 46, 0.07);
    }

    @media (max-width: 576px) {
        .ktc-404-wrap {
            padding: 60px 15px;
        }

        .ktc-404-card {
            padding: 40px 22px;
        }
    }

    .ktc-404-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(197, 155, 39, 0.14);
        color: #9a7513;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 7px 18px;
        border-radius: 50px;
        margin-bottom: 18px;
    }

    .ktc-404-code {
        font-size: clamp(5rem, 12vw, 7.5rem);
        font-weight: 900;
        line-height: 1;
        margin-bottom: 8px;
        color: var(--ktc-navy);
        text-shadow: 3px 3px 0 rgba(197, 155, 39, 0.25);
        letter-spacing: -2px;
    }

    .ktc-404-divider {
        width: 60px;
        height: 3px;
        background-color: var(--ktc-gold);
        margin: 0 auto 20px;
        border-radius: 2px;
    }

    .ktc-404-title {
        font-size: clamp(1.4rem, 3vw, 1.9rem);
        font-weight: 800;
        margin-bottom: 14px;
        color: var(--ktc-navy);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .ktc-404-desc {
        color: var(--ktc-text-muted);
        font-size: 1.02rem;
        margin-bottom: 32px;
        line-height: 1.65;
        max-width: 560px;
        margin-left: auto;
        margin-right: auto;
    }

    .ktc-404-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
        margin-bottom: 35px;
    }

    .btn-ktc-gold {
        background-color: var(--ktc-gold);
        color: #ffffff !important;
        padding: 13px 28px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.92rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 2px solid var(--ktc-gold);
    }

    .btn-ktc-gold:hover {
        background-color: var(--ktc-navy);
        border-color: var(--ktc-navy);
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 27, 46, 0.18);
    }

    .btn-ktc-outline {
        background-color: transparent;
        color: var(--ktc-navy) !important;
        padding: 13px 28px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.92rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 2px solid rgba(14, 27, 46, 0.25);
    }

    .btn-ktc-outline:hover {
        background-color: var(--ktc-navy);
        border-color: var(--ktc-navy);
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    .ktc-quick-links {
        padding-top: 22px;
        border-top: 1px solid rgba(14, 27, 46, 0.08);
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 18px;
        font-size: 0.92rem;
        font-weight: 600;
    }

    .ktc-quick-links span {
        color: #94a3b8;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.8px;
    }

    .ktc-quick-links a {
        color: var(--ktc-navy);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ktc-quick-links a:hover {
        color: var(--ktc-gold);
    }
    </style>
</head>

<body>

    <div class="ktc-404-wrap">
        <div class="ktc-404-card">
            <div class="ktc-404-badge">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error 404 • Page Not Found
            </div>

            <h1 class="ktc-404-code">404</h1>
            <div class="ktc-404-divider"></div>

            <h2 class="ktc-404-title">Oops! We Couldn't Find That Page</h2>
            <p class="ktc-404-desc">
                The agricultural product, category, or page you are looking for might have been moved, renamed, or is
                temporarily unavailable. Explore our export catalog or return to the homepage below.
            </p>

            <div class="ktc-404-actions">
                <a href="<?php echo $site ?? 'index.php'; ?>" class="btn-ktc-gold">
                    <i class="fa fa-home" aria-hidden="true"></i> Back to Homepage
                </a>
                <a href="<?php echo isset($site) ? $site . 'products.php' : 'products.php'; ?>" class="btn-ktc-outline">
                    <i class="fa fa-leaf" aria-hidden="true"></i> View Our Products
                </a>
            </div>

            <div class="ktc-quick-links">
                <span>Quick Links:</span>
                <a href="<?php echo isset($site) ? $site . 'about.php' : 'about.php'; ?>">About Us</a>
                <a href="<?php echo isset($site) ? $site . 'products.php' : 'products.php'; ?>">Spices & Seeds</a>
                <a href="<?php echo isset($site) ? $site . 'blog.php' : 'blog.php'; ?>">Latest News</a>
                <a href="<?php echo isset($site) ? $site . 'contact.php' : 'contact.php'; ?>">Request a Quote</a>
            </div>
        </div>
    </div>

    <?php 
    if (file_exists('include/footer.php')) {
        include 'include/footer.php';
    }
    ?>

</body>

</html>