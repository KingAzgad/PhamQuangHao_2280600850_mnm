<?php include 'app/views/shares/header.php'; ?>

<style>
.product-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.product-image-container {
    width: 100%;
    aspect-ratio: 1; /* Tạo khung vuông */
    overflow: hidden;
    position: relative;
    background: #f8f9fa;
    border-radius: 8px;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
    min-width: 100%;
    min-height: 100%;
}


.product-card:hover .product-image {
    transform: scale(1.05);
}

.price-tag {
    background: linear-gradient(45deg, #ff6b6b, #ee5a24);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.95em;
    display: inline-block;
}

.category-badge {
    background: #6c757d;
    color: white;
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 0.8em;
    font-weight: 500;
}

.btn-custom {
    border-radius: 18px;
    padding: 6px 12px;
    font-weight: 500;
    transition: all 0.3s ease;
    font-size: 0.85em;
}

.btn-cart {
    background: linear-gradient(45deg, #4facfe, #00f2fe);
    border: none;
    color: white;
}

.btn-cart:hover {
    background: linear-gradient(45deg, #00f2fe, #4facfe);
    transform: translateY(-2px);
    color: white;
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px 0;
    margin-bottom: 40px;
}

.loading-spinner {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
}

.admin-buttons {
    display: flex;
    gap: 5px;
    margin-top: 8px;
}

.admin-buttons .btn {
    flex: 1;
    min-width: 70px;
}
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Danh sách sản phẩm</h1>
                <p class="mb-0 opacity-75">Tất cả sản phẩm có sẵn trong cửa hàng</p>
            </div>
            <div class="col-md-4 text-end">
                <?php if (SessionHelper::isAdmin()): ?>
                    <a href="/webbanhang/Product/add" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="loading-spinner" id="loading">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="row" id="product-list" style="display: none;"></div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const loading = document.getElementById('loading');
    const productList = document.getElementById('product-list');
    
    fetch('/webbanhang/api/product')
    .then(response => response.json())
    .then(data => {
        loading.style.display = 'none';
        productList.style.display = 'flex';

        if (!data || data.length === 0) {
            productList.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-info-circle me-2"></i>Không có sản phẩm nào để hiển thị
                    </div>
                </div>`;
            return;
        }

        const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        const isAdmin = <?php echo SessionHelper::isAdmin() ? 'true' : 'false'; ?>;

        data.forEach(product => {
            const col = document.createElement('div');
            col.className = 'col-xl-3 col-lg-4 col-md-6 mb-4';

            col.innerHTML = `
                <div class="card product-card h-100">
                    <div class="card-body p-3">
                        <div class="product-image-container mb-3">
                            <img src="/webbanhang/${product.image || 'assets/no-image.png'}" 
                                 alt="${product.name}" 
                                 class="product-image"
                                 onerror="this.src='/webbanhang/assets/no-image.png'">
                        </div>
                        
                        <div class="mb-2">
                            <span class="category-badge">${product.category_name || 'Không xác định'}</span>
                        </div>
                        
                        <h6 class="card-title mb-2">
                            <a href="/webbanhang/Product/show/${product.id}" 
                               class="text-decoration-none text-dark fw-bold">
                                ${product.name}
                            </a>
                        </h6>
                        
                        <p class="card-text text-muted small mb-3" style="height: 45px; overflow: hidden;">
                            ${product.description.substring(0, 90)}${product.description.length > 90 ? '...' : ''}
                        </p>
                        
                        <div class="mb-3">
                            <span class="price-tag">${product.price.toLocaleString()} VND</span>
                        </div>
                        
                        <div class="d-flex gap-1 flex-wrap">
                            ${isLoggedIn ? `
                                <a href="/webbanhang/Product/addToCart/${product.id}" 
                                   class="btn btn-cart btn-sm btn-custom flex-fill">
                                    <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                </a>
                            ` : ''}
                            
                            <a href="/webbanhang/Product/show/${product.id}" 
                               class="btn btn-outline-info btn-sm btn-custom">
                                <i class="fas fa-eye me-1"></i>Chi tiết
                            </a>
                        </div>
                        
                        ${isAdmin ? `
                            <div class="admin-buttons">
                                <a href="/webbanhang/Product/edit/${product.id}" 
                                   class="btn btn-outline-warning btn-sm btn-custom">
                                    <i class="fas fa-edit me-1"></i>Sửa
                                </a>
                                <button class="btn btn-outline-danger btn-sm btn-custom" 
                                        onclick="deleteProduct(${product.id})">
                                    <i class="fas fa-trash me-1"></i>Xóa
                                </button>
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
            productList.appendChild(col);
        });
    })
    .catch(error => {
        console.error('Error fetching products:', error);
        loading.style.display = 'none';
        productList.style.display = 'block';
        productList.innerHTML = `
            <div class="col-12">
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>Không thể tải danh sách sản phẩm
                </div>
            </div>`;
    });
});

function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        const token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('Vui lòng đăng nhập để xóa sản phẩm');
            location.href = '/webbanhang/account/login';
            return;
        }

        fetch(`/webbanhang/api/product/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product deleted successfully') {
                location.reload();
            } else {
                alert(data.message || 'Xóa sản phẩm thất bại');
            }
        })
        .catch(error => {
            alert('Xóa sản phẩm thất bại');
            console.error('Error deleting product:', error);
        });
    }
}
</script>