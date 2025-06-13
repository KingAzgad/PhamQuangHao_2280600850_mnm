<?php include 'app/views/shares/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Thêm sản phẩm mới
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form id="add-product-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag text-primary me-1"></i>
                                    Tên sản phẩm <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" 
                                       placeholder="Nhập tên sản phẩm..." required>
                                <div class="form-text">Tên sản phẩm phải có ít nhất 3 ký tự</div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left text-primary me-1"></i>
                                    Mô tả sản phẩm <span class="text-danger">*</span>
                                </label>
                                <textarea id="description" name="description" class="form-control" rows="4" 
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..." required></textarea>
                                <div class="form-text">Mô tả phải có ít nhất 10 ký tự</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-bold">
                                    <i class="fas fa-dollar-sign text-primary me-1"></i>
                                    Giá bán <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" id="price" name="price" class="form-control" 
                                           step="0.01" min="0" placeholder="0.00" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="form-text">Giá phải lớn hơn 0</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-bold">
                                    <i class="fas fa-list text-primary me-1"></i>
                                    Danh mục <span class="text-danger">*</span>
                                </label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <!-- JS sẽ load danh mục -->
                                </select>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-image text-primary me-1"></i>
                                    Ảnh sản phẩm <span class="text-danger">*</span>
                                </label>
                                <div class="upload-area border-2 border-dashed border-primary rounded p-4 text-center">
                                    <input type="file" id="image" name="image" class="form-control d-none" 
                                           accept="image/*" required>
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                        <p class="mb-2">Kéo thả ảnh vào đây hoặc <span class="text-primary fw-bold">chọn file</span></p>
                                        <p class="text-muted small">Chỉ chấp nhận: JPG, PNG, GIF, WEBP (tối đa 2MB)</p>
                                    </div>
                                    <div class="preview-area d-none">
                                        <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                        <p class="mt-2 mb-0 text-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Ảnh đã được chọn
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/webbanhang/Product" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-arrow-left me-1"></i>
                                Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-plus me-1"></i>
                                Thêm sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<style>
.upload-area {
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9ff;
}

.upload-area.dragover {
    border-color: #0d6efd !important;
    background-color: #e3f2fd;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.card {
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.form-label {
    margin-bottom: 0.5rem;
    color: #495057;
}

.text-danger {
    font-size: 0.875em;
}

.form-text {
    font-size: 0.875em;
    color: #6c757d;
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 0 10px;
    }
    
    .card-body {
        padding: 1.5rem !important;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Load danh mục từ API
    fetch('/webbanhang/api/category')
        .then(res => res.json())
        .then(data => {
            const select = document.getElementById('category_id');
            data.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                select.appendChild(option);
            });
        })
        .catch(err => {
            console.error('Lỗi khi tải danh mục:', err);
        });

    // Xử lý upload ảnh
    const uploadArea = document.querySelector('.upload-area');
    const imageInput = document.getElementById('image');
    const uploadContent = document.querySelector('.upload-content');
    const previewArea = document.querySelector('.preview-area');
    const previewImg = document.getElementById('preview-img');

    uploadArea.addEventListener('click', () => {
        imageInput.click();
    });

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImagePreview(files[0]);
        }
    });

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            handleImagePreview(this.files[0]);
        }
    });

    function handleImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            uploadContent.classList.add('d-none');
            previewArea.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }

    // Submit form với validation
    document.getElementById('add-product-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const name = this.name.value.trim();
        const description = this.description.value.trim();
        const price = parseFloat(this.price.value);
        const categoryId = this.category_id.value;
        const imageInput = this.image;
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

        // Validate file ảnh
        if (!imageFile) {
            showAlert('Vui lòng chọn ảnh sản phẩm.', 'warning');
            return;
        }

        // Kiểm tra định dạng ảnh
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(imageFile.type)) {
            showAlert('Chỉ cho phép ảnh định dạng JPEG, PNG, GIF hoặc WEBP.', 'warning');
            return;
        }

        // Kiểm tra kích thước ảnh (tối đa 2MB)
        const maxSizeMB = 2;
        if (imageFile.size > maxSizeMB * 1024 * 1024) {
            showAlert(`Kích thước ảnh không được vượt quá ${maxSizeMB}MB.`, 'warning');
            return;
        }

        // Hiển thị loading
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang xử lý...';
        submitBtn.disabled = true;

        // Lấy token từ localStorage
        const token = localStorage.getItem('jwtToken');

        // Gửi form
        const formData = new FormData(this);

        fetch('/webbanhang/api/product', {
            method: 'POST',
            body: formData,
            headers: {
                'Authorization': token ? `Bearer ${token}` : ''
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Unauthorized or Server Error');
            return res.json();
        })
        .then(data => {
            if (data.message === 'Product created successfully') {
                showAlert('Thêm sản phẩm thành công!', 'success');
                setTimeout(() => {
                    window.location.href = '/webbanhang/Product';
                }, 1500);
            } else {
                showAlert(data.message || 'Đã xảy ra lỗi khi thêm sản phẩm', 'error');
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

    // Hàm hiển thị thông báo
    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>