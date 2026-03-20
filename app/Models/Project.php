<?php
declare(strict_types=1);

class Project extends Model
{
    public function all(?string $type = null): array
    {
        if ($type) {
            $stmt = $this->db->prepare("SELECT * FROM proiecte WHERE project_type = :type ORDER BY created_at DESC");
            $stmt->execute(['type' => $type]);
            return $stmt->fetchAll();
        }
        return $this->db->query("SELECT * FROM proiecte ORDER BY created_at DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM proiecte WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
