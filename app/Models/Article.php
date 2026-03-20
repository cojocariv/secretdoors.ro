<?php
declare(strict_types=1);

class Article extends Model
{
    public function all(): array
    {
        return $this->db->query("SELECT * FROM articole ORDER BY created_at DESC")->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM articole WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch() ?: null;
    }
}
