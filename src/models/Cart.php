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
    public function getCart($user_id){
        $this->db->query("SELECT * FROM cart JOIN items ON items.id = cart.product_id JOIN images ON items.id = images.item_id JOIN users ON users.id = items.seller_id WHERE cart.user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function addToCart($data): bool
    {
        $this->db->query("INSERT OR IGNORE INTO cart ('user_id', 'product_id') VALUES (:user_id, :product_id)");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return ($this->db->execute());
    }
    public function deleteItem($data)
    {
        $this->db->query("DELETE FROM cart WHERE user_id = :user_id and product_id = :product_id");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return ($this->db->execute());
    }
}
