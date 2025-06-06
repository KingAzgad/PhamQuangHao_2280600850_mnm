<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating {
            animation: floating 8s ease-in-out infinite;
        }
        
        .floating-delayed {
            animation: floating 10s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        .floating-slow {
            animation: floating 12s ease-in-out infinite;
            animation-delay: 4s;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-15px) rotate(3deg); }
            50% { transform: translateY(-25px) rotate(0deg); }
            75% { transform: translateY(-10px) rotate(-3deg); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #10b981 0%, #059669 25%, #0891b2 50%, #0e7490 75%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 200%;
            animation: gradientShift 4s ease-in-out infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .input-group:focus-within .input-icon {
            color: #10b981;
            transform: scale(1.15);
        }
        
        .input-icon {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .bg-pattern {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 25%, #0f766e 50%, #0891b2 75%, #1e40af 100%);
            background-size: 400% 400%;
            animation: gradientBg 15s ease infinite;
        }
        
        @keyframes gradientBg {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        
        .btn-shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }
        
        .btn-shimmer:hover::before {
            left: 100%;
        }
        
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particle 20s linear infinite;
        }
        
        @keyframes particle {
            0% { transform: translateY(100vh) rotate(0deg) scale(0); opacity: 0; }
            10% { opacity: 1; transform: scale(1); }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg) scale(0); opacity: 0; }
        }
        
        .logo-glow {
            box-shadow: 
                0 0 20px rgba(16, 185, 129, 0.3),
                0 0 40px rgba(16, 185, 129, 0.2),
                0 0 80px rgba(16, 185, 129, 0.1);
            animation: pulse-glow 3s ease-in-out infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), 0 0 40px rgba(16, 185, 129, 0.2), 0 0 80px rgba(16, 185, 129, 0.1); }
            50% { box-shadow: 0 0 30px rgba(16, 185, 129, 0.5), 0 0 60px rgba(16, 185, 129, 0.3), 0 0 100px rgba(16, 185, 129, 0.2); }
        }
    </style>
</head>
<body class="min-h-screen bg-pattern relative overflow-hidden">
    <!-- Animated Particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 25%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 9s;"></div>
        <div class="particle" style="left: 75%; animation-delay: 12s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 15s;"></div>
    </div>

    <!-- Floating Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 floating"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 floating-delayed"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-r from-teal-400 to-green-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 floating-slow"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-8 relative z-10">
        <div class="max-w-md w-full space-y-8">
            <!-- Header Section -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 logo-glow floating transform hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-leaf text-white text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold gradient-text mb-3">
                    Chào mừng trở lại!
                </h2>
                <p class="text-gray-200 text-lg font-light">Đăng nhập để khám phá thế giới mua sắm</p>
            </div>

            <!-- Login Form -->
            <div class="glass-effect rounded-2xl shadow-2xl p-8 space-y-6 floating-slow">
                <?php if (isset($error)): ?>
                    <div class="glass-card border-l-4 border-red-400 p-4 rounded-xl">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-400 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-200 font-medium"><?php echo $error; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="/webbanhang/account/login" method="POST" class="space-y-6">
                    <!-- Username Input -->
                    <div class="input-group">
                        <label for="username" class="block text-sm font-bold text-white mb-2 flex items-center">
                            <i class="fas fa-user mr-2 text-emerald-400"></i>
                            Tên đăng nhập
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="text" id="username" name="username" required
                                class="block w-full pl-12 pr-4 py-4 border-0 rounded-xl focus:ring-2 focus:ring-emerald-400 transition-all duration-300 text-gray-900 placeholder-gray-500 bg-white/20 backdrop-blur-sm text-base font-medium shadow-inner"
                                placeholder="Nhập tên đăng nhập của bạn">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="input-group">
                        <label for="password" class="block text-sm font-bold text-white mb-2 flex items-center">
                            <i class="fas fa-lock mr-2 text-cyan-400"></i>
                            Mật khẩu
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock input-icon text-gray-400 text-lg"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="block w-full pl-12 pr-12 py-4 border-0 rounded-xl focus:ring-2 focus:ring-emerald-400 transition-all duration-300 text-gray-900 placeholder-gray-500 bg-white/20 backdrop-blur-sm text-base font-medium shadow-inner"
                                placeholder="Nhập mật khẩu của bạn">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-emerald-400 transition-colors transform hover:scale-110">
                                    <i class="fas fa-eye text-lg" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-emerald-500 focus:ring-emerald-400 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-200">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
                                Quên mật khẩu?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-shimmer group relative w-full flex justify-center py-4 px-6 border border-transparent text-lg font-bold rounded-xl text-white bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 hover:from-emerald-600 hover:via-teal-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                            <i class="fas fa-sign-in-alt group-hover:translate-x-2 transition-transform text-lg"></i>
                        </span>
                        Đăng nhập ngay
                        <span class="absolute right-0 inset-y-0 flex items-center pr-4">
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform opacity-0 group-hover:opacity-100"></i>
                        </span>
                    </button>

                    <!-- Social Login -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300/30"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-transparent text-gray-300 font-medium">Hoặc đăng nhập với</span>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <button type="button" class="glass-card hover:bg-white/20 inline-flex justify-center py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fab fa-google text-red-400 text-xl"></i>
                            </button>
                            <button type="button" class="glass-card hover:bg-white/20 inline-flex justify-center py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fab fa-facebook text-blue-400 text-xl"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="text-center pt-4 border-t border-gray-300/20">
                    <p class="text-gray-200 text-base">
                        Chưa có tài khoản? 
                        <a href="/webbanhang/account/register" class="font-bold text-emerald-400 hover:text-emerald-300 transition-colors hover:underline ml-1">
                            Đăng ký miễn phí
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="/webbanhang/Product" class="inline-flex items-center text-white/80 hover:text-white transition-colors group text-base font-medium">
                    <i class="fas fa-home mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Quay lại trang chủ
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform opacity-0 group-hover:opacity-100"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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

        // Enhanced focus effects
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
                this.style.background = 'rgba(255, 255, 255, 0.3)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
                this.style.background = 'rgba(255, 255, 255, 0.2)';
            });
        });

        // Add typing effect to title
        document.addEventListener('DOMContentLoaded', function() {
            const title = document.querySelector('.gradient-text');
            const text = title.textContent;
            title.textContent = '';
            
            let i = 0;
            const typeWriter = () => {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            };
            
            setTimeout(typeWriter, 500);
        });

        // Add ripple effect to button
        document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
            let ripple = document.createElement('span');
            let rect = this.getBoundingClientRect();
            let size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>