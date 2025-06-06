<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto mt-8 p-4">
    <?php if ($product): ?>
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0 md:w-1/2">
                    <?php if ($product->image): ?>
                        <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                             alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            <i class="fas fa-image fa-5x"></i>
                            <span class="ml-3">Không có ảnh</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-8 md:w-1/2 flex flex-col justify-between">
                    <div>
                        <div class="uppercase tracking-wide text-sm text-indigo-600 font-semibold">
                            <?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
                        </div>
                        <h1 class="block mt-1 text-4xl leading-tight font-bold text-purple-700 hover:text-indigo-600 transition-colors">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </h1>
                        <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                            <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                        </p>
                        <p class="mt-6 text-4xl font-extrabold text-green-600">
                            <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </p>
                    </div>
                    <div class="mt-8 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                           class="flex-grow text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-px">
                           <i class="fas fa-cart-plus mr-2"></i> Thêm vào giỏ hàng
                        </a>
                        <a href="/webbanhang/Product/"
                           class="flex-grow text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                           <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-6 rounded-md shadow-md text-center" role="alert">
            <h4 class="text-2xl font-bold"><i class="fas fa-exclamation-triangle mr-2"></i>Không tìm thấy sản phẩm!</h4>
            <p class="mt-2">Sản phẩm bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <a href="/webbanhang/Product/" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors">
                Về trang sản phẩm
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>