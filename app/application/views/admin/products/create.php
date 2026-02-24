<div class="container mt-4 mb-5" style="max-width:850px;" data-aos="fade-up">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Add Product</h2>
            <p class="text-muted mb-0">Create a new product for Cart-Mart.</p>
        </div>

        <a href="<?= base_url('admin/products') ?>" class="btn btn-light rounded-pill px-4">
            ← Back
        </a>
    </div>

    <div class="card product-card p-4">

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-4"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Product Name</label>
                    <input type="text" name="name" class="form-control rounded-4" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Category</label>
                    <select name="category_id" class="form-select rounded-4" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach($categories as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Original Price (MRP)</label>
                    <input type="number" name="original_price" class="form-control rounded-4" step="0.01" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Offer Price</label>
                    <input type="number" name="offer_price" class="form-control rounded-4" step="0.01" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock</label>
                    <input type="number" name="stock" class="form-control rounded-4" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Product Role</label>
                    <select name="product_role" class="form-select rounded-4" required>
                        <option value="recent">Recent Arrival</option>
                        <option value="featured">Featured</option>
                        <option value="bestseller">Best Seller</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="4" class="form-control rounded-4"></textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Product Image (PNG/JPG/WebP)</label>
                    <input type="file" name="image" class="form-control rounded-4">
                </div>

            </div>

            <button type="submit" name="save" class="btn btn-pastel mt-4 w-100">
                <i class="bi bi-check-circle"></i> Save Product
            </button>

        </form>

    </div>

</div>
