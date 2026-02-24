<footer class="mt-5">
    <div class="container py-5">

        <div class="row g-4">

            <!-- BRAND -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-2 d-flex align-items-center gap-2">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Cart-Mart" style="height:40px;">
                    Cart-Mart
                </h5>

                <p class="text-muted mb-3">
                    Cart-Mart is a modern lifestyle ecommerce brand delivering curated fashion for Men, Women, and Kids.
                    Premium quality, smooth experience, and fast delivery across India.
                </p>

                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- QUICK LINKS -->
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a class="text-decoration-none text-muted" href="<?= base_url() ?>">Home</a></li>
                    <li class="mb-2"><a class="text-decoration-none text-muted" href="<?= base_url('products/category/men') ?>">Men</a></li>
                    <li class="mb-2"><a class="text-decoration-none text-muted" href="<?= base_url('products/category/women') ?>">Women</a></li>
                    <li class="mb-2"><a class="text-decoration-none text-muted" href="<?= base_url('products/category/kids') ?>">Kids</a></li>
                    <li class="mb-2"><a class="text-decoration-none text-muted" href="<?= base_url('cart') ?>">Cart</a></li>

                    <!-- Admin -->
                    <li class="mb-2">
                        <a class="text-decoration-none text-muted" href="<?= base_url('admin/login') ?>">Admin Login</a>
                    </li>
                </ul>

            </div>

            <!-- SERVICES -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">Services</h6>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="bi bi-truck me-2"></i>Fast Delivery in India</li>
                    <li class="mb-2"><i class="bi bi-arrow-repeat me-2"></i>7 Days Easy Return</li>
                    <li class="mb-2"><i class="bi bi-credit-card me-2"></i>Secure Payments</li>
                    <li class="mb-2"><i class="bi bi-headset me-2"></i>24/7 Customer Support</li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">Contact</h6>

                <p class="text-muted mb-2">
                    <i class="bi bi-geo-alt me-2"></i>
                    Cart-Mart Pvt. Ltd.<br>
                    2nd Floor, Sector 34A,<br>
                    Chandigarh, India (160022)
                </p>

                <p class="text-muted mb-2">
                    <i class="bi bi-telephone me-2"></i>
                    +91 98765 43210
                </p>

                <p class="text-muted mb-0">
                    <i class="bi bi-envelope me-2"></i>
                    support@cartmart.in
                </p>
            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="mb-0 text-muted">
                © <?= date('Y') ?> CartMart. All rights reserved.
            </p>

            <div class="d-flex gap-3">
                <a href="#" class="text-decoration-none text-muted">Privacy Policy</a>
                <a href="#" class="text-decoration-none text-muted">Terms</a>
                <a href="#" class="text-decoration-none text-muted">Refund Policy</a>
            </div>
        </div>

    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({
        duration: 700,
        once: true
    });
</script>

<script src="<?= base_url('assets/js/main.js') ?>"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
</body>
</html>


