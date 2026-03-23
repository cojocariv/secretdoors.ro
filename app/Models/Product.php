<?php
declare(strict_types=1);

class Product extends Model
{
    public function all(array $filters = []): array
    {
        $sql = "SELECT p.*, c.name AS category_name FROM produse p JOIN categorii c ON c.id = p.categorie_id WHERE 1=1";
        $params = [];
        if (!empty($filters['categorie'])) {
            $sql .= " AND c.slug = :categorie";
            $params['categorie'] = $filters['categorie'];
        }
        if (!empty($filters['finish'])) {
            $sql .= " AND p.finish = :finish";
            $params['finish'] = $filters['finish'];
        }
        if (!empty($filters['max_price'])) {
            $sql .= " AND p.price <= :max_price";
            $params['max_price'] = (float) $filters['max_price'];
        }
        $sql .= " ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
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

    public function featured(int $limit = 3): array
    {
        $stmt = $this->db->prepare("SELECT * FROM produse ORDER BY id DESC LIMIT :lim");
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        usort($rows, static function (array $a, array $b): int {
            $ap = (int) ($a['position'] ?? 0);
            $bp = (int) ($b['position'] ?? 0);
            if ($ap === $bp) {
                return (int) ($b['id'] ?? 0) <=> (int) ($a['id'] ?? 0);
            }
            return $ap <=> $bp;
        });
        return array_slice($rows, 0, $limit);
    }

    public function featuredForHome(int $limit = 4): array
    {
        $stmt = $this->db->prepare("SELECT * FROM produse WHERE featured_home = 1 ORDER BY featured_home_position ASC, id DESC LIMIT :lim");
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM produse WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
