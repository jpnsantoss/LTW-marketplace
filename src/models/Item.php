<?php

namespace Models;

use \Models\Database;

class ItemModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getItems(): array
    {
        $this->db->query("SELECT * FROM items");
        return $this->db->resultSet();
    }

    public function createItem($userRequest, $image): bool
    {
        $this->db->query("INSERT INTO items (`brand`, `model`, `price`, `category_id`, `size_id`, `condition_id`, `seller_id`, `image_path`) VALUES (:brand, :model, :price, :category_id, :size_id, :condition_id, :seller_id, :image_path)");

        foreach ($userRequest as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        if ($this->db->execute()) return true;
        return false;
    }

    public function deleteItem($id)
    {
        $this->db->query("DELETE FROM items WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) return true;
        return false;
    }
}
