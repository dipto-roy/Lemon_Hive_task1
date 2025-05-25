<?php
require_once __DIR__ . '/../Controller/SettingsController.php';

use LH\Controller\SettingsController;

$controller = new SettingsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->updateSettings($_POST);
} else {
    $controller->showSettings();
}
?>