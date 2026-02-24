<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Orders</h3>
            <small class="text-muted">Manage all customer orders</small>
        </div>
        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>

    <?php if(empty($orders)): ?>
        <div class="alert alert-warning rounded-4">
            No orders found.
        </div>
    <?php else: ?>

        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
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
                                <td>
                                    <div class="fw-semibold"><?= $o['user_name'] ?></div>
                                    <div class="small text-muted"><?= $o['user_email'] ?></div>
                                </td>
                                <td class="fw-semibold">₹<?= number_format($o['total_amount'], 2) ?></td>

                                <td>
                                    <?php
                                    $badge = "secondary";
                                    if($o['status'] == 'pending') $badge = "warning";
                                    if($o['status'] == 'shipped') $badge = "info";
                                    if($o['status'] == 'delivered') $badge = "success";
                                    if($o['status'] == 'cancelled') $badge = "danger";
                                    ?>
                                    <span class="badge bg-<?= $badge ?> text-uppercase">
                                        <?= $o['status'] ?>
                                    </span>
                                </td>

                                <td><?= date('d M Y, h:i A', strtotime($o['created_at'])) ?></td>

                                <td class="text-end">
                                    <a href="<?= base_url('admin/orders/view/'.$o['id']) ?>" class="btn btn-sm btn-pastel">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    <?php endif; ?>

</div>
