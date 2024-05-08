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
        $this->db->query("SELECT * FROM cart JOIN items ON items.id = cart.product_id JOIN images ON items.id = images.item_id JOIN users ON users.id = items.seller_id WHERE cart.user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        $a = $this->db->resultSet();
        return $a;
    }

    public function addToCart($data): bool
    {
        try{
        $this->db->query("INSERT OR IGNORE INTO cart ('user_id', 'product_id') VALUES (:user_id, :product_id)");
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return ($this->db->execute());}
        catch(Exception $e){
            throw($e);
        }
    }

    public function deleteItem($id, $user)
    {
        $this->db->query("DELETE FROM cart WHERE id = ? and user_id = ?");
        if ($this->db->execute(array($id, $usr))) return true;
        return false;
    }
}

?>


