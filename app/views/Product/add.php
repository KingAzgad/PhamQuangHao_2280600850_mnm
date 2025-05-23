<?php include 'app/views/shares/header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Thêm sản phẩm mới</h1>
    
    <?php if (!empty($errors)): ?>
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <ul class="list-disc list-inside text-sm text-red-700">
                    <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" 
                   required>
        </div>
        
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô tả:</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                      required></textarea>
        </div>
        
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Giá:</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">₫</span>
                </div>
                <input type="number" id="price" name="price" step="0.01"
                       class="w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                       required>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">VND</span>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Danh mục:</label>
            <select id="category_id" name="category_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                    required>
                <?php if (isset($categories) && is_array($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <?php if (is_object($category)): ?>
                            <option value="<?php echo htmlspecialchars($category->id ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($category->name ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh:</label>
            <div class="mt-1 flex items-center">
                <span class="inline-block h-12 w-12 overflow-hidden bg-gray-100 rounded-md">
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
                <label for="image" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                    Chọn tập tin
                    <input type="file" id="image" name="image" class="sr-only">
                </label>
                <span id="file-name-display" class="ml-3 text-sm text-gray-500"></span>
            </div>
            <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF tối đa 2MB</p>
        </div>
        
        <div class="flex items-center justify-between">
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                Thêm sản phẩm
            </button>
            <a href="/webbanhang/Product/list" 
               class="ml-3 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200">
                Quay lại danh sách
            </a>
        </div>
    </form>
</div>

<script>

document.getElementById('image').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'Không có tập tin nào được chọn';
    document.getElementById('file-name-display').textContent = fileName;
});


function validateForm() {
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var price = document.getElementById('price').value;
    var category = document.getElementById('category_id').value;
    
    if (name.trim() === '') {
        alert('Vui lòng nhập tên sản phẩm');
        return false;
    }
    
    if (description.trim() === '') {
        alert('Vui lòng nhập mô tả sản phẩm');
        return false;
    }
    
    if (price.trim() === '' || isNaN(price) || parseFloat(price) < 0) {
        alert('Vui lòng nhập giá hợp lệ');
        return false;
    }
    
    if (category === '') {
        alert('Vui lòng chọn danh mục');
        return false;
    }
    
    return true;
}
</script>

<?php include 'app/views/shares/footer.php'; ?>