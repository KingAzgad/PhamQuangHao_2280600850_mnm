<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-5xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
            Danh sách sản phẩm
        </h1>
        <p class="text-gray-600 text-lg">Khám phá các sản phẩm chất lượng cao của chúng tôi</p>
    </div>

    <!-- Filter Bar (Simple & Non-conflicting) -->
    <div class="bg-white rounded-lg shadow-sm border p-4 mb-8">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <!-- Search -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text"
                        id="productSearch"
                        placeholder="Tìm kiếm sản phẩm..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Filter & Sort -->
            <div class="flex gap-3">
                <select id="categoryFilter"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                    <option value="">Tất cả danh mục</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category->name); ?>">
                                <?php echo htmlspecialchars($category->name); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <select id="sortProducts"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white">
                    <option value="default">Mặc định</option>
                    <option value="name-asc">Tên A-Z</option>
                    <option value="name-desc">Tên Z-A</option>
                    <option value="price-asc">Giá thấp → cao</option>
                    <option value="price-desc">Giá cao → thấp</option>
                </select>

                <!-- Admin Add Button -->
                <?php if (SessionHelper::isAdmin()): ?>
                    <a href="/webbanhang/Product/add"
                        class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        <span class="hidden sm:inline">Thêm mới</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Filter Results Info -->
        <div id="filterResults" class="mt-3 text-sm text-gray-600 hidden">
            <i class="fas fa-filter mr-1 text-purple-500"></i>
            <span id="resultText">Đang hiển thị sản phẩm đã lọc</span>
        </div>
    </div>

    <!-- Products Section -->
    <?php if (empty($products)): ?>
        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-500 text-yellow-700 p-8 rounded-lg shadow-lg text-center">
            <div class="mb-4">
                <i class="fas fa-box-open text-6xl text-yellow-400"></i>
            </div>
            <p class="text-2xl font-bold mb-2">Không có sản phẩm</p>
            <p class="text-lg">Hiện tại chưa có sản phẩm nào trong cửa hàng. Hãy thêm sản phẩm mới!</p>
            <?php if (SessionHelper::isAdmin()): ?>
                <a href="/webbanhang/Product/add" class="mt-6 inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm sản phẩm đầu tiên
                </a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <!-- No Results Message -->
        <div id="noProductsFound" class="hidden bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
            <div class="mb-4">
                <i class="fas fa-search text-4xl text-gray-400"></i>
            </div>
            <p class="text-xl font-semibold text-gray-600 mb-2">Không tìm thấy sản phẩm</p>
            <p class="text-gray-500">Thử thay đổi từ khóa tìm kiếm hoặc bộ lọc</p>
            <button onclick="clearAllFilters()"
                class="mt-4 px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors">
                <i class="fas fa-undo mr-2"></i>Xóa bộ lọc
            </button>
        </div>

        <!-- Products Grid -->
        <div id="productsContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <?php foreach ($products as $product): ?>
                <div class="product-card bg-white rounded-xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-2 group"
                    data-name="<?php echo strtolower(htmlspecialchars($product->name)); ?>"
                    data-category="<?php echo htmlspecialchars($product->category_name); ?>"
                    data-price="<?php echo $product->price; ?>">

                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-white">
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="block">
                            <?php if ($product->image): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                    alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                                    class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105 image-sharp"
                                    loading="lazy"
                                    onerror="this.parentElement.innerHTML='<div class=\'w-full h-56 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center\'><i class=\'fas fa-image text-4xl text-gray-400\'></i></div>'">
                            <?php else: ?>
                                <div class="w-full h-56 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                        </a>

                        <!-- Overlay on Hover -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>

                        <!-- Quick Actions (Admin) -->
                        <?php if (SessionHelper::isAdmin()): ?>
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="flex flex-col gap-1">
                                    <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>"
                                        class="w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full flex items-center justify-center shadow-lg transition-colors"
                                        title="Sửa sản phẩm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>

                                    </a>
                                    <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"
                                        class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-colors"
                                        title="Xóa sản phẩm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Status Badge -->
                        <div class="absolute top-2 left-2">
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                HOT
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <!-- Category Tag -->
                        <div class="mb-3">
                            <span class="inline-block bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                                <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 h-10">
                            <?php echo htmlspecialchars(strip_tags($product->description), ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                        <!-- Price -->
                        <div class="mb-4">
                            <p class="text-2xl font-bold text-green-600">
                                <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2">
                            <!-- Add to Cart - Giữ nguyên logic cũ -->
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                                class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-cart-plus mr-2"></i>
                                Thêm vào giỏ hàng
                            </a>

                            <!-- View Details -->
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Results Counter -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center bg-gray-100 rounded-full px-6 py-3 shadow-sm">
                <i class="fas fa-cubes text-purple-600 mr-2"></i>
                <span class="text-gray-700 font-medium">
                    Hiển thị <span id="shownCount"><?php echo count($products); ?></span> /
                    <span id="totalCount"><?php echo count($products); ?></span> sản phẩm
                </span>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Optimized Styles -->
<style>
    /* Text truncation */
    .line-clamp-2 {
        display: -webkit-box;        
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Image optimization for sharpness */
    .image-sharp {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: -webkit-crisp-edges;
        image-rendering: -moz-crisp-edges;
        image-rendering: crisp-edges;
        image-rendering: pixelated;
        image-rendering: optimize-contrast;

        /* Improve image quality */
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);

        /* Better image smoothing */
        -ms-interpolation-mode: bicubic;
        image-rendering: high-quality;

        /* Prevent blurry scaling */
        transform: translateZ(0);
        will-change: transform;
    }

    /* Better image container */
    .product-card .relative {
        background-color: #ffffff;
        border: 1px solid #f3f4f6;
    }

    /* Smooth animations */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card.filtered-out {
        display: none;
    }

    /* Responsive improvements */
    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .grid {
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
        }

        .text-5xl {
            font-size: 2.5rem;
        }
    }

    @media (min-width: 640px) and (max-width: 768px) {
        .grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (min-width: 1024px) and (max-width: 1280px) {
        .grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    /* Performance optimizations */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    /* Loading states */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }
</style>

<!-- Lightweight JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('productSearch');
        const categoryFilter = document.getElementById('categoryFilter');
        const sortSelect = document.getElementById('sortProducts');
        const productsContainer = document.getElementById('productsContainer');
        const noProductsFound = document.getElementById('noProductsFound');
        const filterResults = document.getElementById('filterResults');
        const resultText = document.getElementById('resultText');
        const shownCount = document.getElementById('shownCount');
        const totalCount = document.getElementById('totalCount');

        let allProducts = [];
        let filteredProducts = [];

        // Initialize
        function init() {
            allProducts = Array.from(document.querySelectorAll('.product-card'));
            filteredProducts = [...allProducts];
            updateCounter();
        }

        // Simple filter function
        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedCategory = categoryFilter.value;

            filteredProducts = allProducts.filter(product => {
                const name = product.dataset.name;
                const category = product.dataset.category;

                const matchesSearch = !searchTerm || name.includes(searchTerm);
                const matchesCategory = !selectedCategory || category === selectedCategory;

                return matchesSearch && matchesCategory;
            });

            displayProducts();
            updateCounter();
            updateFilterInfo();
        }

        // Sort products
        function sortProducts() {
            const sortValue = sortSelect.value;

            if (sortValue === 'default') return;

            filteredProducts.sort((a, b) => {
                switch (sortValue) {
                    case 'name-asc':
                        return a.dataset.name.localeCompare(b.dataset.name);
                    case 'name-desc':
                        return b.dataset.name.localeCompare(a.dataset.name);
                    case 'price-asc':
                        return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                    case 'price-desc':
                        return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                    default:
                        return 0;
                }
            });

            displayProducts();
        }

        // Display filtered products
        function displayProducts() {
            // Hide all products
            allProducts.forEach(product => {
                product.classList.add('filtered-out');
            });

            // Show filtered products
            if (filteredProducts.length === 0) {
                noProductsFound.classList.remove('hidden');
                productsContainer.style.display = 'none';
            } else {
                noProductsFound.classList.add('hidden');
                productsContainer.style.display = 'grid';

                filteredProducts.forEach(product => {
                    product.classList.remove('filtered-out');
                    productsContainer.appendChild(product); // Reorder
                });
            }
        }

        // Update counter
        function updateCounter() {
            if (shownCount && totalCount) {
                shownCount.textContent = filteredProducts.length;
                totalCount.textContent = allProducts.length;
            }
        }

        // Update filter info
        function updateFilterInfo() {
            const hasFilters = searchInput.value.trim() || categoryFilter.value;

            if (hasFilters && filterResults) {
                filterResults.classList.remove('hidden');
                if (resultText) {
                    resultText.textContent = `Hiển thị ${filteredProducts.length} sản phẩm được lọc`;
                }
            } else {
                if (filterResults) filterResults.classList.add('hidden');
            }
        }

        // Clear filters
        window.clearAllFilters = function() {
            searchInput.value = '';
            categoryFilter.value = '';
            sortSelect.value = 'default';
            filteredProducts = [...allProducts];
            displayProducts();
            updateCounter();
            updateFilterInfo();
        };

        function optimizeImages() {
            const images = document.querySelectorAll('img[loading="lazy"]');

            images.forEach(img => {
                if (img.complete) {
                    img.classList.add('loaded');
                } else {
                    img.addEventListener('load', function() {
                        this.classList.add('loaded');
                    });

                    img.addEventListener('error', function() {
                        this.style.opacity = '1';
                        // Keep the error handling from onerror attribute
                    });
                }
            });
        }

        // Image sharpening for retina displays
        function handleRetinaImages() {
            if (window.devicePixelRatio > 1) {
                const images = document.querySelectorAll('.image-sharp');
                images.forEach(img => {
                    img.style.imageRendering = 'crisp-edges';
                    img.style.imageRendering = '-webkit-optimize-contrast';
                });
            }
        }

        // Initialize image optimizations
        optimizeImages();
        handleRetinaImages();

        // Re-optimize images after filtering
        const originalDisplayProducts = displayProducts;
        displayProducts = function() {
            originalDisplayProducts();
            setTimeout(() => {
                optimizeImages();
                handleRetinaImages();
            }, 100);
        };

        // Event listeners
        if (searchInput) searchInput.addEventListener('input', filterProducts);
        if (categoryFilter) categoryFilter.addEventListener('change', filterProducts);
        if (sortSelect) sortSelect.addEventListener('change', () => {
            sortProducts();
            displayProducts();
        });

        // Initialize
        init();
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>