<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <div>
            <h2 class="fw-bold mb-1">Checkout</h2>
            <p class="text-muted mb-0">Confirm your order before placing it.</p>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-8" data-aos="fade-up">
            <div class="card product-card p-4">
                <h5 class="fw-bold mb-3">Order Items</h5>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($items as $item): ?>
                            <tr>
                                <td class="fw-semibold"><?= $item['name'] ?></td>
                                <td>₹<?= number_format($item['price'], 2) ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td class="fw-semibold">₹<?= number_format($item['subtotal'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up">
            <div class="card product-card p-4">
                <h5 class="fw-bold mb-3">Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total</span>
                    <span class="fw-bold">₹<?= number_format($grand_total, 2) ?></span>
                </div>

                <hr>

                <form method="post" action="<?= base_url('checkout/place_order') ?>">
                    <button class="btn btn-pastel w-100">
                        Place Order
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="<?= base_url('cart') ?>" class="text-muted text-decoration-none">
                        ← Back to Cart
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>
