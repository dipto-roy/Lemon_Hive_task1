<?php
require_once __DIR__ . '/../src/Core/Autoloader.php';

use LH\Controllers\AuthController;

AuthController::checkAuth();

// Admin dashboard code here
echo "Welcome to Admin Dashboard!";
