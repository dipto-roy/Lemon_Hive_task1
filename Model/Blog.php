<?php
namespace LH\Model;
require_once __DIR__ . '/database.php';

use PDO;
use LH\Database;

class Blog {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllPostsNoPagination(): array {
        $stmt = $this->db->query("SELECT * FROM blogs ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPosts(int $limit, int $offset): array {
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPostsCount(): int {
        return (int) $this->db->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
    }

    public function getPostById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post ?: null;
    }

    public function createPost(string $title, string $description, string $image): bool {
        $stmt = $this->db->prepare("INSERT INTO blogs (title, description, image) VALUES (:title, :description, :image)");
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':image' => $image
        ]);
    }
     public function updatePost(int $id, string $title, string $description, ?string $image = null): bool {
        if ($image) {
            $sql = "UPDATE blogs SET title = :title, description = :description, image = :image WHERE id = :id";
            $params = [':title' => $title, ':description' => $description, ':image' => $image, ':id' => $id];
        } else {
            $sql = "UPDATE blogs SET title = :title, description = :description WHERE id = :id";
            $params = [':title' => $title, ':description' => $description, ':id' => $id];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    public function deletePost(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM blogs WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

}
