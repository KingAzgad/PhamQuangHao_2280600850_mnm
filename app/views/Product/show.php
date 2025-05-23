<?php include 'app/views/shares/header.php'; ?>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-primary-600 text-white py-4 px-6 text-center">
            <h2 class="text-2xl font-bold">Chi tiết sản phẩm</h2>
        </div>
        
        <?php if (isset($product) && is_object($product)): ?>
            <div class="md:flex">
                <div class="md:w-1/2">
                    <div class="p-4">
                        <?php if (isset($product->image) && $product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                 class="w-full h-auto rounded-md object-cover" 
                                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            <div class="w-full aspect-video bg-gray-200 rounded-md flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="md:w-1/2">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            <?php echo htmlspecialchars($product->name ?? '', ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        
                        <div class="prose max-w-none text-gray-600 mb-6">
                            <?php echo nl2br(htmlspecialchars($product->description ?? '', ENT_QUOTES, 'UTF-8')); ?>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <span class="text-2xl font-bold text-red-600">
                                <?php echo number_format($product->price ?? 0, 0, ',', '.'); ?> VND
                            </span>
                        </div>
                        
                        <div class="mb-6">
                            <span class="text-sm font-semibold text-gray-700">Danh mục:</span>
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <?php echo isset($product->category_name) && !empty($product->category_name) 
                                    ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') 
                                    : 'Chưa có danh mục'; 
                                ?>
                            </span>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id ?? ''; ?>"
                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition duration-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Thêm vào giỏ hàng
                            </a>
                            
                            <a href="/webbanhang/Product/list"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md transition duration-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 m-6 text-center">
                <h4 class="text-lg font-medium">Không tìm thấy sản phẩm!</h4>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>