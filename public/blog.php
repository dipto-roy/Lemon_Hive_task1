<?php
require_once __DIR__ . '/../Controller/BlogController.php';

use LH\Controller\BlogController;

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$controller = new BlogController();
$post = $controller->getPost($id);

if (!$post) {
    http_response_code(404);
    echo "Post not found";
    exit;
}

require __DIR__ . '/../view/blog_single.php';
