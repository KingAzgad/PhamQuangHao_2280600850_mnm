<?php include 'app/views/shares/header.php'; ?>

<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-3">
            <!-- Icon thanh toán SVG -->
            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                <circle cx="28" cy="28" r="28" fill="#e6f7ff" />
                <path d="M19 29.5L25 35.5L37 23.5" stroke="#1890ff" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h2 class="text-center mb-3" style="font-weight: bold;">Thanh toán</h2>
        <form id="checkoutForm" method="POST" action="/webbanhang/Product/processCheckout" novalidate>
            <p class="text-muted mb-4">Vui lòng điền thông tin giao hàng của bạn</p>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
            <div class="form-group mb-3">
                <label for="name" class="fw-semibold">Họ và tên</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ tên của bạn" required>
                <div class="error text-danger mt-1" id="nameError"></div>
            </div>
            <div class="form-group mb-3">
                <label for="phone" class="fw-semibold">Số điện thoại</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                <div class="error text-danger mt-1" id="phoneError"></div>
            </div>
            <div class="form-group mb-3">
                <label for="address" class="fw-semibold">Địa chỉ</label>
                <textarea id="address" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" required></textarea>
                <div class="error text-danger mt-1" id="addressError"></div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mt-2" style="font-size: 1.1rem;">
                Thanh toán
            </button>
        </form>
        <a href="/webbanhang/Product/cart" class="btn btn-outline-secondary w-100 mt-3">Quay lại giỏ hàng</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- Script bắt lỗi phía client -->
<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        let hasError = false;

        // Lấy giá trị các trường
        let name = document.getElementById('name').value.trim();
        let phone = document.getElementById('phone').value.trim();
        let address = document.getElementById('address').value.trim();

        // Regex kiểm tra số điện thoại Việt Nam (10-11 số, bắt đầu bằng 0)
        let phonePattern = /^(0\d{9})$/;

        // Xóa thông báo lỗi cũ
        document.getElementById('nameError').innerText = '';
        document.getElementById('phoneError').innerText = '';
        document.getElementById('addressError').innerText = '';

        // Kiểm tra họ tên
        if (name === '') {
            document.getElementById('nameError').innerText = 'Vui lòng nhập họ và tên';
            hasError = true;
        }

        // Kiểm tra số điện thoại
        if (phone === '') {
            document.getElementById('phoneError').innerText = 'Vui lòng nhập số điện thoại';
            hasError = true;
        } else if (!phonePattern.test(phone)) {
            document.getElementById('phoneError').innerText = 'Số điện thoại không hợp lệ';
            hasError = true;
        }

        // Kiểm tra địa chỉ
        if (address === '') {
            document.getElementById('addressError').innerText = 'Vui lòng nhập địa chỉ';
            hasError = true;
        }

        // Nếu có lỗi thì không submit form
        if (hasError) event.preventDefault();
    });
</script>

<style>
    .error {
        font-size: 0.98em;
    }

    input.form-control,
    textarea.form-control {
        border-radius: 0.5rem;
        font-size: 1.03rem;
    }

    label.fw-semibold {
        font-weight: 600;
    }

    .card {
        border-radius: 1.2rem;
    }
</style>