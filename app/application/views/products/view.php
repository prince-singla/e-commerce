<div class="container mt-4 mb-5">

    <div class="row g-4">

        <div class="col-md-5" data-aos="fade-up">
            <div class="card product-card">
                <?php if(!empty($product['image'])): ?>
                    <img src="<?= base_url('uploads/products/'.$product['image']) ?>" alt="<?= $product['name'] ?>" style="height:420px;">
                <?php else: ?>
                    <img src="https://picsum.photos/700/500?random=<?= $product['id'] ?>" alt="<?= $product['name'] ?>" style="height:420px;">
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-7" data-aos="fade-up">
            <h2 class="fw-bold mb-2"><?= $product['name'] ?></h2>
            <p class="text-muted"><?= $product['description'] ?></p>

            <div class="mb-3">
                <?php if($product['offer_price'] < $product['original_price']): ?>
                    <span class="price-old me-2">₹<?= $product['original_price'] ?></span>
                    <span class="price-new fs-4">₹<?= $product['offer_price'] ?></span>
                <?php else: ?>
                    <span class="price-new fs-4">₹<?= $product['original_price'] ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <?php if($product['stock'] > 0): ?>
                    <span class="badge text-bg-success rounded-pill px-3 py-2">In Stock</span>
                <?php else: ?>
                    <span class="badge text-bg-danger rounded-pill px-3 py-2">Out of Stock</span>
                <?php endif; ?>
            </div>

            <div class="d-flex gap-2">
                <?php if($product['stock'] > 0): ?>
                    <button class="btn btn-pastel px-4"
                            id="ajaxAddToCartBtn"
                            data-product-id="<?= $product['id'] ?>">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                <?php else: ?>
                    <button class="btn btn-light rounded-pill px-4" disabled>
                        Out of Stock
                    </button>
                <?php endif; ?>


                <a href="<?= base_url('cart') ?>" class="btn btn-light rounded-pill px-4">
                    Go to Cart
                </a>
            </div>

            <hr class="my-4">

            <h6 class="fw-bold">Services</h6>
            <ul class="text-muted">
                <li>Fast delivery across India</li>
                <li>7 days easy return</li>
                <li>Secure payments</li>
            </ul>
        </div>

    </div>

</div>
