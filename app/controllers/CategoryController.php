<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');
class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

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
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    public function show($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if (!is_numeric($id)) {
            echo "ID không hợp lệ";
            return;
        }
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/show.php';
        } else {
            echo "Không thể tìm thấy danh mục";
        }
    }
    public function add()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        include_once 'app/views/category/add.php';
    }
    public function save()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $errors = [];

            if (empty($name)) {
                $errors['name'] = "Vui lòng nhập tên danh mục!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/category/add.php';
                return;
            } else {
                $result = $this->categoryModel->addCategory($name, $description);
                if ($result) {
                    header('Location: /webbanhang/category');
                    exit;
                }
            }
        }
    }

    public function edit($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Không thể tìm thấy danh mục";
        }
    }

    public function update()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $errors = [];

            if (empty($name)) {
                $errors['name'] = "Vui lòng nhập tên danh mục!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/category/edit.php';
                return;
            } else {
                $result = $this->categoryModel->updateCategory($id, $name, $description);
                if ($result) {
                    header('Location: /webbanhang/category');
                    exit;
                }
            }
        }
    }

    public function delete($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            echo "Không thể tìm thấy danh mục";
            return;
        }
        // Kiểm tra xem danh mục có sản phẩm nào không
        $products = $this->categoryModel->getProductsByCategoryId($id);
        if (!empty($products)) {
            echo "Không thể xóa danh mục này vì nó có sản phẩm liên quan.";
            return;
        }
        // Nếu không có sản phẩm nào, tiến hành xóa danh mục
        $result = $this->categoryModel->deleteCategory($id);
        if ($result) {
            header('Location: /webbanhang/category');
            exit;
        } else {
            echo "Không thể xóa danh mục";
        }
    }
}
