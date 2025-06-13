<?php include 'app/views/shares/header.php'; ?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form id="login-form" novalidate>
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="username" class="form-control form-control-lg" required />
                                    <label class="form-label">Username</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label">Password</label>
                                </div>

                                <p class="small mb-3 pb-lg-2">
                                    <a class="text-white-50" href="#!">Forgot password?</a>
                                </p>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>

                                <p class="text-danger error-message mt-3"></p>
                            </div>

                            <div>
                                <p class="mb-0">
                                    Don't have an account? <a href="/webbanhang/account/register" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>

<script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const usernameInput = this.username;
        const passwordInput = this.password;
        const errorEl = document.querySelector('.error-message');
        errorEl.innerText = '';

        const username = usernameInput.value.trim();
        const password = passwordInput.value;

        if (!username) {
            errorEl.innerText = "Username không được để trống";
            usernameInput.focus();
            return;
        }

        if (!password) {
            errorEl.innerText = "Password không được để trống";
            passwordInput.focus();
            return;
        }

        const jsonData = {
            username: username,
            password: password
        };

        fetch('/webbanhang/account/apiLogin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            })
            .then(res => res.json())
            .then(data => {
                if (data.token) {
                    localStorage.setItem('jwtToken', data.token);

                    const payload = JSON.parse(atob(data.token.split('.')[1]));

                    // ✅ Truy cập đúng vào bên trong "data"
                    const userData = payload.data;

                    if (!userData || !userData.id || !userData.username || !userData.role) {
                        throw new Error("Token không hợp lệ hoặc thiếu dữ liệu");
                    }

                    return fetch('/webbanhang/account/saveSessionFromToken', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            id: userData.id,
                            username: userData.username,
                            role: userData.role
                        })
                    });
                } else {
                    throw new Error(data.message || "Đăng nhập thất bại");
                }
            })
            .then(() => {
                // Thành công -> chuyển hướng
                location.href = '/webbanhang/product';
            })
            .catch(err => {
                errorEl.innerText = err.message || "Lỗi kết nối tới server";
            });
    });
</script>