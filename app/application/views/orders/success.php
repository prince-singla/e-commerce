<div class="container mt-4 mb-5" data-aos="fade-up">

    <div class="card product-card p-4">

        <h2 class="fw-bold mb-2 text-success">
            <i class="bi bi-check-circle-fill"></i> Order Placed Successfully!
        </h2>

        <p class="text-muted mb-3">
            Thank you for shopping with <b>Cart-Mart</b>. Your order has been placed successfully.
        </p>

        <div class="row g-4 mt-3">

            <div class="col-md-4">
                <div class="p-3 rounded-4 bg-light">
                    <h6 class="fw-bold mb-2">Order Details</h6>
                    <p class="mb-1"><b>Order ID:</b> #<?= $order['id'] ?></p>
                    <p class="mb-1"><b>Status:</b> <?= ucfirst($order['status']) ?></p>
                    <p class="mb-0"><b>Total:</b> ₹<?= number_format($order['total_amount'], 2) ?></p>
                </div>
            </div>

            <div class="col-md-8">
                <div class="p-3 rounded-4 bg-light">
                    <h6 class="fw-bold mb-3">Items</h6>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($items as $it): ?>
                                <tr>
                                    <td class="fw-semibold d-flex align-items-center gap-2">
                                        <?php if(!empty($it['image'])): ?>
                                            <img src="<?= base_url('uploads/products/'.$it['image']) ?>"
                                                 style="width:45px;height:45px;border-radius:12px;object-fit:cover;">
                                        <?php endif; ?>
                                        <?= $it['name'] ?>
                                    </td>
                                    <td><?= $it['qty'] ?></td>
                                    <td>₹<?= number_format($it['price'], 2) ?></td>
                                    <td class="fw-semibold">₹<?= number_format($it['subtotal'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <div class="text-center mt-4">
            <a href="<?= base_url() ?>" class="btn btn-pastel px-5">
                Continue Shopping
            </a>
        </div>

    </div>

</div>
