<?php
namespace LH\Model;

use PDO;
use LH\Database;

class Settings {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getPostsPerPage(): int {
        $stmt = $this->db->query("SELECT posts_per_page FROM settings LIMIT 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['posts_per_page'] : 5; // ডিফল্ট 5
    }

    public function updatePostsPerPage(int $count): bool {
        // যদি রো না থাকে, ইনসার্ট, না হলে আপডেট
        $stmt = $this->db->query("SELECT COUNT(*) FROM settings");
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            $update = $this->db->prepare("UPDATE settings SET posts_per_page = :count WHERE id = 1");
            return $update->execute([':count' => $count]);
        } else {
            $insert = $this->db->prepare("INSERT INTO settings (posts_per_page) VALUES (:count)");
            return $insert->execute([':count' => $count]);
        }
    }
}
