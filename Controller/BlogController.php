<?php
namespace LH\Controller;

require_once __DIR__ . '/../Model/Blog.php';

use LH\Model\Blog;

class BlogController {
    private Blog $blogModel;

    public function __construct() {
        $this->blogModel = new Blog();
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    // Create post ফর্ম দেখানো
    public function showCreateForm(array $errors = [], array $postData = []): void {
        require __DIR__ . '/../view/admin/create_blog.php';
    }

    // Create post সাবমিট হ্যান্ডলার
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

    // Pagination সহ পোস্টগুলো ফেরত দিবে
    public function listPosts(int $page, int $postsPerPage): array {
        $offset = ($page - 1) * $postsPerPage;
        return $this->blogModel->getPosts($postsPerPage, $offset);
    }

    // মোট পেজ সংখ্যা হিসাব করবে
    public function getTotalPages(int $postsPerPage): int {
        $totalPosts = $this->blogModel->getTotalPostsCount();
        return (int) ceil($totalPosts / $postsPerPage);
    }

    // একটি পোস্টের বিস্তারিত
    public function getPost(int $id): ?array {
        return $this->blogModel->getPostById($id);
    }
    public function getAllPosts(): array {
    return $this->blogModel->getAllPostsNoPagination();
}

}
