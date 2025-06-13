<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/utils/JWTHandler.php');

class ProductApiController
{
    private $productModel;
    private $db;
    private $jwtHandler;
    private $logFile = 'logs/api_debug.log'; // File để ghi log

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->jwtHandler = new JWTHandler();
        // Đảm bảo thư mục logs tồn tại
        if (!is_dir('logs')) {
            mkdir('logs', 0777, true);
        }
    }

    // Hàm ghi log
    private function debugLog($message, $data = [])
    {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message";
        if (!empty($data)) {
            $logMessage .= ': ' . json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        $logMessage .= PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }

    private function authenticate()
    {
        $this->debugLog('Bắt đầu xác thực');
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            $arr = explode(" ", $authHeader);
            $jwt = $arr[1] ?? null;
            if ($jwt) {
                $decoded = $this->jwtHandler->decode($jwt);
                $this->debugLog('Kết quả xác thực', ['success' => (bool)$decoded]);
                return $decoded ? true : false;
            }
        }
        $this->debugLog('Xác thực thất bại - Không có JWT');
        return false;
    }

    public function index()
    {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }

    public function show($id)
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Sản phẩm không tồn tại']);
        }
    }

    public function store()
    {
        $this->debugLog('Bắt đầu phương thức store', ['method' => $_SERVER['REQUEST_METHOD']]);

        if (!$this->authenticate()) {
            http_response_code(401);
            $this->debugLog('Lỗi xác thực');
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }

        $this->debugLog('Kiểm tra role', ['session_role' => $_SESSION['role'] ?? 'none']);
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            $this->debugLog('Lỗi quyền truy cập');
            echo json_encode(['message' => 'Bạn không có quyền thêm sản phẩm']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            $imagePath = $_POST['image'] ?? '';

            $this->debugLog('Dữ liệu đầu vào', [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'category_id' => $category_id,
                'image' => $_FILES['image'] ?? null
            ]);

            if (empty($category_id) || !ctype_digit((string)$category_id)) {
                http_response_code(400);
                $this->debugLog('Lỗi validation: Danh mục không hợp lệ', ['category_id' => $category_id]);
                echo json_encode(['message' => 'Danh mục sản phẩm không hợp lệ']);
                return;
            }
            if (empty($name) || strlen($name) < 3 || strlen($name) > 100) {
                http_response_code(400);
                $this->debugLog('Lỗi validation: Tên sản phẩm', ['name' => $name]);
                echo json_encode(['message' => 'Tên sản phẩm phải từ 3 đến 100 ký tự']);
                return;
            }
            if (empty($description) || strlen($description) < 10 || strlen($description) > 500) {
                http_response_code(400);
                $this->debugLog('Lỗi validation: Mô tả sản phẩm', ['description' => $description]);
                echo json_encode(['message' => 'Mô tả sản phẩm phải từ 10 đến 500 ký tự']);
                return;
            }
            if (!is_numeric($price) || $price <= 0) {
                http_response_code(400);
                $this->debugLog('Lỗi validation: Giá sản phẩm', ['price' => $price]);
                echo json_encode(['message' => 'Giá sản phẩm phải là một số dương']);
                return;
            }

            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                try {
                    $this->debugLog('Bắt đầu upload ảnh');
                    $imagePath = $this->uploadImage($_FILES['image']);
                    $this->debugLog('Upload ảnh thành công', ['image_path' => $imagePath]);
                } catch (Exception $e) {
                    http_response_code(400);
                    $this->debugLog('Lỗi upload ảnh', ['error' => $e->getMessage()]);
                    echo json_encode(['message' => $e->getMessage()]);
                    return;
                }
            } else {
                $this->debugLog('Không có ảnh được upload', ['file_error' => $_FILES['image']['error'] ?? 'No file']);
            }

            $this->debugLog('Gọi addProduct', [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'category_id' => $category_id,
                'imagePath' => $imagePath
            ]);
            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $imagePath);

            if ($result === true) {
                http_response_code(201);
                $this->debugLog('Thêm sản phẩm thành công');
                echo json_encode(['message' => 'Product created successfully']);
            } else {
                http_response_code(400);
                $this->debugLog('Thêm sản phẩm thất bại', ['result' => $result]);
                echo json_encode(['message' => 'Failed to save product']);
            }
        } else {
            http_response_code(405);
            $this->debugLog('Phương thức không được phép', ['method' => $_SERVER['REQUEST_METHOD']]);
            echo json_encode(['message' => 'Method not allowed']);
        }
    }

    public function update($id)
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $existing_image = $_POST['existing_image'] ?? '';
            $image = $existing_image; // Mặc định giữ ảnh cũ

            // Validate dữ liệu
            if (empty($name) || strlen($name) < 3 || strlen($name) > 100) {
                http_response_code(400);
                echo json_encode(['message' => 'Tên sản phẩm phải từ 3 đến 100 ký tự']);
                return;
            }
            if (empty($description) || strlen($description) < 10 || strlen($description) > 500) {
                http_response_code(400);
                echo json_encode(['message' => 'Mô tả sản phẩm phải từ 10 đến 500 ký tự']);
                return;
            }
            if (!is_numeric($price) || $price <= 0) {
                http_response_code(400);
                echo json_encode(['message' => 'Giá sản phẩm phải là một số dương']);
                return;
            }
            if (empty($category_id) || !ctype_digit((string)$category_id)) {
                http_response_code(400);
                echo json_encode(['message' => 'Danh mục sản phẩm không hợp lệ']);
                return;
            }

            // Xử lý ảnh mới nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    http_response_code(400);
                    echo json_encode(['message' => $e->getMessage()]);
                    return;
                }
            }

            $success = $this->productModel->updateProduct($id, $name, $description, $price, $image, $category_id);

            if ($success) {
                http_response_code(200);
                echo json_encode(['message' => 'Product updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Cập nhật thất bại']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
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
            echo json_encode(['message' => 'Bạn không có quyền xoá sản phẩm']);
            return;
        }

        header('Content-Type: application/json');
        if ($this->productModel->isProductInOrders($id)) {
            echo json_encode(['message' => 'Không thể xoá sản phẩm đã có đơn hàng']);
            return;
        }
        $result = $this->productModel->deleteProduct($id);
        if ($result) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product deletion failed']);
        }
    }

    private function uploadImage($file)
    {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $fileName = uniqid() . "_" . basename($file["name"]);
        $target_file = $target_dir . $fileName;

        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Định dạng ảnh không hợp lệ.");
        }

        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Tải ảnh lên thất bại.");
        }

        return $target_file;
    }
}