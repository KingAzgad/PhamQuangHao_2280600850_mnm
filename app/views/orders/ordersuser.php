<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <h3 class="card-title mb-4">🛒 Lịch sử mua hàng</h3>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="text-center"><?= $order->id ?></td>
                                    <td><?= htmlspecialchars($order->phone) ?></td>
                                    <td><?= htmlspecialchars($order->address) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></td>
                                    <td class="text-end text-danger fw-semibold"><?= number_format($order->total_amount) ?> VNĐ</td>
                                    <td class="text-center">
                                        <a href="/webbanhang/Orders/detail/<?= $order->id ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center text-muted">Bạn chưa có đơn hàng nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- Quay lại danh sách sản phẩm -->
                <div class="text-center mt-4">
                    <a href="/webbanhang/Product" class="btn btn-outline-secondary">
                        ← Quay lại danh sách sản phẩm
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
