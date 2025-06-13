<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h3 class="card-title mb-4">Chi tiết đơn hàng <span class="text-primary">#<?= $order->id ?></span></h3>

            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>Người dùng:</strong> <?= htmlspecialchars($order->name ?? '') ?></li>
                <li class="list-group-item"><strong>Điện thoại:</strong> <?= htmlspecialchars($order->phone ?? '') ?></li>
                <li class="list-group-item"><strong>Địa chỉ:</strong> <?= htmlspecialchars($order->address ?? '') ?></li>
                <li class="list-group-item"><strong>Ngày tạo:</strong> <?= $order->created_at ?? '' ?></li>
            </ul>

            <?php
            $total = 0;
            if (!empty($products)) {
                foreach ($products as $item) {
                    $total += ($item->price ?? 0) * ($item->quantity ?? 0);
                }
            }
            ?>
            <p class="fw-bold fs-5 text-end">Tổng tiền: <span class="text-danger"><?= number_format($total) ?> VNĐ</span></p>

            <h5 class="mt-4 mb-3">Sản phẩm trong đơn hàng</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Mã SP</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $item): ?>
                                <tr>
                                    <td class="text-center"><?= $item->product_id ?></td>
                                    <td class="text-center"><?= $item->quantity ?></td>
                                    <td class="text-end"><?= number_format($item->price) ?> VNĐ</td>
                                    <td class="text-end"><?= number_format($item->price * $item->quantity) ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Không có sản phẩm nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-end">
                <!-- nếu role user thì quay lại /webbanhang/Orders/userOrders -->
                <?php if (SessionHelper::isLoggedIn() && SessionHelper::isAdmin()): ?>
                    <a href="/webbanhang/Orders" class="btn btn-outline-secondary">
                        ← Quay lại danh sách đơn hàng
                    </a>
                <?php else: ?>
                    <a href="/webbanhang/Orders/userOrders" class="btn btn-outline-secondary">
                        ← Quay lại danh sách đơn hàng
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>