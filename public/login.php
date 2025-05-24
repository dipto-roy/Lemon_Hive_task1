<?php
require_once __DIR__ . '/../Controller/authc.php';

use LH\Controllers\AuthController;

$controller = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login($_POST);
} else {
    $controller->showLogin();
}
?>