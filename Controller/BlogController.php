<?php
namespace LH\Controller;

require_once __DIR__ . '/../Model/Blog.php';
require_once __DIR__ . '/../Model/Settings.php';

use LH\Model\Blog;
use LH\Model\Settings;

class BlogController {
    private Blog $blogModel;

    public function __construct() {
        $this->blogModel = new Blog();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function showCreateForm(array $errors = [], array $postData = []): void {
        require __DIR__ . '/../view/admin/create_blog.php';
    }

    public function createPost(array $postData, array $fileData): void {
        $title = trim($postData['title'] ?? '');
        $description = trim($postData['description'] ?? '');
        $errors = [];

        if ($title === '') {
            $errors[] = "Title is required.";
        }
        if ($description === '') {
            $errors[] = "Description is required.";
        }
        if (!isset($fileData['image']) || $fileData['image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Image upload failed.";
        } else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($fileData['image']['type'], $allowedTypes)) {
                $errors[] = "Only JPG, JPEG, PNG files are allowed.";
            }
        }

        if (!empty($errors)) {
            $this->showCreateForm($errors, $postData);
            return;
        }

        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $originalName = pathinfo($fileData['image']['name'], PATHINFO_FILENAME);
        $ext = pathinfo($fileData['image']['name'], PATHINFO_EXTENSION);
        $timestamp = date('YmdHis');
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '', $originalName) . "_{$timestamp}." . $ext;

        $destination = $uploadDir . $filename;

        if (!move_uploaded_file($fileData['image']['tmp_name'], $destination)) {
            $errors[] = "Failed to move uploaded file.";
            $this->showCreateForm($errors, $postData);
            return;
        }

        if ($this->blogModel->createPost($title, $description, $filename)) {
            header('Location: ../public/index.php');
            exit;
        } else {
            $errors[] = "Failed to save post to database.";
            $this->showCreateForm($errors, $postData);
        }
    }

    public function listPosts(int $page, ?int $postsPerPage = null): array {
        if ($postsPerPage === null) {
            $settingsModel = new Settings();
            $postsPerPage = $settingsModel->getPostsPerPage();
        }
        $offset = ($page - 1) * $postsPerPage;
        return $this->blogModel->getPosts($postsPerPage, $offset);
    }

    public function getTotalPages(?int $postsPerPage = null): int {
        if ($postsPerPage === null) {
            $settingsModel = new Settings();
            $postsPerPage = $settingsModel->getPostsPerPage();
        }
        $total = $this->blogModel->getTotalPostsCount();
        return (int) ceil($total / $postsPerPage);
    }

    public function getPost(int $id): ?array {
        return $this->blogModel->getPostById($id);
    }

    public function deletePost(int $id): void {
        if ($this->blogModel->deletePost($id)) {
            http_response_code(200);
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false]);
        }
    }
}
