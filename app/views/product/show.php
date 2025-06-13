<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4 mb-5">
    <?php if (isset($product)) : ?>
        <!-- Product Details Card -->
        <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Product Image Section -->
                    <div class="col-lg-6 col-md-6">
                        <div class="p-4 h-100 d-flex align-items-center justify-content-center bg-light">
                            <?php if (!empty($product->image)) : ?>
                                <img src="/webbanhang/<?php echo $product->image; ?>" 
                                     alt="<?php echo $product->name; ?>" 
                                     class="img-fluid rounded-3 shadow-sm w-100" 
                                     style="max-height: 400px; object-fit: cover;">
                            <?php else : ?>
                                <img src="/webbanhang/assets/no-image.png" 
                                     alt="No image" 
                                     class="img-fluid rounded-3 shadow-sm w-100" 
                                     style="max-height: 400px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Product Info Section -->
                    <div class="col-lg-6 col-md-6">
                        <div class="p-4 p-lg-5 h-100 d-flex flex-column">
                            <!-- Product Name -->
                            <h1 class="display-6 fw-bold text-dark mb-3">
                                <?php echo htmlspecialchars($product->name); ?>
                            </h1>
                            
                            <!-- Product Description -->
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">
                                    <i class="fas fa-info-circle me-2"></i>Mô tả sản phẩm
                                </h5>
                                <p class="text-secondary lh-lg">
                                    <?php echo nl2br(htmlspecialchars($product->description)); ?>
                                </p>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="bg-light rounded-3 p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-tag text-success me-2"></i>
                                                    <span class="fw-semibold text-muted">Giá:</span>
                                                </div>
                                                <h4 class="text-success fw-bold mb-0">
                                                    <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-folder text-primary me-2"></i>
                                                    <span class="fw-semibold text-muted">Danh mục:</span>
                                                </div>
                                                <span class="badge bg-primary fs-6 py-2 px-3">
                                                    <?php echo htmlspecialchars($product->category_name ?? 'Không xác định'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-auto">
                                <div class="d-flex flex-wrap gap-2">
                                    <?php if (SessionHelper::isAdmin()) : ?>
                                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                                           class="btn btn-warning text-white px-4 py-2 rounded-pill">
                                            <i class="fas fa-edit me-2"></i>Sửa sản phẩm
                                        </a>
                                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" 
                                           class="btn btn-danger px-4 py-2 rounded-pill delete-btn">
                                            <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                                        </a>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                                       class="btn btn-primary btn-lg px-4 py-3 rounded-pill flex-grow-1">
                                        <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                                    </a>
                                    <a href="/webbanhang/Product" 
                                       class="btn btn-outline-secondary px-4 py-3 rounded-pill">
                                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php else : ?>
        <!-- Error Message -->
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                </div>
                <h3 class="text-muted mb-3">Không tìm thấy sản phẩm</h3>
                <p class="text-secondary mb-4">Sản phẩm bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                <a href="/webbanhang/Product" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách sản phẩm
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Custom Styles -->
<style>
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

.display-6 {
    font-size: 2.5rem;
    line-height: 1.2;
}

@media (max-width: 768px) {
    .display-6 {
        font-size: 2rem;
    }
    
    .card-body .p-lg-5 {
        padding: 2rem !important;
    }
}
</style>

<?php include 'app/views/shares/footer.php'; ?>