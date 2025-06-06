<?php include 'app/views/shares/header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center text-yellow-500">Sửa thông tin sản phẩm</h1>

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

    <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image ?? '', ENT_QUOTES, 'UTF-8'); ?>">

        <div class="mb-6">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-shadow" value="<?php echo htmlspecialchars($product->name ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Mô tả:</label>
            <textarea id="description" name="description" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-shadow" rows="4" required><?php echo htmlspecialchars($product->description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="mb-6">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Giá (VND):</label>
            <input type="number" id="price" name="price" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-shadow" step="1000" value="<?php echo htmlspecialchars($product->price ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="mb-6">
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Danh mục:</label>
            <select id="category_id" name="category_id" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white transition-shadow" required>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>" 
                                <?php if(isset($product->category_id) && $category->id == $product->category_id) { echo 'selected'; } ?>>
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-8">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Hình ảnh mới (nếu muốn thay đổi):</label>
            <input type="file" id="image" name="image" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-yellow-50 file:text-yellow-700
            hover:file:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
            
            <?php if (!empty($product->image)): ?>
                <p class="mt-3 text-sm text-gray-600">Hình ảnh hiện tại:</p>
                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" class="mt-2 rounded-lg shadow-sm" style="max-width: 150px; max-height:150px;">
            <?php endif; ?>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-px focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
               <i class="fas fa-sync-alt mr-2"></i> Lưu thay đổi
            </button>
            <a href="/webbanhang/Product/" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Quay lại danh sách
            </a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>