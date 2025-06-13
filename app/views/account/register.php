<?php include 'app/views/shares/header.php'; ?>

<?php
if (isset($errors) && count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $err) {
        echo "<li class='text-danger'>" . htmlspecialchars($err) . "</li>";
    }
    echo "</ul>";
}
?>

<div class="card-body p-5 text-center">
    <form id="register-form" class="user" action="/webbanhang/account/save" method="post" novalidate>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input
                    type="text"
                    class="form-control form-control-user"
                    id="username"
                    name="username"
                    placeholder="username"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    required
                >
            </div>
            <div class="col-sm-6">
                <input
                    type="text"
                    class="form-control form-control-user"
                    id="fullname"
                    name="fullname"
                    placeholder="fullname"
                    value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>"
                    required
                >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input
                    type="password"
                    class="form-control form-control-user"
                    id="password"
                    name="password"
                    placeholder="password"
                    required
                >
            </div>
            <div class="col-sm-6">
                <input
                    type="password"
                    class="form-control form-control-user"
                    id="confirmpassword"
                    name="confirmpassword"
                    placeholder="confirmpassword"
                    required
                >
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-icon-split p-3">
                Register
            </button>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('register-form');

    form.addEventListener('submit', function (e) {
        // Xóa lỗi client cũ
        const oldErrors = form.querySelectorAll('.client-error');
        oldErrors.forEach(el => el.remove());

        let hasError = false;

        const username = form.username.value.trim();
        const fullname = form.fullname.value.trim();
        const password = form.password.value;
        const confirmpassword = form.confirmpassword.value;

        function showError(inputElem, message) {
            const small = document.createElement('small');
            small.classList.add('text-danger', 'client-error');
            small.textContent = message;
            inputElem.parentNode.appendChild(small);
        }

        // Kiểm tra username
        if (username.length < 3) {
            showError(form.username, 'Username phải có ít nhất 3 ký tự.');
            hasError = true;
        }

        // Kiểm tra fullname
        if (fullname.length === 0) {
            showError(form.fullname, 'Fullname không được để trống.');
            hasError = true;
        }

        // Kiểm tra password
        if (password.length < 6) {
            showError(form.password, 'Password phải có ít nhất 6 ký tự.');
            hasError = true;
        }

        // Kiểm tra confirmpassword
        if (confirmpassword !== password) {
            showError(form.confirmpassword, 'Confirm password không khớp.');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
            // Tự động focus trường lỗi đầu tiên
            const firstErrorInput = form.querySelector('.client-error').previousElementSibling;
            if (firstErrorInput) firstErrorInput.focus();
        }
    });
});
</script>
