<?php
declare(strict_types=1);

class ContactMessage extends Model
{
    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO mesaje_contact (name, email, phone, message) VALUES (:name, :email, :phone, :message)"
        );
        $stmt->execute($data);
    }
}
