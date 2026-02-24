<div class="container mt-4 mb-5" data-aos="fade-up">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Dashboard</h2>
            <p class="text-muted mb-0">Welcome, <?= $this->session->userdata('name') ?> 👋</p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/products') ?>" class="btn btn-pastel">
                Manage Products
            </a>
            <a href="<?= base_url('admin/logout') ?>" class="btn btn-light rounded-pill px-4">
                Logout
            </a>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card product-card p-4">
                <h5 class="fw-bold mb-2">Products</h5>
                <p class="text-muted mb-3">Add, edit, delete products with images.</p>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-pastel">Go</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card product-card p-4">
                <h5 class="fw-bold mb-2">Orders</h5>
                <p class="text-muted mb-3">Manage orders and shipping status.</p>
                <a href="<?= base_url('admin/orders') ?>" class="btn btn-pastel">
                    View Orders
                </a>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card product-card p-4">
                <h5 class="fw-bold mb-2">Users</h5>
                <p class="text-muted mb-3">View registered users and details.</p>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-pastel">
                    Manage Users
                </a>

            </div>
        </div>

    </div>

</div>
