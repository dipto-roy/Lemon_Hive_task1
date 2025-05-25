<?php
require_once __DIR__ . '/../Controller/BlogController.php';

use LH\Controller\BlogController;

$controller = new BlogController();

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteVars);
    $id = $deleteVars['id'] ?? null;

    if ($id !== null) {
        $controller->deletePost((int)$id);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing ID']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
}
