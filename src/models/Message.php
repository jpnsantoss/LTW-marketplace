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


    public function findChatByBuyer($buyerId, $productId)
    {
        $this->db->query("SELECT * FROM chat WHERE buyer_id = :buyer_id AND product_id = :product_id AND seller_id = (SELECT seller_id FROM items WHERE id = :item_id) LIMIT 1");
        $this->db->bind(':buyer_id', $buyerId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':item_id', $productId);
        $chat = $this->db->single();

        return $chat;
    }
    public function getNewMessages($chatId, $lastTimestamp)
{
    // Fetch new messages
    $this->db->query('SELECT * FROM messages WHERE chat_id = :chat_id AND created_at > :created_at ORDER BY created_at ASC');
    $this->db->bind(':chat_id', $chatId);
    $this->db->bind(':created_at', $lastTimestamp);
    $newMessages = $this->db->resultSet();

    $latestTimestamp = $lastTimestamp;
    if (!empty($newMessages)) {
        $latestTimestamp = end($newMessages)->created_at;
    }

    return [
        'messages' => $newMessages,
        'latest_timestamp' => $latestTimestamp
    ];
}

    public function createChat($buyerId, $productId) {
        $this->db->query("INSERT INTO chat (buyer_id, product_id, seller_id) SELECT :buyer_id, :product_id, seller_id FROM items WHERE id = :item_id");

        $this->db->bind(':buyer_id', $buyerId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':item_id', $productId);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }



    public function getChatsAsSeller($sellerId)
    {
        $this->db->query("SELECT chat.*, items.brand, items.model, users.username as buyer_username FROM chat 
                          JOIN items ON chat.product_id = items.id 
                          JOIN users ON chat.buyer_id = users.id 
                          WHERE chat.seller_id = :seller_id");

        $this->db->bind(':seller_id', $sellerId);

        $chats = $this->db->resultSet();

        return $chats;
    }

    public function getChatsAsBuyer($buyerId)
    {
        $this->db->query("SELECT chat.*, items.brand, items.model, users.username as seller_username FROM chat 
                          JOIN items ON chat.product_id = items.id 
                          JOIN users ON chat.seller_id = users.id 
                          WHERE chat.buyer_id = :buyer_id");

        $this->db->bind(':buyer_id', $buyerId);

        $chats = $this->db->resultSet();

        return $chats;
    }




    public function getChatById($chatId)
    {
        $this->db->query("
        SELECT chat.*, 
               buyer.username as buyer_username, 
               buyer.full_name as buyer_full_name, 
               seller.username as seller_username, 
               seller.full_name as seller_full_name, 
               items.category_id, items.size_id, items.condition_id, items.price, items.brand, items.model, items.created_at, items.sold_at 
        FROM chat 
        LEFT JOIN users as buyer ON chat.buyer_id = buyer.id 
        LEFT JOIN users as seller ON chat.seller_id = seller.id 
        LEFT JOIN items ON chat.product_id = items.id 
        WHERE chat.id = :chat_id
    ");

        $this->db->bind(':chat_id', $chatId);

        $chat = $this->db->single();

        return $chat;
    }


    public function getMessages($chatId): array
    {
        $this->db->query("SELECT * FROM messages WHERE chat_id = :chat_id");

        $this->db->bind(':chat_id', $chatId);

        $messages = $this->db->resultSet();

        return $messages;
    }

    public function findChat($buyerId, $sellerId, $productId)
    {
        $this->db->query("SELECT * FROM chat WHERE buyer_id = :buyer_id AND seller_id = :seller_id AND product_id = :product_id");

        $this->db->bind(':buyer_id', $buyerId);
        $this->db->bind(':seller_id', $sellerId);
        $this->db->bind(':product_id', $productId);

        $chat = $this->db->single();

        return $chat;
    }

    public function sendMessage($req)
    {
        $this->db->query("INSERT INTO messages (chat_id, sender_id, content) VALUES (:chat_id, :sender_id, :content)");

        $this->db->bind(':chat_id', $req['chat_id']);
        $this->db->bind(':sender_id', $req['sender_id']);
        $this->db->bind(':content', $req['content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
