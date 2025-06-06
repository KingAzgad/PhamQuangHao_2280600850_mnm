<?php include 'app/views/shares/header.php'; ?>

<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center text-cyan-600 pt-4">Giỏ hàng của bạn</h1>

    <div id="cart-container">
        <?php if (!empty($cart)): ?>
            <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6">
                <ul class="divide-y divide-gray-200" id="cart-item-list">
                    <?php 
                    foreach ($cart as $id => $item): 
                        $item_total = $item['price'] * $item['quantity'];
                    ?>
                        <li class="py-6 flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6" id="cart-item-<?php echo $id; ?>">
                            <?php if ($item['image']): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>" class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-lg shadow-sm self-center sm:self-auto">
                            <?php else: ?>
                                 <div class="w-24 h-24 sm:w-28 sm:h-28 bg-gray-200 flex items-center justify-center text-gray-400 rounded-lg shadow-sm self-center sm:self-auto">
                                    <i class="fas fa-image fa-2x"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex-grow w-full">
                                <h2 class="text-xl font-semibold text-cyan-700 hover:text-cyan-800 transition-colors">
                                    <a href="/webbanhang/Product/show/<?php echo $id; ?>"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></a>
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">Đơn giá: <span class="item-price"><?php echo number_format($item['price'], 0, ',', '.'); ?></span> VND</p>
                                
                                <div class="mt-3 flex items-center justify-between">
                                     Quantity <div class="flex items-center border border-gray-300 rounded-md shadow-sm">
                                        <button type="button" data-id="<?php echo $id; ?>" 
                                                class="quantity-decrease p-2 text-gray-600 hover:bg-gray-100 focus:outline-none rounded-l-md transition-colors duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <span id="quantity-<?php echo $id; ?>" 
                                              class="item-quantity px-4 py-1.5 text-center text-gray-700 border-l border-r border-gray-300 text-sm font-medium w-12">
                                            <?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                        <button type="button" data-id="<?php echo $id; ?>" 
                                                class="quantity-increase p-2 text-gray-600 hover:bg-gray-100 focus:outline-none rounded-r-md transition-colors duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-lg font-bold text-green-600">
                                        <span id="item-total-<?php echo $id; ?>"><?php echo number_format($item_total, 0, ',', '.'); ?></span> VND
                                    </p>
                                </div>
                            </div>
                             <button type="button" data-id="<?php echo $id; ?>" 
                               class="remove-item text-red-500 hover:text-red-700 transition-colors text-sm font-medium self-end sm:self-center mt-2 sm:mt-0">
                                <i class="fas fa-trash-alt mr-1"></i>Xóa
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-between items-center text-2xl font-bold text-gray-800">
                        <span>Tổng cộng:</span>
                        <span id="cart-total-price" class="text-green-600"><?php echo number_format($cartTotalPrice ?? 0, 0, ',', '.'); ?> VND</span>
                    </div>
                </div>
                 <div class="mt-10 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <a href="/webbanhang/Product/" class="w-full sm:w-auto text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                        <i class="fas fa-shopping-bag mr-2"></i>Tiếp tục mua sắm
                    </a>
                    <a href="/webbanhang/Product/checkout" id="checkout-button" class="w-full sm:w-auto text-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-px">
                        <i class="fas fa-credit-card mr-2"></i>Tiến hành Thanh Toán
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div id="empty-cart-message" class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-6 rounded-md shadow-md text-center">
                <i class="fas fa-shopping-cart fa-3x text-blue-400 mb-4"></i>
                <p class="text-2xl font-semibold">Giỏ hàng của bạn đang trống.</p>
                <p class="mt-2">Hãy thêm sản phẩm vào giỏ để tiếp tục mua sắm nhé!</p>
                <a href="/webbanhang/Product/" class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors">
                    Khám phá sản phẩm
                </a>
            </div>
        <?php endif; ?>
    </div> </div>

<script>
// Your existing JavaScript for AJAX updates should still work with these new button structures,
// as long as the `data-id` and classes (`quantity-decrease`, `quantity-increase`) are preserved.
document.addEventListener('DOMContentLoaded', function() {
    const cartContainer = document.getElementById('cart-container');

    cartContainer.addEventListener('click', function(event) {
        // Find the button that was clicked, even if the click was on the SVG icon inside it
        const targetButton = event.target.closest('button'); 
        if (!targetButton) return; // Exit if the click was not on or inside a button

        const productId = targetButton.dataset.id;

        if (targetButton.classList.contains('quantity-increase')) {
            updateCartQuantity(`/webbanhang/Product/increaseQuantity/${productId}`, productId);
        } else if (targetButton.classList.contains('quantity-decrease')) {
            updateCartQuantity(`/webbanhang/Product/decreaseQuantity/${productId}`, productId);
        } else if (targetButton.classList.contains('remove-item')) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                updateCartQuantity(`/webbanhang/Product/removeFromCart/${productId}`, productId, true);
            }
        }
    });

    function updateCartQuantity(url, productId, isRemoving = false) {
        fetch(url, {
            method: 'POST', 
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const quantityElement = document.getElementById(`quantity-${productId}`);
                const itemTotalElement = document.getElementById(`item-total-${productId}`);
                const cartTotalPriceElement = document.getElementById('cart-total-price');
                
                const navbarCartCountElement = document.getElementById('navbar-cart-count'); // Get navbar cart count by ID

                if (data.itemRemoved) {
                    const itemElement = document.getElementById(`cart-item-${productId}`);
                    if (itemElement) {
                        itemElement.remove();
                    }
                } else if (quantityElement && itemTotalElement) { // Check if elements exist before updating
                    quantityElement.textContent = data.newQuantity;
                    itemTotalElement.textContent = formatCurrency(data.itemTotalPrice);
                }

                if (cartTotalPriceElement) { // Check if element exists
                    cartTotalPriceElement.textContent = formatCurrency(data.cartTotalPrice) + ' VND';
                }
                
                if (navbarCartCountElement) { // Update navbar cart count
                    if (data.cartItemCount > 0) {
                        navbarCartCountElement.textContent = data.cartItemCount;
                        navbarCartCountElement.classList.remove('hidden');
                    } else {
                        navbarCartCountElement.textContent = '0'; 
                        navbarCartCountElement.classList.add('hidden');
                    }
                }

                if (data.cartItemCount === 0 || (document.getElementById('cart-item-list') && document.getElementById('cart-item-list').children.length === 0) ) {
                    showEmptyCartMessage();
                }

            } else {
                alert('Lỗi: ' + (data.message || 'Không thể cập nhật giỏ hàng.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        });
    }
    
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN').format(number);
    }

    function showEmptyCartMessage() {
        const cartContentDiv = document.querySelector('#cart-container > .bg-white'); // The div holding items and totals

        if (cartContentDiv) {
            cartContentDiv.remove();
        }

        let emptyCartMessageEl = document.getElementById('empty-cart-message');
        if(emptyCartMessageEl){ 
             emptyCartMessageEl.classList.remove('hidden'); 
        } else { 
            const newEmptyCartHTML = `
                <div id="empty-cart-message" class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-6 rounded-md shadow-md text-center">
                    <i class="fas fa-shopping-cart fa-3x text-blue-400 mb-4"></i>
                    <p class="text-2xl font-semibold">Giỏ hàng của bạn đang trống.</p>
                    <p class="mt-2">Hãy thêm sản phẩm vào giỏ để tiếp tục mua sắm nhé!</p>
                    <a href="/webbanhang/Product/" class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors">
                        Khám phá sản phẩm
                    </a>
                </div>`;
            document.getElementById('cart-container').insertAdjacentHTML('afterbegin', newEmptyCartHTML);
        }
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>