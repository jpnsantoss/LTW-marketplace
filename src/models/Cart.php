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

    public function getItem($item_id, $user_id){
        $item_id = (int) $item_id;
        $this->db->query("SELECT * FROM cart JOIN items ON items.id = cart.product_id JOIN images ON items.id = images.item_id JOIN users ON users.id = items.seller_id WHERE cart.product_id = :item_id AND cart.user_id = :user_id");
        $this->db->bind(':item_id', $item_id);
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

    public function setSold($item_id, $buyer_id, $seller_id)
    {   
        
        $this->db->query("INSERT INTO transactions (`seller_id`, `buyer_id`, `product_id`) VALUES (:seller_id, :buyer_id, :product_id) ");
        $this->db->bind(':product_id', $item_id);
        $this->db->bind(':buyer_id', $_SESSION['user']['id']);
        $this->db->bind(':seller_id', $seller_id);
        $this->db->execute();
        
        //$this->db->query("SELECT sold_at from items WHERE items.id = :id");
        $this->db->query("UPDATE items SET sold_at= CURRENT_TIMESTAMP WHERE items.id = :id AND sold_at IS NULL");
        $this->db->bind(':id', $item_id);
        return $this->db->execute();
    }
}
