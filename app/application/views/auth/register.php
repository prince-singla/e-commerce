<div class="container mt-5 mb-5" style="max-width:620px;" data-aos="fade-up">

    <div class="card product-card p-4">
        <h3 class="fw-bold mb-2 text-center">Create Account</h3>
        <p class="text-muted text-center mb-4">Join Cart-Mart to buy amazing products.</p>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-4"><?= $error ?></div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success rounded-4">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" action="<?= base_url('auth/register') ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control rounded-4" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-4" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control rounded-4">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-4" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Gender</label><br>

                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female" class="ms-3"> Female
                <input type="radio" name="gender" value="Others" class="ms-3"> Others
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Hobbies</label><br>

                <input type="checkbox" name="hobbies[]" value="Cricket"> Cricket
                <input type="checkbox" name="hobbies[]" value="Music" class="ms-3"> Music
                <input type="checkbox" name="hobbies[]" value="Reading" class="ms-3"> Reading
                <input type="checkbox" name="hobbies[]" value="Gaming" class="ms-3"> Gaming
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Profile Image</label>
                <input type="file" name="image" class="form-control rounded-4">
            </div>

            <button class="btn btn-pastel w-100">
                Register
            </button>

            <div class="text-center mt-3">
                <a href="<?= base_url('auth/login') ?>" class="text-muted text-decoration-none">
                    Already have an account? Login
                </a>
            </div>

        </form>
    </div>

</div>
