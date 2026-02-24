<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Edit User</h3>
            <small class="text-muted">Update user details</small>
        </div>

        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light rounded-pill px-4">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/users') ?>" class="btn btn-pastel w-70">
                <i class="bi bi-arrow-left"></i> Back
            </a>

        </div>
    </div>

    <?php if(!empty($error)): ?>
        <div class="alert alert-danger rounded-4">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-4">

            <form method="post" action="<?= base_url('admin/users/edit/'.$user['id']) ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" class="form-control rounded-4"
                           value="<?= $user['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control rounded-4"
                           value="<?= $user['email'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control rounded-4"
                           value="<?= $user['phone'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select rounded-4">
                        <option value="0" <?= ($user['role']==0)?'selected':'' ?>>User</option>
                        <option value="2" <?= ($user['role']==2)?'selected':'' ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-pastel w-100">
                    Update User
                </button>

            </form>

        </div>
    </div>

</div>
