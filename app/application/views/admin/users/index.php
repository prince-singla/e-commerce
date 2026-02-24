<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Users</h3>
            <small class="text-muted">Manage registered users</small>
        </div>

        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success rounded-4">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger rounded-4">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if(empty($users)): ?>
        <div class="alert alert-warning rounded-4">
            No users found.
        </div>
    <?php else: ?>

        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($users as $u): ?>
                            <tr>
                                <td class="fw-semibold">#<?= $u['id'] ?></td>
                                <td><?= $u['name'] ?></td>
                                <td><?= $u['email'] ?></td>
                                <td><?= !empty($u['phone']) ? $u['phone'] : '-' ?></td>
                                <td>
                                    <?php if($u['role'] == 2): ?>
                                        <span class="badge bg-dark">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">User</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-end">
                                    <a href="<?= base_url('admin/users/edit/'.$u['id']) ?>"
                                       class="btn btn-sm btn-pastel">
                                        Edit
                                    </a>

                                    <?php if($u['id'] != $this->session->userdata('user_id')): ?>
                                        <a href="<?= base_url('admin/users/delete/'.$u['id']) ?>"
                                           onclick="return confirm('Delete this user?')"
                                           class="btn btn-sm btn-danger">
                                            Delete
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    <?php endif; ?>

</div>
