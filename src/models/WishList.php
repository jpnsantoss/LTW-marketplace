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
        $this->db->query("SELECT * FROM items JOIN wishlist ON items.id = wishlist.product_id JOIN images ON items.id = images.item_id WHERE wishlist.user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        $a = $this->db->resultSet();
        return $a;
    }

    public function addToWishList($data)
    {
        $this->db->query("INSERT INTO wishlist('user_id', 'product_id') VALUES(:user_id, :product_id)");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return ($this->db->execute());
    }

    public function deleteItem($id, $user)
    {
        $this->db->query("DELETE FROM wishlist WHERE id = ? and user_id = ?");
        if ($this->db->execute(array($id, $usr))) return true;
        return false;
    }
}