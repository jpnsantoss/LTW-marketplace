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

    public function getProductsByUserId(int $userId): array
    {
        $this->db->query("
        SELECT items.*, 
               categories.name as category_name, 
               sizes.name as size_name, 
               conditions.name as condition_name, 
               GROUP_CONCAT(images.url) as image_urls
        FROM items 
        LEFT JOIN categories ON items.category_id = categories.id 
        LEFT JOIN sizes ON items.size_id = sizes.id 
        LEFT JOIN conditions ON items.condition_id = conditions.id 
        LEFT JOIN sellers ON items.seller_id = sellers.user_id
        LEFT JOIN users ON sellers.user_id = users.id
        LEFT JOIN images ON items.id = images.item_id
        WHERE seller_id = :userId
        GROUP BY items.id
    ");

        $this->db->bind(':userId', $userId);
        $products = $this->db->resultSet();

        foreach ($products as $product) {
            $product->image_urls = explode(',', $product->image_urls);
        }

        return $products;
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

    public function changePrice($productData)
    {


        // Monta os dados do produto
        $productId = $productData['item_id'];
        $newPrice = $productData['price'];

        // Atualiza o preço do produto no banco de dados
        $this->db->query('UPDATE items SET model = :price WHERE id = 16');
        //$this->db->bind(':item_id', $productData['item_id']);
        $this->db->bind(':price', $productData['price']);

        // Retorna true se a atualização foi bem-sucedida, false caso contrário
        return $this->db->execute();
    }


    public function changeEmail($email)
    {

        $this->db->query('UPDATE users SET email = :email WHERE id = :user_id');
        $this->db->bind(':user_id', $email['user_id']);
        $this->db->bind(':email', $email['email']);

        return $this->db->execute();
    }



    public function updateItem($itemData)
    {
        // Verifica se o usuário está logado
        if (!isLoggedIn()) {
            return false; // Ou você pode lançar uma exceção ou tratar de outra forma, dependendo do seu caso de uso
        }

        // Monta os dados do item
        $itemId = $itemData['item_id'];

        // Constrói a consulta SQL para atualizar os campos
        $sql = 'UPDATE items SET ';
        $params = [];
        foreach ($itemData as $key => $value) {
            // Ignora o campo 'item_id' na atualização
            if ($key !== 'item_id') {
                $sql .= "$key = :$key, ";
                $params[":$key"] = $value;
            }
        }
        // Remove a vírgula extra do final da string SQL
        $sql = rtrim($sql, ', ');
        // Adiciona a condição WHERE para identificar o item específico
        $sql .= ' WHERE id = :item_id';
        // Adiciona o ID do item ao array de parâmetros
        $params[':item_id'] = $itemId;

        // Executa a consulta preparada
        $this->db->query($sql);
        foreach ($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        // Retorna true se a atualização foi bem-sucedida, false caso contrário
        return $this->db->execute();
    }
}
