<?php
namespace LH\Controller;

require_once __DIR__ . '/../Model/Settings.php';

use LH\Model\Settings;

class SettingsController {
    private Settings $settingsModel;

    public function __construct() {
        $this->settingsModel = new Settings();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function showSettings(array $errors = [], array $data = []): void {
        $postsPerPage = $this->settingsModel->getPostsPerPage();
        require __DIR__ . '/../view/admin/settings.php';
    }

    public function updateSettings(array $postData): void {
        $errors = [];
        $postsPerPage = (int)($postData['posts_per_page'] ?? 0);

        if ($postsPerPage <= 0) {
            $errors[] = "Please enter a valid positive number for posts per page.";
        }

        if (!empty($errors)) {
            $this->showSettings($errors, $postData);
            return;
        }

        if ($this->settingsModel->updatePostsPerPage($postsPerPage)) {
            header('Location: settings.php?success=1');
            exit;
        } else {
            $errors[] = "Failed to update settings.";
            $this->showSettings($errors, $postData);
        }
    }
}
