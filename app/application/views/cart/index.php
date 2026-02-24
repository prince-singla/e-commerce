<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <div>
            <h2 class="fw-bold mb-1">Your Cart</h2>
            <p class="text-muted mb-0">Review your items before checkout.</p>
        </div>

        <?php if(!empty($items)): ?>
            <a href="<?= base_url('cart/clear') ?>" class="btn btn-light rounded-pill px-4"
               onclick="return confirm('Clear cart?')">
                Clear Cart
            </a>
        <?php endif; ?>
    </div>

    <?php if(empty($items)): ?>
        <div class="alert alert-warning rounded-4" data-aos="fade-up">
            Your cart is empty.
            <a href="<?= base_url() ?>" class="fw-semibold">Continue shopping</a>
        </div>
    <?php else: ?>

        <form method="post" action="<?= base_url('cart/update') ?>">
            <div class="card product-card p-3">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th style="width:140px;">Qty</th>
                            <th>Subtotal</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($items as $item): ?>
                            <tr>

                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if(!empty($item['image'])): ?>
                                            <img src="<?= base_url('uploads/products/'.$item['image']) ?>"
                                                 style="width:65px;height:65px;object-fit:cover;border-radius:14px;">
                                        <?php else: ?>
                                            <img src="https://picsum.photos/100?random=<?= $item['id'] ?>"
                                                 style="width:65px;height:65px;object-fit:cover;border-radius:14px;">
                                        <?php endif; ?>

                                        <div>
                                            <div class="fw-semibold"><?= $item['name'] ?></div>
                                            <small class="text-muted">Stock: <?= $item['stock'] ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td class="fw-semibold">₹<?= number_format($item['price'], 2) ?></td>

                                <td>
                                    <input type="number"
                                           name="qty[<?= $item['id'] ?>]"
                                           value="<?= $item['qty'] ?>"
                                           min="1"
                                           max="<?= $item['stock'] ?>"
                                           class="form-control rounded-4">
                                </td>

                                <td class="fw-semibold">₹<?= number_format($item['subtotal'], 2) ?></td>

                                <td class="text-end">
                                    <a href="<?= base_url('cart/remove/'.$item['id']) ?>"
                                       onclick="return confirm('Remove this item?')"
                                       class="btn btn-sm btn-danger rounded-pill">
                                        Remove
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row mt-4 g-4">

                <div class="col-md-7">
                    <div class="card product-card p-4" data-aos="fade-up">
                        <h5 class="fw-bold mb-2">Cart Tips</h5>
                        <ul class="text-muted mb-0">
                            <li>Update quantity and press “Update Cart”.</li>
                            <li>Checkout will be enabled in the next step.</li>
                            <li>Stock is checked automatically.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card product-card p-4" data-aos="fade-up">
                        <h5 class="fw-bold mb-3">Cart Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total</span>
                            <span class="fw-bold">₹<?= number_format($grand_total, 2) ?></span>
                        </div>

                        <button type="submit" class="btn btn-light rounded-pill w-100 mb-2">
                            Update Cart
                        </button>

                        <a href="<?= base_url('checkout') ?>" class="btn btn-pastel w-100">
                            Proceed to Checkout
                        </a>


                        <div class="text-center mt-3">
                            <a href="<?= base_url() ?>" class="text-muted text-decoration-none">
                                ← Continue Shopping
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    <?php endif; ?>

</div>
