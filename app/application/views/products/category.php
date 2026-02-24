<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <div>
            <h3 class="fw-bold mb-1"><?= $category['name'] ?></h3>
            <p class="text-muted mb-0">Browse latest products in <?= $category['name'] ?>.</p>
        </div>
    </div>

    <?php if(empty($products)): ?>
        <div class="alert alert-warning rounded-4" data-aos="fade-up">
            No products found in this category.
        </div>
    <?php else: ?>

        <div class="row g-4">
            <?php foreach($products as $p): ?>
                <div class="col-md-3" data-aos="zoom-in">
                    <div class="card product-card">

                        <?php if(!empty($p['image'])): ?>
                            <img src="<?= base_url('uploads/products/'.$p['image']) ?>" alt="<?= $p['name'] ?>">
                        <?php else: ?>
                            <img src="https://picsum.photos/500/400?random=<?= $p['id'] ?>" alt="<?= $p['name'] ?>">
                        <?php endif; ?>

                        <div class="card-body">
                            <h6 class="fw-semibold mb-1"><?= $p['name'] ?></h6>
                            <p class="text-muted small mb-2"><?= substr($p['description'], 0, 40) ?>...</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <?php if($p['offer_price'] < $p['original_price']): ?>
                                        <div class="price-old">₹<?= $p['original_price'] ?></div>
                                        <div class="price-new">₹<?= $p['offer_price'] ?></div>
                                    <?php else: ?>
                                        <div class="price-new">₹<?= $p['original_price'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <a href="<?= base_url('products/view/'.$p['id']) ?>" class="btn btn-sm btn-pastel">
                                    View
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>
