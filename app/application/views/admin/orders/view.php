<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Order #<?= $order['id'] ?></h3>
            <small class="text-muted">Placed on <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light rounded-pill px-4">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/orders') ?>" class="btn btn-pastel w-100">
                <i class="bi bi-arrow-left"></i> Back
            </a>

        </div>
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

    <div class="row g-4">

        <div class="col-lg-4">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Customer</h5>

                    <div class="mb-2"><strong>Name:</strong> <?= $order['user_name'] ?></div>
                    <div class="mb-2"><strong>Email:</strong> <?= $order['user_email'] ?></div>
                    <div class="mb-2"><strong>Phone:</strong> <?= !empty($order['user_phone']) ? $order['user_phone'] : '-' ?></div>

                    <hr>

                    <h5 class="fw-bold mb-3">Order Summary</h5>

                    <div class="mb-2"><strong>Total:</strong> ₹<?= number_format($order['total_amount'], 2) ?></div>
                    <div class="mb-2"><strong>Status:</strong> <?= strtoupper($order['status']) ?></div>

                    <hr>

                    <form method="post" action="<?= base_url('admin/orders/update_status/'.$order['id']) ?>">
                        <label class="form-label fw-semibold">Update Status</label>

                        <select name="status" class="form-select rounded-4 mb-3">
                            <option value="pending" <?= ($order['status']=='pending')?'selected':'' ?>>Pending</option>
                            <option value="shipped" <?= ($order['status']=='shipped')?'selected':'' ?>>Shipped</option>
                            <option value="delivered" <?= ($order['status']=='delivered')?'selected':'' ?>>Delivered</option>
                            <option value="cancelled" <?= ($order['status']=='cancelled')?'selected':'' ?>>Cancelled</option>
                        </select>

                        <button type="submit" class="btn btn-pastel w-100">
                            Update
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Items</h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach($items as $it): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <?php if(!empty($it['image'])): ?>
                                                <img src="<?= base_url('uploads/products/'.$it['image']) ?>"
                                                     style="width:55px;height:55px;object-fit:contain;background:#f8f9ff;padding:6px;border-radius:12px;">
                                            <?php else: ?>
                                                <img src="https://picsum.photos/80/80?random=<?= $it['product_id'] ?>"
                                                     style="width:55px;height:55px;object-fit:contain;background:#f8f9ff;padding:6px;border-radius:12px;">
                                            <?php endif; ?>

                                            <div class="fw-semibold">
                                                <?= $it['name'] ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>₹<?= number_format($it['price'], 2) ?></td>
                                    <td><?= $it['qty'] ?></td>
                                    <td class="text-end fw-semibold">₹<?= number_format($it['subtotal'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <h5 class="fw-bold">
                            Total: ₹<?= number_format($order['total_amount'], 2) ?>
                        </h5>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
