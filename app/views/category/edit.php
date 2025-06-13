<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h2>Sửa danh mục</h2>
    <form id="category-edit-form" action="/webbanhang/category/update" method="post" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($category->id) ?>">
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" id="name" name="name" class="form-control" required value="<?= htmlspecialchars($category->name) ?>">
            <?php if (!empty($errors['name'])): ?>
                <small class="text-danger server-error"><?= htmlspecialchars($errors['name']) ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($category->description) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
        <a href="/webbanhang/category" class="btn btn-secondary mt-2">Quay lại</a>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('category-edit-form');

    form.addEventListener('submit', function (e) {
        // Xóa lỗi client cũ nếu có
        const oldErrors = form.querySelectorAll('.client-error');
        oldErrors.forEach(el => el.remove());

        let hasError = false;

        // Lấy giá trị
        const nameInput = form.querySelector('input[name="name"]');
        const name = nameInput.value.trim();

        // Kiểm tra tên danh mục
        if (name.length === 0) {
            showError(nameInput, 'Tên danh mục không được để trống.');
            hasError = true;
        } else if (name.length < 3) {
            showError(nameInput, 'Tên danh mục phải có ít nhất 3 ký tự.');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
            // Tự động focus vào trường đầu tiên lỗi
            const firstErrorInput = form.querySelector('.client-error').previousElementSibling;
            if (firstErrorInput) firstErrorInput.focus();
        }
    });

    function showError(inputElem, message) {
        const small = document.createElement('small');
        small.classList.add('text-danger', 'client-error');
        small.textContent = message;
        inputElem.parentNode.appendChild(small);
    }
});
</script>
