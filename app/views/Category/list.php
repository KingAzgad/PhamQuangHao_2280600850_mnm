<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800">Quản Lý Danh Mục</h1>
        <a href="/webbanhang/Category/add" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> Thêm Danh Mục Mới
        </a>
    </div>

    <?php
    // Display session messages (e.g., success/error from add/edit/delete)
    if (isset($_SESSION['message'])):
        $message_type = $_SESSION['message']['type'];
        $message_text = $_SESSION['message']['text'];
        $color_class = '';
        if ($message_type === 'success') {
            $color_class = 'bg-green-100 border-green-500 text-green-700';
        } else if ($message_type === 'error') {
            $color_class = 'bg-red-100 border-red-500 text-red-700';
        }
        echo '<div class="' . $color_class . ' border-l-4 p-4 mb-6 rounded-md shadow" role="alert">';
        echo '<p class="font-bold">Thông báo</p>';
        echo '<p>' . htmlspecialchars($message_text, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</div>';
        unset($_SESSION['message']); // Clear the message after displaying
    endif;
    ?>

    <?php if (empty($categories)): ?>
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-md shadow-md text-center">
            <i class="fas fa-info-circle fa-3x text-blue-400 mb-4"></i>
            <p class="text-2xl font-semibold">Chưa có danh mục nào.</p>
            <p class="mt-2 text-lg">Hãy thêm danh mục đầu tiên của bạn ngay bây giờ!</p>
        </div>
    <?php else: ?>
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Tên Danh Mục</th>
                            <th class="py-3 px-6 text-left">Mô Tả</th>
                            <th class="py-3 px-6 text-center">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php foreach ($categories as $category): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-4 px-6 text-left whitespace-nowrap">
                                    <span class="font-bold text-gray-800"><?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?></span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <p class="font-semibold text-purple-700"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></p>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <p class="text-gray-600 break-words max-w-xs"><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></p>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-3">
                                        <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>" class="w-8 h-8 rounded-full bg-blue-200 hover:bg-blue-100 flex items-center justify-center transform hover:scale-110 transition-transform duration-200" title="Sửa">
                                            <i class="fas fa-edit text-blue-500"> Sửa</i>
                                        </a>
                                        <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>" class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center transform hover:scale-110 transition-transform duration-200" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                            <i class="fas fa-trash-alt">Xoá</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>