<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/models/OrdersModel.php');

class OrdersController
{
    private $orderModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrdersModel($this->db);
    }

    // Kiểm tra quyền Admin 
    private function isAdmin()
    {
        return SessionHelper::isAdmin();
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $orders = $this->orderModel->getOrders();
        include 'app/views/orders/list.php';
    }

    public function detail($id)
    {
        $data = $this->orderModel->getOrderDetailsById($id);

        // ✅ Rõ ràng truyền đúng biến sang view
        $order = $data['order'];
        $products = $data['products']; // <-- đây là danh sách sản phẩm

        include 'app/views/orders/detail.php';
    }

    // Lịch sử mua hàng của người dùng
    public function userOrders()
    {
        SessionHelper::start(); // 🟡 PHẢI có để đảm bảo $_SESSION hoạt động

        if (!SessionHelper::isLoggedIn()) {
            echo "Bạn cần đăng nhập để xem lịch sử mua hàng!";
            exit;
        }

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            echo "Không tìm thấy ID người dùng trong session.";
            exit;
        }

        $orders = $this->orderModel->getOrdersByUserId($userId);
        include 'app/views/orders/ordersuser.php';
    }
}
