<?php include_once 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-6">
                    <i class="fas fa-cog text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Cài đặt tài khoản</h1>
                    <p class="text-gray-600">Quản lý bảo mật và cài đặt tài khoản</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <nav class="space-y-2">
                        <a href="/webbanhang/account/profile" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-user mr-3"></i>
                            Thông tin cá nhân
                        </a>
                        <a href="/webbanhang/account/settings" class="flex items-center px-4 py-2 text-purple-600 bg-purple-50 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            Cài đặt
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Change Password Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Đổi mật khẩu</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700"><?php echo $error; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700"><?php echo $success; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="/webbanhang/account/settings" method="POST" class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Mật khẩu hiện tại
                            </label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent pr-10">
                                <button type="button" onclick="togglePassword('current_password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="toggleIcon1"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Mật khẩu mới
                            </label>
                            <div class="relative">
                                <input type="password" id="new_password" name="new_password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent pr-10">
                                <button type="button" onclick="togglePassword('new_password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="toggleIcon2"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Mật khẩu phải có ít nhất 6 ký tự</p>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Xác nhận mật khẩu mới
                            </label>
                            <div class="relative">
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent pr-10">
                                <button type="button" onclick="togglePassword('confirm_password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="toggleIcon3"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="resetForm()" 
                                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                Hủy
                            </button>
                            <button type="submit" 
                                class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-colors">
                                Đổi mật khẩu
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Account Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Thông tin tài khoản</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b border-gray-200">
                            <div>
                                <p class="font-medium text-gray-800">Tên đăng nhập</p>
                                <p class="text-sm text-gray-500"><?php echo $_SESSION['username']; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-200">
                            <div>
                                <p class="font-medium text-gray-800">Vai trò</p>
                                <p class="text-sm text-gray-500">
                                    <?php echo SessionHelper::isAdmin() ? 'Quản trị viên' : 'Người dùng'; ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <div>
                                <p class="font-medium text-gray-800">Ngày tạo tài khoản</p>
                                <p class="text-sm text-gray-500"><?php echo $user->created_at ?? 'Không xác định'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.querySelector(`#${fieldId} + button i`);
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function resetForm() {
    document.querySelector('form').reset();
}

// Password confirmation validation
document.getElementById('confirm_password').addEventListener('input', function() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = this.value;
    
    if (newPassword !== confirmPassword) {
        this.setCustomValidity('Mật khẩu không khớp');
        this.style.borderColor = '#ef4444';
    } else {
        this.setCustomValidity('');
        this.style.borderColor = '#d1d5db';
    }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>