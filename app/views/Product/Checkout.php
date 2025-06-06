<?php include 'app/views/shares/header.php'; ?>

<div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center text-green-600">Thông tin Thanh toán</h1>

    <form method="POST" action="/webbanhang/Product/processCheckout">
        <div class="mb-6">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Họ tên người nhận:</label>
            <input type="text" id="name" name="name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-shadow" required placeholder="Nguyễn Văn A">
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại:</label>
            <input type="tel" id="phone" name="phone" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-shadow" required placeholder="09xxxxxxxx">
        </div>

        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-shadow" required placeholder="xxxxx@gmail.com">
        </div>

        <div class="mb-8">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Địa chỉ nhận hàng:</label>
            <textarea id="address" name="address" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-shadow" rows="3" required placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố"></textarea>
        </div>
        
        <?php 
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        if (!empty($cart)) {
            $total_price = 0;
            echo '<div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">';
            echo '<h3 class="text-lg font-semibold text-gray-700 mb-2">Đơn hàng của bạn:</h3>';
            echo '<ul class="list-disc list-inside text-sm text-gray-600">';
            foreach ($cart as $item) {
                $total_price += $item['price'] * $item['quantity'];
                echo '<li>' . htmlspecialchars($item['name']) . ' x ' . $item['quantity'] . '</li>';
            }
            echo '</ul>';
            echo '<p class="mt-3 font-bold text-gray-800">Tổng cộng: ' . number_format($total_price, 0, ',', '.') . ' VND</p>';
            echo '</div>';
        }
        ?>


        <div class="flex items-center justify-between mt-10">
            <a href="/webbanhang/Product/cart" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Quay lại giỏ hàng
            </a>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-px focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                <i class="fas fa-check-circle mr-2"></i> Hoàn tất Đặt hàng
            </button>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>