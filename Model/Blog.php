<?php
namespace LH\Model;
require_once __DIR__ . '/database.php';  // এখানে path দেখে ঠিক করবেন


use PDO;
use LH\Database;

class Blog {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createPost(string $title, string $description, string $image): bool {
        $stmt = $this->db->prepare("INSERT INTO blogs (title, description, image) VALUES (:title, :description, :image)");
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':image' => $image
        ]);
    }
    public function getAllPosts(int $limit, int $offset): array {
    $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function getTotalCount(): int {
    return (int) $this->db->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
}
// Model/Blog.php
public function getAllPostsNoPagination(): array {
    $stmt = $this->db->query("SELECT * FROM blogs ORDER BY created_at DESC");
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


    // অন্যান্য মেথড (যেমন getAllPosts, getPostById) আপনার প্রয়োজনে যোগ করতে পারেন
}
