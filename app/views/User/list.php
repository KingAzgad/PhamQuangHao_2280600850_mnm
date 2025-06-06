<?php include_once 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Quản lý Người dùng</h1>
                    <p class="text-gray-600">Quản lý tài khoản người dùng trong hệ thống</p>
                </div>
                <a href="/webbanhang/user/create" 
                   class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-colors flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Thêm người dùng
                </a>
            </div>
        </div>

        <!-- Messages -->
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700"><?php echo htmlspecialchars($_GET['success']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700"><?php echo htmlspecialchars($_GET['error']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Người dùng
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vai trò
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ngày tạo
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (isset($users) && is_array($users) && !empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-4">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo htmlspecialchars($user->fullname ?? ''); ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    @<?php echo htmlspecialchars($user->username ?? ''); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($user->email ?? ''); ?></div>
                                        <?php if (!empty($user->phone)): ?>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($user->phone ?? ''); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($user->role === 'admin'): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-crown mr-1"></i>
                                                Quản trị viên
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-user mr-1"></i>
                                                Người dùng
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d/m/Y H:i', strtotime($user->created_at ?? 'now')); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="/webbanhang/user/edit/<?php echo $user->id; ?>" 
                                               class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 px-3 py-1 rounded transition-colors">
                                                <i class="fas fa-edit mr-1"></i>
                                                Sửa
                                            </a>
                                            <?php if ($user->username !== $_SESSION['username']): ?>
                                                <button onclick="confirmDelete(<?php echo $user->id; ?>, '<?php echo htmlspecialchars($user->username ?? ''); ?>')" 
                                                        class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-3 py-1 rounded transition-colors">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Xóa
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p>Không có người dùng nào trong hệ thống hoặc có lỗi khi tải dữ liệu.</p>
                                    <?php if (isset($users) && empty($users)): ?>
                                        <p>Kiểm tra log để xem chi tiết lỗi.</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-2">Xác nhận xóa</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Bạn có chắc chắn muốn xóa người dùng <span id="deleteUsername" class="font-medium"></span>?
                    <br>Hành động này không thể hoàn tác.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmDeleteBtn" onclick="deleteUser()" 
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-red-600 transition-colors">
                    Xóa
                </button>
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 hover:bg-gray-400 transition-colors">
                    Hủy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteUserId = null;

function confirmDelete(userId, username) {
    deleteUserId = userId;
    document.getElementById('deleteUsername').textContent = username;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    deleteUserId = null;
}

function deleteUser() {
    if (deleteUserId) {
        window.location.href = `/webbanhang/user/delete/${deleteUserId}`;
    }
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>