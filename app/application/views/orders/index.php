<div class="container mt-4 mb-5" data-aos="fade-up">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">My Orders</h2>
            <p class="text-muted mb-0">Track your orders in Cart-Mart.</p>
        </div>
    </div>

    <?php if(empty($orders)): ?>
        <div class="alert alert-warning rounded-4">
            You have not placed any orders yet.
        </div>
    <?php else: ?>

        <div class="card product-card p-3">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($orders as $o): ?>
                        <tr>
                            <td class="fw-semibold">#<?= $o['id'] ?></td>
                            <td>₹<?= number_format($o['total_amount'], 2) ?></td>
                            <td>
                  <span class="badge rounded-pill bg-dark text-uppercase">
                    <?= $o['status'] ?>
                  </span>
                            </td>
                            <td><?= date("d M Y", strtotime($o['created_at'])) ?></td>
                            <td class="text-end">
                                <a href="<?= base_url('orders/success/'.$o['id']) ?>" class="btn btn-sm btn-light rounded-pill">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>
