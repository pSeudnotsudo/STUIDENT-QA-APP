<?php
require_once '../config/database.php';
require_once '../controllers/QuestionController.php';

$database = new Database();
$db = $database->getConnection();

$controller = new QuestionController($db);

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestMethod) {
    case 'GET':
        if ($uri === '/student-qa-app/src/public/') {
            $controller->read();
        } elseif (preg_match('/\/student-qa-app\/src\/public\/questions\/(\d+)/', $uri, $matches)) {
            $controller->show($matches[1]);
        } elseif ($uri === '/student-qa-app/src/public/create') {
            $controller->create();
        } elseif (preg_match('/\/student-qa-app\/src\/public\/edit\/(\d+)/', $uri, $matches)) {
            $controller->edit($matches[1]);
        }
        break;
    case 'POST':
        if ($uri === '/student-qa-app/src/public/create') {
            $controller->create();
        }
        break;
    case 'PUT':
        if (preg_match('/\/student-qa-app\/src\/public\/edit\/(\d+)/', $uri, $matches)) {
            $controller->update($matches[1]);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/student-qa-app\/src\/public\/questions\/(\d+)/', $uri, $matches)) {
            $controller->delete($matches[1]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
?>