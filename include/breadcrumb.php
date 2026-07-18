<style>
    .breadcrumb-section {
        background-color: var(--primary-blue, #0A192F);
        background-image: url('assets/img/banner/size-extra-large-wide/spice-banner.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        padding: 80px 0;
        text-align: center;
        color: #ffffff;
        border-bottom: 3px solid var(--primary-gold, #C49B3B);
    }

    .breadcrumb-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(10, 25, 47, 0.85);
        /* Dark Navy Overlay */
        z-index: 1;
    }

    .breadcrumb-content {
        position: relative;
        z-index: 2;
    }

    .breadcrumb-title {
        font-family: 'Poppins', sans-serif;
        font-size: 38px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
        letter-spacing: 1px;
    }

    .breadcrumb-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 500;
    }

    .breadcrumb-nav li {
        display: flex;
        align-items: center;
    }

    .breadcrumb-nav li a {
        color: var(--primary-gold, #C49B3B);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-nav li a:hover {
        color: #ffffff;
    }

    .breadcrumb-nav li.active {
        color: #d1d1d1;
    }

    .breadcrumb-nav li:not(:last-child)::after {
        content: '\f105';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        margin-left: 12px;
        color: #888888;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .breadcrumb-section {
            padding: 60px 0;
        }

        .breadcrumb-title {
            font-size: 28px;
        }

        .breadcrumb-nav {
            font-size: 14px;
        }
    }
</style>

<section class="breadcrumb-section">
    <div class="breadcrumb-overlay"></div>
    <div class="container">
        <div class="breadcrumb-content">

            <h1 class="breadcrumb-title">
                <?php echo isset($pageTitle) ? $pageTitle : 'Page Title'; ?>
            </h1>

            <ul class="breadcrumb-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active">
                    <?php echo isset($pageTitle) ? $pageTitle : 'Current Page'; ?>
                </li>
            </ul>

        </div>
    </div>
</section>