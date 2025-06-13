<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách danh mục</h2>
        <a href="/webbanhang/category/add" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm danh mục
        </a>
    </div>

    <?php if (!empty($categories)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td><?= $cat->id ?></td>
                        <td><?= htmlspecialchars($cat->name) ?></td>
                        <td><?= htmlspecialchars($cat->description) ?></td>
                        <td>
                            <a href="/webbanhang/category/edit/<?= $cat->id ?>" class="btn btn-warning btn-sm text-white">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="/webbanhang/category/delete/<?= $cat->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Không có danh mục nào.</p>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('Vui lòng đăng nhập');
            location.href = '/webbanhang/account/login';
            return;
        }

        function deleteCategory(id) {
            if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
                fetch(`/webbanhang/api/category/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Đã xảy ra lỗi khi xóa danh mục.');
                        }
                    });
            }
        }
    });
</script>