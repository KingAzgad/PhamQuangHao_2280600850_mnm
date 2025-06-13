<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4 mb-5">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="display-6 fw-bold text-dark mb-2">
                        <i class="fas fa-shopping-cart text-primary me-3"></i>Giỏ hàng của bạn
                    </h1>
                    <p class="text-muted mb-0">Quản lý các sản phẩm trong giỏ hàng</p>
                </div>
                <?php if (!empty($cart)): ?>
                    <div class="text-end">
                        <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
                            <?= count($cart) ?> sản phẩm
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($cart)): ?>
        <!-- Cart Items -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-0">
                <?php 
                $total = 0;
                $itemCount = 0;
                foreach ($cart as $id => $item): 
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                    $itemCount++;
                ?>
                    <div class="cart-item p-4 <?= $itemCount < count($cart) ? 'border-bottom' : '' ?>">
                        <div class="row align-items-center">
                            <!-- Product Image -->
                            <div class="col-lg-2 col-md-3 col-4 mb-3 mb-md-0">
                                <div class="position-relative">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="/webbanhang/<?= htmlspecialchars($item['image']) ?>" 
                                             alt="<?= htmlspecialchars($item['name']) ?>" 
                                             class="img-fluid rounded-3 shadow-sm w-100"
                                             style="height: 100px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" 
                                             style="height: 100px;">
                                            <i class="fas fa-image text-muted fs-2"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="col-lg-6 col-md-5 col-8 mb-3 mb-lg-0">
                                <h5 class="fw-bold text-dark mb-2">
                                    <?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>
                                </h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-tag text-success me-2"></i>
                                            <span class="text-muted me-2">Đơn giá:</span>
                                            <strong class="text-success">
                                                <?= number_format($item['price'], 0, ',', '.') ?> VND
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-cubes text-info me-2"></i>
                                            <span class="text-muted me-2">Số lượng:</span>
                                            <span class="badge bg-info text-dark px-3 py-1 rounded-pill">
                                                <?= $item['quantity'] ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Item Total & Actions -->
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="text-lg-end text-md-end">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Thành tiền:</span>
                                        <h5 class="fw-bold text-primary mb-0">
                                            <?= number_format($itemTotal, 0, ',', '.') ?> VND
                                        </h5>
                                    </div>
                                    
                                    <form method="post" action="/webbanhang/Product/remove" 
                                          onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');"
                                          class="d-inline">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-2 rounded-pill">
                                            <i class="fas fa-trash-alt me-1"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Cart Summary -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="fw-bold text-dark mb-2">
                            <i class="fas fa-calculator text-success me-2"></i>Tổng cộng
                        </h4>
                        <p class="text-muted mb-0">
                            Tổng số tiền cho <?= count($cart) ?> sản phẩm trong giỏ hàng
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                        <h2 class="fw-bold text-success mb-0">
                            <?= number_format($total, 0, ',', '.') ?> VND
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        
    <?php else: ?>
        <!-- Empty Cart -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-shopping-cart text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                </div>
                <h3 class="text-muted mb-3">Giỏ hàng trống</h3>
                <p class="text-secondary mb-4 fs-5">
                    Bạn chưa có sản phẩm nào trong giỏ hàng.<br>
                    Hãy khám phá và thêm sản phẩm yêu thích vào giỏ hàng!
                </p>
                <a href="/webbanhang/Product" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">
                    <i class="fas fa-shopping-bag me-2"></i>Mua sắm ngay
                </a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-between">
        <a href="/webbanhang/Product" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
        </a>
        
        <?php if (!empty($cart)): ?>
            <a href="/webbanhang/Product/checkout" class="btn btn-success btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-credit-card me-2"></i>Tiến hành thanh toán
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Custom Styles -->
<style>
.cart-item {
    transition: all 0.3s ease;
}

.cart-item:hover {
    background-color: #f8f9fa;
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
}

.btn-success {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #1e7e34, #155724);
}

.badge {
    font-weight: 500;
}

@media (max-width: 768px) {
    .display-6 {
        font-size: 2rem;
    }
    
    .cart-item .row > div {
        margin-bottom: 1rem;
    }
    
    .cart-item .row > div:last-child {
        margin-bottom: 0;
    }
}

/* Animation for page load */
.cart-item {
    animation: fadeInUp 0.6s ease-out;
}

.cart-item:nth-child(2) { animation-delay: 0.1s; }
.cart-item:nth-child(3) { animation-delay: 0.2s; }
.cart-item:nth-child(4) { animation-delay: 0.3s; }

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

<?php include 'app/views/shares/footer.php'; ?>