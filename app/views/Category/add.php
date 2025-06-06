<?php include 'app/views/shares/header.php'; ?>

<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-2xl mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center text-purple-600">Thêm Danh Mục Mới</h1>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow" role="alert">
            <p class="font-bold mb-2">Vui lòng sửa các lỗi sau:</p>
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/webbanhang/Category/save">
        <div class="mb-6">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tên Danh Mục:</label>
            <input type="text" id="name" name="name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-shadow" value="<?php echo htmlspecialchars($old_input['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="mb-8">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Mô Tả:</label>
            <textarea id="description" name="description" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-shadow" rows="4" required><?php echo htmlspecialchars($old_input['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-px focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                <i class="fas fa-save mr-2"></i> Thêm Danh Mục
            </button>
            <a href="/webbanhang/Category/" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Quay lại Danh sách
            </a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>