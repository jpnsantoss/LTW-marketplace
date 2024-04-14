<?php

namespace Models;

use \Models\Database;

class SizeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSizes(): array
    {
        $this->db->query("SELECT * FROM sizes");
        return $this->db->resultSet();
    }

    public function createSize($name): bool
    {
        $this->db->query("INSERT INTO sizes (`name`) VALUES (:name)");

        $this->db->bind(':name', $name);
        if ($this->db->execute()) return true;
        return false;
    }

    public function deleteSize($id)
    {
        $this->db->query("DELETE FROM sizes WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) return true;
        return false;
    }
}
