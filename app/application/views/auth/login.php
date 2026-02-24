<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success rounded-4">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif; ?>
<div class="container mt-5 mb-5" style="max-width:520px;" data-aos="fade-up">

    <div class="card product-card p-4">
        <h3 class="fw-bold mb-2 text-center">User Login</h3>
        <p class="text-muted text-center mb-4">Login to continue shopping.</p>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-4"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('auth/login') ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-4" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-4" required>
            </div>
            <button class="btn btn-pastel w-100">
                Login
            </button>

            <div class="text-center mt-3">
                <a href="<?= base_url('auth/register') ?>" class="text-muted text-decoration-none">
                    New here? Create account
                </a>
                <a href="<?= base_url('auth/googleLogin') ?>"
                   class="btn btn-danger w-100 mb-2">
                    <i class="bi bi-google"></i> Continue with Google
                </a>
            </div>
            <script src="https://www.google.com/recaptcha/api.js?render=YOUR_SITE_KEY"></script>
            <input type="hidden" name="recaptcha_token" id="recaptcha_token">

        </form>
    </div>

</div>
<script src="https://www.google.com/recaptcha/api.js?render=6Lf_CnYsAAAAAB2dERvfsNc0UGkUOi1YX6TqwT6o"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Lf_CnYsAAAAAB2dERvfsNc0UGkUOi1YX6TqwT6o', {action: 'login'}).then(function(token) {
            document.getElementById('recaptcha_token').value = token;
        });
    });
</script>

