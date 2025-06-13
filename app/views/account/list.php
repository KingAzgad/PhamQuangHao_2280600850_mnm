<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <h3 class="card-title mb-4">👤 Danh sách người dùng</h3>
            <p class="text-muted mb-4">Dưới đây là danh sách tất cả người dùng trong hệ thống.</p>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Quyền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($user->id) ?></td>
                                    <td><?= htmlspecialchars($user->username) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($user->role) ?></td>
                                    <td class="text-center">
                                        <a href="/webbanhang/Account/edit/<?= $user->id ?>" class="btn btn-sm btn-warning">Sửa</a>
                                        <a href="/webbanhang/Account/delete/<?= $user->id ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?')">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Không có người dùng nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="/webbanhang/account/register" class="btn btn-primary">➕ Thêm người dùng mới</a>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
