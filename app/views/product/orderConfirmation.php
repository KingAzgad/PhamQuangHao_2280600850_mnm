<?php include 'app/views/shares/header.php'; ?>

<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-3">
            <!-- Biểu tượng xác nhận, dùng icon SVG -->
            <svg width="64" height="64" fill="none" viewBox="0 0 64 64">
                <circle cx="32" cy="32" r="32" fill="#e6ffed"/>
                <path d="M20 33l8 8 16-16" stroke="#52c41a" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h2 class="text-success text-center mb-2" style="font-weight: bold; font-size: 1.5rem;">Đặt hàng thành công!</h2>
        <p class="text-center mb-3" style="font-size: 1.1rem;">Đơn hàng của bạn đã được xác nhận.<br>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
        <a href="/webbanhang/Product/" class="btn btn-success btn-block mt-2">Quay lại danh sách sản phẩm</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
