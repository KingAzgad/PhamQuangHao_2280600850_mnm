<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .floating {
            animation: floating 8s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-15px) rotate(1deg);
            }
            66% {
                transform: translateY(-10px) rotate(-1deg);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b  30%, #d97706 60%, #b45309 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .input-group:focus-within .input-icon {
            color: #f59e0b;
            transform: scale(1.15);
        }

        .input-icon {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bg-pattern {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #64748b 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .neon-glow {
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3), 0 0 40px rgba(251, 191, 36, 0.2), 0 0 60px rgba(251, 191, 36, 0.1);
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(251, 191, 36, 0.25);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }

        .meteor {
            position: absolute;
            width: 2px;
            height: 2px;
            background: linear-gradient(45deg, #fbbf24, transparent);
            border-radius: 50%;
            animation: meteor 3s linear infinite;
        }

        @keyframes meteor {
            0% {
                transform: translateX(-100px) translateY(-100px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateX(100px) translateY(100px);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-pattern relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Floating Orbs -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating"></div>
        <div class="absolute top-40 right-32 w-24 h-24 bg-orange-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 floating" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 left-1/4 w-40 h-40 bg-amber-400 rounded-full mix-blend-multiply filter blur-xl opacity-25 floating" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-20 right-20 w-28 h-28 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating" style="animation-delay: 6s;"></div>
        
        <!-- Meteors -->
        <div class="meteor" style="top: 10%; left: 10%; animation-delay: 0s;"></div>
        <div class="meteor" style="top: 20%; left: 80%; animation-delay: 1s;"></div>
        <div class="meteor" style="top: 70%; left: 20%; animation-delay: 2s;"></div>
        <div class="meteor" style="top: 80%; left: 70%; animation-delay: 3s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-8 relative z-10">
        <div class="max-w-md w-full space-y-8">
            <!-- Header Section -->
            <div class="text-center">
                <div class="relative mx-auto h-20 w-20 mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 via-orange-500 to-amber-600 rounded-full neon-glow"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 via-orange-500 to-amber-600 rounded-full pulse-ring"></div>
                    <div class="relative h-full w-full bg-gradient-to-br from-yellow-400 via-orange-500 to-amber-600 rounded-full flex items-center justify-center shadow-2xl">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-4xl font-black gradient-text mb-3">
                    Tạo Tài Khoản
                </h2>
                <p class="text-gray-300 text-sm">Tham gia cộng đồng của chúng tôi ngay hôm nay!</p>
            </div>

            <!-- Register Form -->
            <div class="glass-effect rounded-2xl shadow-2xl p-8 space-y-6 card-hover">
                <?php if (isset($error)): ?>
                    <div class="bg-red-500/10 border border-red-500/30 p-4 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                            <p class="text-red-200 text-sm"><?php echo $error; ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                    <div class="bg-green-500/10 border border-green-500/30 p-4 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-3"></i>
                            <p class="text-green-200 text-sm"><?php echo $success; ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="/webbanhang/account/register" method="POST" class="space-y-5">
                    <!-- Full Name Input -->
                    <div class="input-group">
                        <label for="fullname" class="block text-sm font-bold text-gray-200 mb-2">
                            <i class="fas fa-user-circle mr-2 text-yellow-400"></i>Họ và tên
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user-circle input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="text" id="fullname" name="fullname" required
                                class="input-field block w-full pl-12 pr-4 py-3.5 rounded-xl focus:outline-none transition-all duration-300 text-white placeholder-gray-400 text-sm"
                                placeholder="Nhập họ và tên của bạn">
                        </div>
                    </div>

                    <!-- Username Input -->
                    <div class="input-group">
                        <label for="username" class="block text-sm font-bold text-gray-200 mb-2">
                            <i class="fas fa-at mr-2 text-yellow-400"></i>Tên đăng nhập
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="text" id="username" name="username" required
                                class="input-field block w-full pl-12 pr-4 py-3.5 rounded-xl focus:outline-none transition-all duration-300 text-white placeholder-gray-400 text-sm"
                                placeholder="Chọn tên đăng nhập">
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="input-group">
                        <label for="email" class="block text-sm font-bold text-gray-200 mb-2">
                            <i class="fas fa-envelope mr-2 text-yellow-400"></i>Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="email" id="email" name="email" required
                                class="input-field block w-full pl-12 pr-4 py-3.5 rounded-xl focus:outline-none transition-all duration-300 text-white placeholder-gray-400 text-sm"
                                placeholder="Nhập địa chỉ email">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="input-group">
                        <label for="password" class="block text-sm font-bold text-gray-200 mb-2">
                            <i class="fas fa-lock mr-2 text-yellow-400"></i>Mật khẩu
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="input-field block w-full pl-12 pr-12 py-3.5 rounded-xl focus:outline-none transition-all duration-300 text-white placeholder-gray-400 text-sm"
                                placeholder="Tạo mật khẩu mạnh">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-yellow-400 transition-colors">
                                    <i class="fas fa-eye text-lg" id="toggleIcon1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="input-group">
                        <label for="confirm_password" class="block text-sm font-bold text-gray-200 mb-2">
                            <i class="fas fa-shield-alt mr-2 text-yellow-400"></i>Xác nhận mật khẩu
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-shield-alt input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="password" id="confirm_password" name="confirm_password" required
                                class="input-field block w-full pl-12 pr-12 py-3.5 rounded-xl focus:outline-none transition-all duration-300 text-white placeholder-gray-400 text-sm"
                                placeholder="Nhập lại mật khẩu">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <button type="button" onclick="togglePassword('confirm_password')" class="text-gray-400 hover:text-yellow-400 transition-colors">
                                    <i class="fas fa-eye text-lg" id="toggleIcon2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="group relative w-full flex justify-center py-4 px-6 border border-transparent text-base font-bold rounded-xl text-gray-900 bg-gradient-to-r from-yellow-400 via-orange-500 to-amber-500 hover:from-yellow-500 hover:via-orange-600 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl neon-glow">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                            <i class="fas fa-rocket group-hover:translate-x-1 transition-transform text-lg"></i>
                        </span>
                        Bắt Đầu Ngay!
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-slate-800 text-gray-400 rounded-full text-xs font-medium">hoặc</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="text-center space-y-3">
                    <div class="text-gray-300">
                        Đã có tài khoản? 
                        <a href="/webbanhang/account/login" class="text-yellow-400 hover:text-yellow-300 transition-colors hover:underline font-semibold">
                            Đăng nhập ngay!
                        </a>
                    </div>
                    <a href="/webbanhang/Product" class="inline-flex items-center text-gray-400 hover:text-yellow-400 transition-colors group text-sm font-medium">
                        <i class="fas fa-home mr-2 group-hover:-translate-x-1 transition-transform"></i>
                        Quay lại trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = fieldId === 'password' ? document.getElementById('toggleIcon1') : document.getElementById('toggleIcon2');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (password !== confirmPassword) {
                this.setCustomValidity('Mật khẩu không khớp');
                this.style.borderColor = '#ef4444';
                this.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            } else {
                this.setCustomValidity('');
                this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                this.style.boxShadow = 'none';
            }
        });

        // Enhanced focus effects
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"], input[type="email"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('transform', 'scale-102');
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('transform', 'scale-102');
            });
        });

        // Add entrance animation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.glass-effect');
            form.style.opacity = '0';
            form.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                form.style.opacity = '1';
                form.style.transform = 'translateY(0)';
                form.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            }, 100);
        });

        // Add particle effect on button click
        document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('absolute', 'rounded-full', 'bg-white', 'opacity-30', 'animate-ping', 'pointer-events-none');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    </script>
</body>

</html>