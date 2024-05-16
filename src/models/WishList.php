<?php

namespace Models;

use \Models\Database;

//é relativo a um user
class WishListModel{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getWishList($user_id)
    {
        $this->db->query("SELECT items.*, images.*, users.*
        FROM items
        JOIN wishlist ON items.id = wishlist.product_id
        JOIN (
            SELECT item_id, MIN(images.id) AS image_id
            FROM images
            GROUP BY item_id
        ) AS min_images ON items.id = min_images.item_id
        JOIN images ON items.id = images.item_id AND images.id = min_images.image_id
        JOIN users ON users.id = items.seller_id
        WHERE wishlist.user_id = :user_id;
        ");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function addToWishList($data)
    {
        $this->db->query("INSERT OR IGNORE INTO wishlist('user_id', 'product_id') VALUES(:user_id, :product_id)");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return ($this->db->execute());
    }
    
    public function deleteItem($data)
    {
        $this->db->query("DELETE FROM wishlist WHERE user_id = :user_id and product_id = :product_id");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return ($this->db->execute());
    }
}