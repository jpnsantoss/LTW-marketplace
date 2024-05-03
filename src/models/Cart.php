<?php

namespace Models;

use \Models\Cart;
//é relativo a um user

class CartModel{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getCart($user_id)
    {
        $this->db->query("SELECT * FROM items JOIN cart ON items.id = cart.product_id WHERE cart.user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function addCart($data): bool
    {
        $this->db->query("INSERT INTO cart (`user_id`, `product_id`,) VALUES (:id, :user_id, :product_id,)");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        if ($this->db->execute()) return true;
        return false;
    }

    public function deleteItem($id, $user)
    {
        $this->db->query("DELETE FROM cart WHERE id = ? and user_id = ?");
        if ($this->db->execute(array($id, $usr))) return true;
        return false;
    }
}