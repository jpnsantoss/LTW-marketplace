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
    public function getWishList($user): array
    {
        $stmt = $this->db->prepare("SELECT * FROM items JOIN wishlist ON items.item_id = wishlist.product_id WHERE wishlist.user_id = ?");
        $stmt->execute([$user]);
        return $stmt->resultSet();
    }

    public function addToWishList($data): bool
    {
        $this->db->query("INSERT INTO wishlist (`user_id`, `product_id`,) VALUES (:id, :user_id, :product_id,)");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        if ($this->db->execute()) return true;
        return false;
    }

    public function deleteItem($id, $user)
    {
        $this->db->query("DELETE FROM wishlist WHERE id = ? and user_id = ?");
        if ($this->db->execute(array($id, $usr))) return true;
        return false;
    }
}