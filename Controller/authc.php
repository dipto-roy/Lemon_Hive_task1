<?php
namespace LH\Controllers;

require_once __DIR__ . '/../Model/auth.php';

use LH\Models\Auth;

class AuthController {
    private Auth $authModel;

    public function __construct() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->authModel = new Auth();
    }

    public function showLogin(array $data = []) {
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: ../view/admin/dashbord.php');
            exit;
        }
        extract($data);
        require __DIR__ . '/../view/login_page.php';
    }

    public function login(array $postData) {
        $username = $postData['username'] ?? '';
        $password = $postData['password'] ?? '';

        if ($this->authModel->checkCredentials($username, $password)) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: ../view/admin/dashbord.php');
            exit;
        } else {
            $error = "Invalid username or password";
            $this->showLogin(compact('error'));
        }
    }

    public static function checkAuth() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: ../public/login.php');
            exit;
        }
    }
}
