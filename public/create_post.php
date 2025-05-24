<?php
require_once __DIR__ . '/../Controller/BlogController.php';

use LH\Controller\BlogController;

$controller = new BlogController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createPost($_POST, $_FILES);
} else {
    $controller->showCreateForm();
}
?>