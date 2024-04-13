<?php

namespace Models;

use \Models\Database;

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCategories(): array
    {
        $this->db->query("SELECT * FROM categories");
        return $this->db->resultSet();
    }

    public function createCategory($name): bool
    {
        $this->db->query("INSERT INTO categories (`name`) VALUES (:name)");

        $this->db->bind(':name', $name);
        if ($this->db->execute()) return true;
        return false;
    }

    public function deleteCategory($id)
    {
        $this->db->query("DELETE FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) return true;
        return false;
    }
}
