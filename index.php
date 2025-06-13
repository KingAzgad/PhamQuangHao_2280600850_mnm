<?php
session_start();

require_once 'app/models/ProductModel.php';
require_once 'app/helpers/SessionHelper.php';
require_once 'app/controllers/ProductApiController.php';
require_once 'app/controllers/CategoryApiController.php';
require_once 'app/controllers/OrdersController.php';

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// ==== API Routing ====
if (strtolower($url[0]) === 'api' && isset($url[1])) {
    $apiControllerName = ucfirst($url[1]) . 'ApiController';

    if (file_exists('app/controllers/' . $apiControllerName . '.php')) {
        require_once 'app/controllers/' . $apiControllerName . '.php';
        $controller = new $apiControllerName();

        $method = $_SERVER['REQUEST_METHOD'];
        $id = $url[2] ?? null;

        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = $id ? 'update' : 'store';
                break;
            case 'DELETE':
                $action = $id ? 'destroy' : null;
                break;
            case 'PUT':
                $action = $id ? 'update' : null;
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }

        if (!$action || !method_exists($controller, $action)) {
            http_response_code(404);
            echo json_encode(['message' => 'API action not found']);
            exit;
        }

        if ($id) {
            call_user_func_array([$controller, $action], [$id]);
        } else {
            call_user_func([$controller, $action]);
        }

        exit;
    } else {
        http_response_code(404);
        echo json_encode(['message' => "API Controller '$apiControllerName' not found"]);
        exit;
    }
}

// ==== Web Controller Routing ====
$controllerName = isset($url[0]) && $url[0] !== ''
    ? ucfirst($url[0]) . 'Controller'
    : 'ProductController';

$action = isset($url[1]) && $url[1] !== ''
    ? $url[1]
    : 'index';

$controllerPath = 'app/controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controllerName();
} else {
    die("Web Controller '$controllerName' not found");
}

if (method_exists($controller, $action)) {
    call_user_func_array([$controller, $action], array_slice($url, 2));
} else {
    die("Web Action '$action' not found in $controllerName");
}
