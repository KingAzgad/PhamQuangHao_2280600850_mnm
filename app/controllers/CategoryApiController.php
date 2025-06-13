<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');
require_once('app/utils/JWTHandler.php');

class CategoryApiController
{
    private $categoryModel;
    private $db;
    private $jwtHandler;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
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
        header('Content-Type: application/json');
        $categories = $this->categoryModel->getCategories();
        echo json_encode($categories);
    }

    public function show($id)
    {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
            return;
        }
        header('Content-Type: application/json');
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            echo json_encode($category);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Danh mục không tồn tại']);
        }
    }

    public function store()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['name']) && !empty($data['name'])) {
                $name = htmlspecialchars(strip_tags($data['name']));
                $description = htmlspecialchars(strip_tags($data['description'] ?? ''));
                $result = $this->categoryModel->addCategory($name, $description);
                if ($result) {
                    http_response_code(201);
                    echo json_encode(['message' => 'Danh mục đã được tạo thành công']);
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'Lỗi khi tạo danh mục']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Tên danh mục không được để trống']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    public function update($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['name']) && !empty($data['name'])) {
                $name = htmlspecialchars(strip_tags($data['name']));
                $description = htmlspecialchars(strip_tags($data['description'] ?? ''));
                $result = $this->categoryModel->updateCategory($id, $name, $description);
                if ($result) {
                    echo json_encode(['message' => 'Danh mục đã được cập nhật thành công']);
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'Lỗi khi cập nhật danh mục']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Tên danh mục không được để trống']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    public function destroy($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $result = $this->categoryModel->deleteCategory($id);
            if ($result) {
                echo json_encode(['message' => 'Danh mục đã được xoá thành công']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Lỗi khi xoá danh mục']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }
}