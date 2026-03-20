<?php
declare(strict_types=1);

class Category extends Model
{
    public function all(): array
    {
        return $this->db->query("SELECT * FROM categorii ORDER BY name ASC")->fetchAll();
    }
}
