<?php include 'app/views/shares/header.php'; ?>

<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px 0;
    margin-bottom: 40px;
}

.product-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.product-image-container {
    width: 100%;
    height: 200px;
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
}

.product-card:hover .product-image {
    transform: scale(1.08);
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
    border-radius: 20px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
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

.stats-section {
    background: #f8f9fa;
    padding: 50px 0;
    margin: 40px 0;
}

.stat-card {
    text-align: center;
    padding: 25px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    background: linear-gradient(45deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.loading-spinner {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
}

.floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: linear-gradient(45deg, #ff6b6b, #ee5a24);
    border: none;
    color: white;
    font-size: 1.3rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    z-index: 1000;
}

.floating-btn:hover {
    transform: scale(1.1);
    color: white;
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">Chào mừng đến với cửa hàng của chúng tôi</h1>
                <p class="lead mb-4">Khám phá những sản phẩm chất lượng cao với giá cả hợp lý</p>
                <a href="#products" class="btn btn-light btn-lg btn-custom me-3">🛍️ Xem sản phẩm</a>
                <a href="/webbanhang/Product/list" class="btn btn-outline-light btn-lg btn-custom">📋 Tất cả sản phẩm</a>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fas fa-shopping-bag" style="font-size: 8rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-number" id="total-products">0</div>
                    <h6 class="mt-2 text-muted">Sản phẩm</h6>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-number">100+</div>
                    <h6 class="mt-2 text-muted">Khách hàng</h6>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <h6 class="mt-2 text-muted">Hỗ trợ</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Section -->
<div class="container" id="products">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Sản phẩm nổi bật</h2>
        <div class="mx-auto mt-2" style="width: 60px; height: 3px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 2px;"></div>
    </div>
    
    <div class="loading-spinner" id="loading">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <div class="row" id="product-list" style="display: none;"></div>

    <div class="text-center mt-5">
        <a href="/webbanhang/Product/list" class="btn btn-primary btn-lg btn-custom">
            <i class="fas fa-arrow-right me-2"></i>Xem tất cả sản phẩm
        </a>
    </div>
</div>

<!-- Admin Controls -->
<?php if (SessionHelper::isAdmin()): ?>
<a href="/webbanhang/Product/add" class="floating-btn" title="Thêm sản phẩm mới">
    <i class="fas fa-plus"></i>
</a>
<?php endif; ?>

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
        
        document.getElementById('total-products').textContent = data.length;
        
        if (!data || data.length === 0) {
            productList.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>Chưa có sản phẩm nào
                    </div>
                </div>`;
            return;
        }

        const featuredProducts = data.slice(0, 6);
        
        featuredProducts.forEach(product => {
            const col = document.createElement('div');
            col.className = 'col-lg-4 col-md-6 mb-4';

            const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
            const isAdmin = <?php echo SessionHelper::isAdmin() ? 'true' : 'false'; ?>;

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
                        
                        <p class="card-text text-muted small mb-3" style="height: 40px; overflow: hidden;">
                            ${product.description.substring(0, 80)}${product.description.length > 80 ? '...' : ''}
                        </p>
                        
                        <div class="mb-3">
                            <span class="price-tag">${product.price.toLocaleString()} VND</span>
                        </div>
                        
                        <div class="d-flex gap-1 flex-wrap">
                            ${isLoggedIn ? `
                                <a href="/webbanhang/Product/addToCart/${product.id}" 
                                   class="btn btn-cart btn-sm btn-custom flex-fill">
                                    <i class="fas fa-cart-plus"></i> Giỏ hàng
                                </a>
                            ` : ''}
                            
                            <a href="/webbanhang/Product/show/${product.id}" 
                               class="btn btn-outline-info btn-sm btn-custom">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            
                            ${isAdmin ? `
                                <a href="/webbanhang/Product/edit/${product.id}" 
                                   class="btn btn-outline-warning btn-sm btn-custom">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-outline-danger btn-sm btn-custom" 
                                        onclick="deleteProduct(${product.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
            productList.appendChild(col);
        });
    })
    .catch(error => {
        console.error('Error:', error);
        loading.style.display = 'none';
        productList.style.display = 'block';
        productList.innerHTML = `
            <div class="col-12">
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>Không thể tải sản phẩm
                </div>
            </div>`;
    });
});

function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        const token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('Vui lòng đăng nhập');
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
                alert(data.message || 'Xóa thất bại');
            }
        })
        .catch(error => {
            alert('Xóa thất bại');
            console.error('Error:', error);
        });
    }
}

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>