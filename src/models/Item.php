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
        $this->db->query("
    SELECT items.*, 
           categories.name as category_name, 
           sizes.name as size_name, 
           conditions.name as condition_name, 
           users.username as seller_name,
           GROUP_CONCAT(images.url) as image_urls
    FROM items 
    LEFT JOIN categories ON items.category_id = categories.id 
    LEFT JOIN sizes ON items.size_id = sizes.id 
    LEFT JOIN conditions ON items.condition_id = conditions.id 
    LEFT JOIN sellers ON items.seller_id = sellers.user_id
    LEFT JOIN users ON sellers.user_id = users.id
    LEFT JOIN images ON items.id = images.item_id
    GROUP BY items.id
    ");
        $items = $this->db->resultSet();

        foreach ($items as $item) {
            $item->image_urls = explode(',', $item->image_urls);
        }

        return $items;
    }

    public function getItem($id)
    {
        $this->db->query("
    SELECT items.*, 
           categories.name as category_name, 
           sizes.name as size_name, 
           conditions.name as condition_name, 
           users.username as seller_name,
           GROUP_CONCAT(images.url) as image_urls
    FROM items
    LEFT JOIN categories ON items.category_id = categories.id
    LEFT JOIN sizes ON items.size_id = sizes.id
    LEFT JOIN conditions ON items.condition_id = conditions.id
    LEFT JOIN sellers ON items.seller_id = sellers.user_id
    LEFT JOIN users ON sellers.user_id = users.id
    LEFT JOIN images ON items.id = images.item_id
    WHERE items.id = :id
    GROUP BY items.id
    ");
        $this->db->bind(':id', $id);
        $item = $this->db->single();

        $item->image_urls = explode(',', $item->image_urls);

        return $item;
    }


    public function createItem($userRequest)
    {
        $this->db->query("INSERT INTO items (`brand`, `model`, `price`, `category_id`, `size_id`, `condition_id`, `seller_id`) VALUES (:brand, :model, :price, :category_id, :size_id, :condition_id, :seller_id)");

        foreach ($userRequest as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
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
