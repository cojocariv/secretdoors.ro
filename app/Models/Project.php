<?php
declare(strict_types=1);

class Project extends Model
{
    public function all(?string $type = null): array
    {
        if ($type) {
            $stmt = $this->db->prepare("SELECT * FROM proiecte WHERE project_type = :type ORDER BY created_at DESC");
            $stmt->execute(['type' => $type]);
            $rows = $stmt->fetchAll();
            usort($rows, static function (array $a, array $b): int {
                $ap = (int) ($a['position'] ?? 0);
                $bp = (int) ($b['position'] ?? 0);
                if ($ap === $bp) {
                    return (int) ($b['id'] ?? 0) <=> (int) ($a['id'] ?? 0);
                }
                return $ap <=> $bp;
            });
            return $rows;
        }
        $rows = $this->db->query("SELECT * FROM proiecte ORDER BY created_at DESC")->fetchAll();
        usort($rows, static function (array $a, array $b): int {
            $ap = (int) ($a['position'] ?? 0);
            $bp = (int) ($b['position'] ?? 0);
            if ($ap === $bp) {
                return (int) ($b['id'] ?? 0) <=> (int) ($a['id'] ?? 0);
            }
            return $ap <=> $bp;
        });
        return $rows;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM proiecte WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
