<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Danh sách sản phẩm</h1>
        <a href="/webbanhang/Product/add" class="bg-emerald-600 hover:bg-emerald-700 text-white py-2 px-4 rounded-lg flex items-center transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Thêm sản phẩm mới
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($products as $product): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="relative" style="padding-bottom: 66.666667%;">
                    <?php if ($product->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/webbanhang/' . $product->image)): ?>
                        <img src="/webbanhang/<?php echo $product->image; ?>" 
                             alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                             class="absolute h-full w-full object-cover object-center">
                    <?php else: ?>
                        <div class="absolute h-full w-full bg-gray-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <h2 class="text-xl font-semibold text-gray-800 hover:text-blue-600 transition duration-200">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h2>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                            <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                    
                    <p class="mt-2 text-gray-600 overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    
                    <div class="mt-4">
                        <span class="text-xl font-bold text-gray-900"><?php echo number_format($product->price, 0, ',', '.'); ?> VND</span>
                    </div>
                    
                    <div class="mt-4 flex space-x-2">
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                           class="flex-1 bg-amber-500 hover:bg-amber-600 text-white text-center py-2 rounded-md transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Sửa
                        </a>
                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" 
                           class="flex-1 bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded-md transition duration-200"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Xóa
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>