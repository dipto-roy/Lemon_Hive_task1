<?php
require_once __DIR__ . '/../Controller/BlogController.php';

use LH\Controller\BlogController;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$postsPerPage = 6;

$controller = new BlogController();
$posts = $controller->listPosts($page, $postsPerPage);
$totalPages = $controller->getTotalPages($postsPerPage);

require __DIR__ . '/../view/blog_list.php';
