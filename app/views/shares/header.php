<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phạm Quang Hào</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Custom gradient background */
        .nav-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Glass morphism effect */
        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Custom dropdown styles with enhanced animation */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-15px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        
        /* Enhanced button hover effects */
        .nav-button {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .nav-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .nav-button:hover::before {
            left: 100%;
        }
        
        /* Cart badge animation */
        .cart-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        /* Mobile menu styles */
        @media (max-width: 1023px) {
            .mobile-menu {
                display: none;
            }
            .mobile-menu.active {
                display: block;
            }
        }
        
        /* Logo animation */
        .logo-text {
            background: linear-gradient(45deg, #fff, #ffd700, #fff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    <nav class="nav-gradient shadow-2xl relative">
        <!-- Decorative elements -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent"></div>
        
        <div class="container mx-auto px-4 py-4 relative z-10">
            <div class="flex flex-wrap items-center justify-between">
                <!-- Logo with enhanced styling -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center shadow-lg">
                        <i class="fas fa-store text-white text-lg"></i>
                    </div>
                    <a class="logo-text text-2xl font-bold hover:scale-105 transition-transform duration-300" href="/webbanhang/Product">
                    Phạm Quang Hào
                    </a>
                </div>

                <!-- Mobile menu button with animation -->
                <button class="lg:hidden text-white hover:text-yellow-300 focus:outline-none transform hover:scale-110 transition-all duration-200" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="w-full lg:flex lg:items-center lg:w-auto mobile-menu" id="navbarNav">
                    <ul class="lg:flex items-center justify-between text-base text-gray-100 pt-4 lg:pt-0 space-y-2 lg:space-y-0 lg:space-x-2">
                        <?php if (SessionHelper::isLoggedIn()): ?>
                            <li>
                                <a class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300" href="/webbanhang/Product/">
                                    <i class="fas fa-list mr-2 text-blue-200"></i>
                                    <span>Danh sách sản phẩm</span>
                                </a>
                            </li>
                            <?php if (SessionHelper::isAdmin()): ?>
                            <li>
                                <a class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300" href="/webbanhang/Category/">
                                    <i class="fas fa-folder mr-2 text-green-200"></i>
                                    <span>Quản lý Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300" href="/webbanhang/User/">
                                    <i class="fas fa-users mr-2 text-purple-200"></i>
                                    <span>Quản lý Người dùng</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300 relative" href="/webbanhang/Product/cart">
                                    <i class="fas fa-shopping-cart mr-2 text-yellow-200"></i>
                                    <span>Giỏ hàng</span>
                                    <?php
                                    $cart_item_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                                    if ($cart_item_count > 0): ?>
                                        <span class="cart-badge absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gradient-to-r from-red-500 to-pink-500 rounded-full shadow-lg">
                                            <?php echo $cart_item_count; ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="relative dropdown">
                                <button class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-white/30" onclick="toggleDropdown(event)">
                                    <div class="w-8 h-8 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center mr-2">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <span class="font-medium"><?php echo $_SESSION['username']; ?></span>
                                    <i class="fas fa-chevron-down ml-2 transform transition-transform duration-200" id="dropdownIcon"></i>
                                </button>
                                <!-- Enhanced dropdown menu -->
                                <div class="dropdown-menu absolute right-0 mt-3 w-56 bg-white/95 rounded-xl shadow-2xl border border-white/20 z-50" id="dropdownMenu">
                                    <div class="py-2">
                                        <div class="px-4 py-3 border-b border-gray-100">
                                            <p class="text-sm font-medium text-gray-900">Xin chào,</p>
                                            <p class="text-sm text-gray-600 truncate"><?php echo $_SESSION['username']; ?></p>
                                        </div>
                                        <a href="/webbanhang/account/profile" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200">
                                            <i class="fas fa-user mr-3 text-blue-500 w-4"></i>
                                            <span>Thông tin cá nhân</span>
                                        </a>
                                        <a href="/webbanhang/account/settings" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200">
                                            <i class="fas fa-cog mr-3 text-green-500 w-4"></i>
                                            <span>Cài đặt</span>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <a href="/webbanhang/account/logout" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                                            <i class="fas fa-sign-out-alt mr-3 text-red-500 w-4"></i>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php else: ?>
                            <li>
                                <a class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300" href="/webbanhang/account/login">
                                    <i class="fas fa-sign-in-alt mr-2 text-green-200"></i>
                                    <span>Đăng nhập</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-button flex items-center px-4 py-2 lg:px-3 lg:py-2 rounded-lg hover:bg-white/20 hover:text-white hover:shadow-lg transition-all duration-300" href="/webbanhang/account/register">
                                    <i class="fas fa-user-plus mr-2 text-blue-200"></i>
                                    <span>Đăng ký</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Enhanced mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('navbarNav');
            const button = document.querySelector('[onclick="toggleMobileMenu()"]');
            const icon = button.querySelector('i');
            
            mobileMenu.classList.toggle('active');
            
            if (mobileMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
                button.style.transform = 'rotate(180deg)';
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
                button.style.transform = 'rotate(0deg)';
            }
        }

        // Enhanced dropdown functionality
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdownMenu = document.getElementById('dropdownMenu');
            const dropdownIcon = document.getElementById('dropdownIcon');
            
            if (dropdownMenu.classList.contains('opacity-0')) {
                // Show dropdown with enhanced animation
                dropdownMenu.classList.remove('opacity-0', 'invisible', '-translate-y-2', 'scale-95');
                dropdownMenu.classList.add('opacity-100', 'visible', 'translate-y-0', 'scale-100');
                dropdownIcon.classList.add('rotate-180');
            } else {
                // Hide dropdown
                dropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2', 'scale-95');
                dropdownMenu.classList.remove('opacity-100', 'visible', 'translate-y-0', 'scale-100');
                dropdownIcon.classList.remove('rotate-180');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const dropdownIcon = document.getElementById('dropdownIcon');
            
            if (dropdown && !dropdown.contains(event.target)) {
                dropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2', 'scale-95');
                dropdownMenu.classList.remove('opacity-100', 'visible', 'translate-y-0', 'scale-100');
                dropdownIcon.classList.remove('rotate-180');
            }
        });

        // Initialize dropdown state
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu) {
                dropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2', 'scale-95');
            }
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>