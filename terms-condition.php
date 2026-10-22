<?php
include('config/connect.php');

$pageTitle = "Terms & Conditions | Khetarpal Trading Co.";
$meta_description = "Read the terms and conditions of Khetarpal Trading Co. for purchasing spices, dry fruits, seeds, and kernels.";
$meta_key = "terms and conditions, Khetarpal Trading Co., export terms";

include 'include/header.php';
include 'include/breadcrumb.php';
?>

<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row g-5">
            
            <!-- LEFT COLUMN: Content -->
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm border">
                    <h1 class="mb-4" style="color: #2b5e2c; font-weight: 700;">Terms & Conditions</h1>
                    <p class="text-muted mb-5"><strong>Last Updated:</strong> <?= date('F d, Y'); ?></p>

                    <h4 class="mt-4" style="font-size: 1.1rem; color: #2b5e2c; font-weight: 600;">1. Introduction</h4>
                    <p>Welcome to <strong>Khetarpal Trading Co.</strong>. By browsing our website and purchasing our agricultural commodities, spices, dry fruits, seeds, and kernels, you agree to abide by these Terms & Conditions.</p>

                    <h4 class="mt-4" style="font-size: 1.1rem; color: #2b5e2c; font-weight: 600;">2. Natural Variations in Products</h4>
                    <p>We deal in natural agricultural produce (spices, dry fruits, seeds). Minor variations in color, size, aroma, or texture may occur between harvest batches, which are natural characteristics and not defects.</p>

                    <h4 class="mt-4" style="font-size: 1.1rem; color: #2b5e2c; font-weight: 600;">3. Pricing and Import Duties</h4>
                    <p>Domestic prices include applicable taxes unless specified. For international shipments, the buyer is solely responsible for all destination customs duties, import taxes, and local levies.</p>

                    <h4 class="mt-4" style="font-size: 1.1rem; color: #2b5e2c; font-weight: 600;">4. Culinary Disclaimer</h4>
                    <p>Information on our website regarding spice benefits is for general culinary and informational purposes and does not substitute medical advice.</p>

                    <h4 class="mt-4" style="font-size: 1.1rem; color: #2b5e2c; font-weight: 600;">5. Governing Law</h4>
                    <p>Any disputes arising from purchases or website usage shall be governed by the laws of India and subject to local jurisdiction.</p>

                    <h4 class="mt-4" style="font-size: 1.1rem; color: #2b5e2c; font-weight: 600;">6. Contact Information</h4>
                    <div class="p-3 mt-3 rounded" style="background-color: #f1f5f9; border-left: 4px solid var(--primary-green, #2b5e2c);">
                        <p class="mb-1"><strong>Khetarpal Trading Co.</strong></p>
                        <p class="mb-1"><strong>Email:</strong> khetarpaltradingc@gmail.com</p>
                        <p class="mb-0"><strong>Phone:</strong> +91 63547 65516</p>
                        <p class="mb-0"><strong>Phone:</strong> ++91 89804 32156</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Sidebar Widgets -->
            <div class="col-lg-4">
                <div class="sidebar-widgets position-sticky" style="top: 20px;">
                    <div class="widget-box bg-white p-4 rounded shadow-sm border mb-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Search Products</h5>
                        <form action="products.php" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..." required style="font-size: 0.9rem;">
                            <button type="submit" class="btn text-white px-3" style="background: var(--primary-green, #2b5e2c);"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <div class="widget-box rounded shadow-sm text-center p-4 text-white" style="background: linear-gradient(135deg, var(--primary-green, #2b5e2c) 0%, #1a3f1b 100%);">
                        <div class="icon-wrap mb-3"><i class="fa-solid fa-headset fs-1 text-white opacity-75"></i></div>
                        <h4 class="fw-bold mb-2 text-white">Wholesale Inquiries</h4>
                        <p class="small mb-4 opacity-75">Get in touch for bulk orders and export pricing.</p>
                        <a href="contact.php" class="btn bg-white w-100 fw-bold shadow-sm mb-3" style="color: var(--primary-green, #2b5e2c);">Request Quote</a>
                        <a href="tel:+918448211202" class="text-white text-decoration-none small fw-bold"><i class="fa-solid fa-phone me-1"></i> +91-8448211202</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php 
include 'include/footer.php'; 
?>