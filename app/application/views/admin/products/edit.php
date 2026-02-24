<div class="container mt-4 mb-5" style="max-width:850px;" data-aos="fade-up">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Edit Product</h2>
            <p class="text-muted mb-0">Update product information.</p>
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
                    <input type="text" name="name" class="form-control rounded-4"
                           value="<?= $product['name'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Category</label>
                    <select name="category_id" class="form-select rounded-4" required>
                        <?php foreach($categories as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= ($product['category_id']==$c['id'])?'selected':'' ?>>
                                <?= $c['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Original Price (MRP)</label>
                    <input type="number" name="original_price" class="form-control rounded-4"
                           step="0.01" value="<?= $product['original_price'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Offer Price</label>
                    <input type="number" name="offer_price" class="form-control rounded-4"
                           step="0.01" value="<?= $product['offer_price'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock</label>
                    <input type="number" name="stock" class="form-control rounded-4"
                           value="<?= $product['stock'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Product Role</label>
                    <select name="product_role" class="form-select rounded-4" required>
                        <option value="recent" <?= ($product['product_role']=='recent')?'selected':'' ?>>Recent Arrival</option>
                        <option value="featured" <?= ($product['product_role']=='featured')?'selected':'' ?>>Featured</option>
                        <option value="bestseller" <?= ($product['product_role']=='bestseller')?'selected':'' ?>>Best Seller</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="4" class="form-control rounded-4"><?= $product['description'] ?></textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Product Image</label>
                    <input type="file" name="image" class="form-control rounded-4">

                    <div class="mt-3">
                        <?php if(!empty($product['image'])): ?>
                            <img src="<?= base_url('uploads/products/'.$product['image']) ?>"
                                 style="width:130px;height:130px;object-fit:cover;border-radius:18px;">
                        <?php else: ?>
                            <span class="text-muted">No image uploaded.</span>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <button type="submit" name="update" class="btn btn-pastel mt-4 w-100">
                <i class="bi bi-check-circle"></i> Update Product
            </button>

        </form>

    </div>

</div>
