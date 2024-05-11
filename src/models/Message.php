<?php

namespace Models;

use \Models\Database;

class MessageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMessages($userId, $productId): array
    {
        $this->db->query("
        SELECT messages.*, 
               buyer.username as buyer_name, 
               seller.username as seller_name
        FROM messages 
        JOIN users as buyer ON messages.buyer_id = buyer.id
        JOIN items ON messages.product_id = items.id
        JOIN users as seller ON items.seller_id = seller.id
        WHERE messages.buyer_id = :userId AND messages.product_id = :productId
    ");

        $this->db->bind(':userId', $userId);
        $this->db->bind(':productId', $productId);

        $messages = $this->db->resultSet();

        return $messages;
    }

    public function sendMessage($req)
    {
        $userId = $req['user_id'];
        $productId = $req['product_id'];
        $content = $req['message'];

        $this->db->query("INSERT INTO messages (`buyer_id`, `product_id`, `content`) VALUES (:buyer_id, :product_id, :content)");
        $this->db->bind(':buyer_id', $userId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':content', $content);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }
}
