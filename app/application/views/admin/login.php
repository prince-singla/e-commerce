<div class="container mt-5 mb-5" style="max-width:520px;" data-aos="fade-up">

    <div class="card product-card p-4">
        <h3 class="fw-bold mb-2 text-center">Admin Login</h3>
        <p class="text-muted text-center mb-4">Login to manage Cart-Mart products.</p>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-4"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/login') ?>">

        <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-4" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-4" required>
            </div>

            <button type="submit" name="login" class="btn btn-pastel w-100">
                Login
            </button>

            <div class="text-center mt-3">
                <a href="<?= base_url() ?>" class="text-muted text-decoration-none">
                    ← Back to Website
                </a>
            </div>
        </form>
    </div>

</div>
