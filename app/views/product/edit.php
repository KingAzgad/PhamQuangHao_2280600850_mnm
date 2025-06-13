<?php include 'app/views/shares/header.php'; ?>

<div class="container-fluid bg-light min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>Sửa sản phẩm
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form id="edit-product-form" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="fas fa-tag me-1"></i>Tên sản phẩm
                                        </label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" required>
                                        <div class="error-message" id="nameError"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="price" class="form-label fw-bold">
                                            <i class="fas fa-dollar-sign me-1"></i>Giá
                                        </label>
                                        <input type="number" id="price" name="price" class="form-control form-control-lg" step="0.01" required>
                                        <div class="error-message" id="priceError"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1"></i>Mô tả
                                </label>
                                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                                <div class="error-message" id="descriptionError"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id" class="form-label fw-bold">
                                    <i class="fas fa-folder me-1"></i>Danh mục
                                </label>
                                <select id="category_id" name="category_id" class="form-select form-select-lg" required>
                                    <!-- Render danh mục bằng fetch -->
                                </select>
                                <div class="error-message" id="categoryError"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-image me-1"></i>Ảnh hiện tại
                                        </label>
                                        <div class="current-image-container">
                                            <img id="preview-image" src="" alt="Ảnh hiện tại" class="img-thumbnail d-block" style="max-width: 200px; height: auto;">
                                            <input type="hidden" name="existing_image" id="existing_image">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label fw-bold">
                                            <i class="fas fa-upload me-1"></i>Chọn ảnh mới (tuỳ chọn)
                                        </label>
                                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                        <div class="form-text">Chấp nhận file JPG, PNG, GIF, WEBP</div>
                                        <div class="error-message" id="imageError"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="/webbanhang/Product/" class="btn btn-outline-secondary btn-lg me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i>Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-1"></i>Cập nhật sản phẩm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<style>
.bg-light {
    background-color: #f8f9fa !important;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border-bottom: none;
    padding: 1.5rem;
}

.card-body {
    background-color: #ffffff;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-control-lg {
    padding: 0.75rem 1rem;
    font-size: 1.1rem;
}

.form-label {
    color: #495057;
    margin-bottom: 0.5rem;
}

.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.current-image-container {
    background-color: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
}

.img-thumbnail {
    border: 3px solid #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
}

.form-text {
    color: #6c757d;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }
    
    .d-grid .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}

/* Loading animation */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Fade in animation */
.card {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Lấy productId từ URL
    const urlSegments = window.location.pathname.split('/');
    const productId = urlSegments[urlSegments.length - 1];

    if (!productId || isNaN(productId)) {
        showAlert("ID sản phẩm không hợp lệ.", 'error');
        setTimeout(() => {
            location.href = '/webbanhang/Product';
        }, 2000);
        return;
    }

    // Lấy token từ localStorage
    const token = localStorage.getItem('jwtToken');

    // Tải thông tin sản phẩm
    fetch(`/webbanhang/api/product/${productId}`, {
        headers: {
            'Authorization': token ? `Bearer ${token}` : ''
        }
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error("Vui lòng đăng nhập để chỉnh sửa sản phẩm.");
            } else if (response.status === 404) {
                throw new Error("Sản phẩm không tồn tại.");
            }
            throw new Error("Không thể lấy dữ liệu sản phẩm.");
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('id').value = data.id;
        document.getElementById('name').value = data.name || '';
        document.getElementById('description').value = data.description || '';
        document.getElementById('price').value = data.price || 0;
        document.getElementById('existing_image').value = data.image || '';
        document.getElementById('preview-image').src = data.image ? `/webbanhang/${data.image}` : '/webbanhang/assets/no-image.png';
        loadCategories(data.category_id);
    })
    .catch(error => {
        showAlert(error.message, 'error');
        setTimeout(() => {
            location.href = '/webbanhang/Product';
        }, 2000);
    });

    function loadCategories(selectedId) {
        fetch('/webbanhang/api/category')
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('category_id');
                categorySelect.innerHTML = '<option value="">Chọn danh mục...</option>';
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    if (category.id == selectedId) option.selected = true;
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => {
                showAlert("Không thể tải danh mục.", 'error');
            });
    }

    // Hàm hiển thị thông báo
    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.card-body').insertBefore(alertDiv, document.querySelector('form'));
        
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }

    // Submit form với validation
    document.getElementById('edit-product-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const name = this.name.value.trim();
        const description = this.description.value.trim();
        const price = parseFloat(this.price.value) || 0;
        const categoryId = this.category_id.value;
        const imageInput = this.image;
        const existingImage = this.existing_image.value;
        const imageFile = imageInput.files[0];

        // Validate tên sản phẩm
        if (name.length < 3) {
            showAlert('Tên sản phẩm phải có ít nhất 3 ký tự.', 'warning');
            return;
        }

        // Validate mô tả
        if (description.length < 10) {
            showAlert('Mô tả phải có ít nhất 10 ký tự.', 'warning');
            return;
        }

        // Validate giá
        if (isNaN(price) || price <= 0) {
            showAlert('Giá phải là số lớn hơn 0.', 'warning');
            return;
        }

        // Validate danh mục
        if (!categoryId) {
            showAlert('Vui lòng chọn danh mục.', 'warning');
            return;
        }

        // Validate file ảnh nếu có
        if (imageFile) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const maxSizeMB = 5;
            if (!allowedTypes.includes(imageFile.type)) {
                showAlert('Chỉ cho phép ảnh định dạng JPEG, PNG, GIF hoặc WEBP.', 'warning');
                return;
            }
            if (imageFile.size > maxSizeMB * 1024 * 1024) {
                showAlert(`Kích thước ảnh không được vượt quá ${maxSizeMB}MB.`, 'warning');
                return;
            }
        }

        // Hiển thị loading
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang cập nhật...';
        submitBtn.disabled = true;

        // Gửi form
        const formData = new FormData(this);
        if (!imageFile) {
            formData.set('image', existingImage); // Giữ ảnh cũ nếu không chọn ảnh mới
        }

        const token = localStorage.getItem('jwtToken');

        fetch(`/webbanhang/api/product/${productId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'Authorization': token ? `Bearer ${token}` : ''
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Lỗi server hoặc không được phép.');
            return res.json();
        })
        .then(data => {
            if (data.message === 'Product updated successfully') {
                showAlert('Cập nhật sản phẩm thành công!', 'success');
                setTimeout(() => {
                    location.href = '/webbanhang/Product';
                }, 1500);
            } else {
                showAlert(data.message || 'Cập nhật sản phẩm thất bại.', 'error');
            }
        })
        .catch(err => {
            console.error('Lỗi:', err);
            showAlert('Lỗi kết nối máy chủ hoặc không được phép. Vui lòng kiểm tra đăng nhập.', 'error');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
});
</script>