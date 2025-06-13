<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phạm Quang Hào</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--primary-gradient);
            min-height: 100vh;
        }

        /* Custom Navbar Styles */
        .custom-navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .custom-navbar .navbar-brand {
            font-size: 1.75rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .custom-navbar .navbar-brand i {
            color: var(--primary-color);
            -webkit-text-fill-color: var(--primary-color);
        }

        .custom-navbar .navbar-nav {
            align-items: center;
            gap: 0.5rem;
        }

        .custom-navbar .nav-link {
            color: #4a5568 !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            position: relative;
        }

        .custom-navbar .nav-link:hover {
            background: rgba(102, 126, 234, 0.1) !important;
            color: var(--primary-color) !important;
            transform: translateY(-1px);
        }

        .custom-navbar .nav-link.active {
            background: var(--primary-gradient) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .custom-user-info {
            background: var(--primary-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            margin-right: 0.5rem;
        }

        .custom-user-role {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .custom-dropdown-toggle::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
            border: none;
            vertical-align: middle;
        }

        .custom-dropdown.show .custom-dropdown-toggle::after {
            transform: rotate(180deg);
        }

        .custom-dropdown-menu {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 0.5rem;
        }

        .custom-dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .custom-dropdown-item:hover {
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary-color);
        }

        .custom-dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.1);
            margin: 0.5rem 0;
        }

        .custom-btn-login {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .custom-btn-login:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .custom-btn-logout {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .custom-btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            color: white;
        }

        .custom-notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Đảm bảo container main không bị conflict */
        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .welcome-title {
            color: white;
            text-align: center;
            margin: 2rem 0;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .custom-navbar .navbar-nav {
                gap: 0.2rem;
            }
            
            .custom-navbar .nav-link {
                padding: 0.5rem 0.8rem !important;
                font-size: 0.85rem;
            }
            
            .custom-user-info {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="/webbanhang/Product/">
                <i class="fas fa-store" ></i>
                Phạm Quang Hào_2280600850
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Public Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/cart">
                            <i class="fas fa-shopping-cart"></i>
                            Giỏ hàng
                            <span class="custom-notification-badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Orders/userOrders">
                            <i class="fas fa-history"></i>
                            Lịch sử
                        </a>
                    </li>

                    <!-- Admin Links -->
                    <li class="nav-item dropdown custom-dropdown admin-only" style="display: none;">
                        <a class="nav-link dropdown-toggle custom-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            Quản lý
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu">
                            <li><a class="dropdown-item custom-dropdown-item" href="/webbanhang/Product/">
                                <i class="fas fa-box"></i>
                                Danh sách sản phẩm
                            </a></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="/webbanhang/Category/">
                                <i class="fas fa-tags"></i>
                                Danh sách danh mục
                            </a></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="/webbanhang/Orders/">
                                <i class="fas fa-clipboard-list"></i>
                                Danh sách đơn hàng
                            </a></li>
                            <li><hr class="custom-dropdown-divider"></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="/webbanhang/Product/add">
                                <i class="fas fa-plus-circle"></i>
                                Thêm sản phẩm
                            </a></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="/webbanhang/Account/list">
                                <i class="fas fa-users"></i>
                                Danh sách người dùng
                            </a></li>
                        </ul>
                    </li>

                    <!-- User Authentication -->
                    <li class="nav-item user-logged-in" style="display: none;">
                        <div class="custom-user-info">
                            <i class="fas fa-user-circle"></i>
                            <span id="username">Admin User</span>
                            <span class="custom-user-role" id="userRole">admin</span>
                        </div>
                    </li>
                    
                    <li class="nav-item user-logged-in" style="display: none;">
                        <button class="btn custom-btn-logout" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i>
                            Đăng xuất
                        </button>
                    </li>
                    
                    <li class="nav-item user-not-logged-in">
                        <a class="custom-btn-login" href="/webbanhang/account/login">
                            <i class="fas fa-sign-in-alt"></i>
                            Đăng nhập
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Simulate user session (replace with your actual session logic)
        const isLoggedIn = true; // This should come from your PHP session
        const userRole = 'admin'; // This should come from your PHP session
        const username = 'Nguyễn Văn A'; // This should come from your PHP session

        function initializeUI() {
            const userLoggedInElements = document.querySelectorAll('.user-logged-in');
            const userNotLoggedInElements = document.querySelectorAll('.user-not-logged-in');
            const adminOnlyElements = document.querySelectorAll('.admin-only');
            
            if (isLoggedIn) {
                userLoggedInElements.forEach(el => el.style.display = 'block');
                userNotLoggedInElements.forEach(el => el.style.display = 'none');
                
                // Update user info
                document.getElementById('username').textContent = username;
                document.getElementById('userRole').textContent = userRole;
                
                // Show admin elements if user is admin
                if (userRole === 'admin') {
                    adminOnlyElements.forEach(el => el.style.display = 'block');
                }
            } else {
                userLoggedInElements.forEach(el => el.style.display = 'none');
                userNotLoggedInElements.forEach(el => el.style.display = 'block');
                adminOnlyElements.forEach(el => el.style.display = 'none');
            }
        }

        function logout() {
            localStorage.removeItem('jwtToken');
            location.href = '/webbanhang/account/login';
        }

        // Initialize UI on page load
        document.addEventListener("DOMContentLoaded", function() {
            initializeUI();
            
            // JWT token handling (if you're using JWT)
            const token = localStorage.getItem('jwtToken');
            if (token) {
                try {
                    const payloadBase64 = token.split('.')[1];
                    const decodedPayload = JSON.parse(atob(payloadBase64));
                    
                    const username = decodedPayload.data?.username || 'Người dùng';
                    const role = decodedPayload.data?.role || 'guest';
                    
                    document.getElementById('username').textContent = username;
                    document.getElementById('userRole').textContent = role;
                    
                    // Show appropriate elements based on token
                    if (role === 'admin') {
                        document.querySelectorAll('.admin-only').forEach(el => {
                            el.style.display = 'block';
                        });
                    }
                } catch (e) {
                    console.error('Lỗi giải mã token:', e);
                }
            }
        });
    </script>
</body>
</html>