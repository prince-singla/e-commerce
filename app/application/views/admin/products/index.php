<div class="container mt-4 mb-5" data-aos="fade-up">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Manage Products</h2>
            <p class="text-muted mb-0">Add, edit, delete products for Cart-Mart.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/products/create') ?>" class="btn btn-pastel">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light rounded-pill px-4">
                Dashboard
            </a>
        </div>
    </div>

    <div class="card product-card p-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Role</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php if(empty($products)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No products added yet.
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach($products as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>

                            <td>
                                <?php if(!empty($p['image'])): ?>
                                    <img src="<?= base_url('uploads/products/'.$p['image']) ?>" style="width:55px;height:55px;object-fit:cover;border-radius:12px;">
                                <?php else: ?>
                                    <img src="https://picsum.photos/100?random=<?= $p['id'] ?>" style="width:55px;height:55px;object-fit:cover;border-radius:12px;">
                                <?php endif; ?>
                            </td>

                            <td class="fw-semibold"><?= $p['name'] ?></td>
                            <td><?= $p['category_name'] ?></td>

                            <td>
                  <span class="badge rounded-pill bg-dark text-uppercase">
                    <?= $p['product_role'] ?>
                  </span>
                            </td>

                            <td>
                                ₹<?= $p['offer_price'] ?> <br>
                                <small class="text-muted">MRP: ₹<?= $p['original_price'] ?></small>
                            </td>

                            <td>
                                <?php if($p['stock'] > 0): ?>
                                    <span class="badge rounded-pill bg-success"><?= $p['stock'] ?></span>
                                <?php else: ?>
                                    <span class="badge rounded-pill bg-danger">0</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end">
                                <a href="<?= base_url('admin/products/edit/'.$p['id']) ?>" class="btn btn-sm btn-light rounded-pill">
                                    Edit
                                </a>

                                <a href="<?= base_url('admin/products/delete/'.$p['id']) ?>"
                                   onclick="return confirm('Delete this product?')"
                                   class="btn btn-sm btn-danger rounded-pill">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
