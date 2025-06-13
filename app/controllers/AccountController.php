<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/utils/JWTHandler.php');

class AccountController
{
    private $accountModel;
    private $db;
    private $jwtHandler;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }

    public function register()
    {
        include_once 'app/views/account/register.php';
    }

    public function login()
    {
        include_once 'app/views/account/login.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $errors = [];

            if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";
            if (!in_array($role, ['admin', 'user'])) $role = 'user';

            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
                return;
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $result = $this->accountModel->save($username, $fullName, $hash, $role);
                if ($result) {
                    //nếu đã đăng nhập và role admin thì về trang danh sách tài khoản
                    session_start();
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                        header('Location: /webbanhang/account/list');
                        exit;
                    } else {
                        // nếu không phải admin thì về trang đăng nhập
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                        $_SESSION['user_id'] = $this->accountModel->getAccountByUsername($username)->id; // Lưu ID người dùng vào session
                        header('Location: /webbanhang/product');
                        exit;
                    }
                    header('Location: /webbanhang/account/login');
                    exit;
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /webbanhang/product');
        exit;
    }

    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ tài khoản và mật khẩu!";
                include_once 'app/views/account/login.php';
                return;
            }

            $account = $this->accountModel->getAccountByUsername($username);

            if ($account && password_verify($password, $account->password)) {
                session_start();
                $_SESSION['username'] = $account->username;
                $_SESSION['role'] = $account->role;
                $_SESSION['user_id'] = $account->id; // Lưu ID người dùng vào session
                header('Location: /webbanhang/product');
                exit;
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản!";
                include_once 'app/views/account/login.php';
                exit;
            }
        }
    }


    public function apiLogin()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(['message' => 'Vui lòng nhập đầy đủ thông tin']);
            return;
        }
        $user = $this->accountModel->getAccountByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            $payload = ['id' => $user->id, 'username' => $user->username, 'role' => $user->role];
            $token = $this->jwtHandler->encode($payload);
            echo json_encode(['token' => $token, 'user' => $payload]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Tài khoản hoặc mật khẩu không đúng']);
        }
    }

    public function saveSessionFromToken()
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['username']) && isset($data['role'])) {
            SessionHelper::start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['user_id'] = $data['id']; // Lưu ID người dùng nếu có

            echo json_encode(['message' => 'Session saved']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Missing username or role']);
        }
        file_put_contents('session_debug.txt', print_r($_SESSION, true));

    }

    private function isAdmin()
    {
        return SessionHelper::isAdmin();
    }

    public function list()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $users = $this->accountModel->getAllAccounts();
        include 'app/views/account/list.php';
    }

    public function delete($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if (is_numeric($id)) {
            $result = $this->accountModel->deleteAccount($id);
            if ($result) {
                header('Location: /webbanhang/account/list');
                exit;
            } else {
                echo "Xóa tài khoản thất bại!";
            }
        } else {
            echo "ID không hợp lệ";
        }
    }

    public function edit($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $user = $this->accountModel->getAccountById($id);
        if ($user) {
            include 'app/views/account/edit.php';
        } else {
            echo "Không tìm thấy tài khoản.";
        }
    }
    public function update()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $errors = [];

            if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
            if (!in_array($role, ['admin', 'user'])) $role = 'user';

            if ($this->accountModel->getAccountByUsername($username, $id)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }

            if (count($errors) > 0) {
                include 'app/views/account/edit.php';
                return;
            } else {
                $result = $this->accountModel->updateAccount($id, $username, $fullName, $role);
                if ($result) {
                    header('Location: /webbanhang/account/list');
                    exit;
                } else {
                    echo "Cập nhật tài khoản thất bại!";
                }
            }
        }
    }
}
