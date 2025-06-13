<?php
require_once('app/config/database.php');
require_once('app/models/OrdersModel.php');
require_once('app/utils/JWTHandler.php');

class OrdersApiController
{
    private $ordersModel;
    private $db;
    private $jwtHandler;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->ordersModel = new OrdersModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }

    private function authenticate()
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            $arr = explode(" ", $authHeader);
            $jwt = $arr[1] ?? null;
            if ($jwt) {
                $decoded = $this->jwtHandler->decode($jwt);
                return $decoded ? true : false;
            }
        }
        return false;
    }

    public function index()
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        header('Content-Type: application/json');
        $orders = $this->ordersModel->getOrders();
        echo json_encode($orders);
    }

    public function show($id)
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        header('Content-Type: application/json');
        $order = $this->ordersModel->getOrderDetailsById($id);
        if ($order) {
            echo json_encode($order);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Order not found']);
        }
    }
    public function userOrders()
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        header('Content-Type: application/json');
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(400);
            echo json_encode(['message' => 'User ID not found in session']);
            return;
        }

        $orders = $this->ordersModel->getOrdersByUserId($userId);
        echo json_encode($orders);
    }
    public function store()
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['message' => 'Forbidden']);
            return;
        }

        // Lấy dữ liệu từ request body
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid input']);
            return;
        }

        // Thêm logic để lưu đơn hàng vào cơ sở dữ liệu
        $result = $this->ordersModel->createOrder($data);
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => 'Order created successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to create order']);
        }
    }
    public function update($id)
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['message' => 'Forbidden']);
            return;
        }

        // Lấy dữ liệu từ request body
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid input']);
            return;
        }

        // Cập nhật đơn hàng
        $result = $this->ordersModel->updateOrder($id, $data);
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Order updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to update order']);
        }
    }
    public function destroy($id)
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['message' => 'Forbidden']);
            return;
        }

        // Xoá đơn hàng
        $result = $this->ordersModel->deleteOrder($id);
        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Order deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to delete order']);
        }
    }
}
