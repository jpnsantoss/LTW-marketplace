<?php

namespace Controllers\Api;

use Models\ItemModel;

class Items
{
    private $item;

    public function __construct()
    {
        $this->item = new ItemModel();
    }

    public function getItems()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        // Get the input data from the JSON request body
        $input = json_decode(file_get_contents('php://input'), true);

        $filters = [
            'search' => $input['search'] ?? null,
            'category_id' => $input['category_id'] ?? null,
            'size_id' => $input['size_id'] ?? null,
            'condition_id' => $input['condition_id'] ?? null,
        ];

        // Handle price filter separately
        if (isset($input['price_from'])) {
            $filters['price'] = [$input['price_from'], $input['price_to'] ?? PHP_INT_MAX];
        } elseif (isset($input['price_to'])) {
            $filters['price'] = [0, $input['price_to']];
        }

        // Remove null filters
        $filters = array_filter($filters, function ($value) {
            return $value !== null;
        });

        $items = sanitize($this->item->getItems($filters));

        // Return the items as a JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'items' => $items,
        ]);
    }

    public function getItem($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        $item = $this->item->getItem($id);

        // Return the item as a JSON response
        header('Content-Type: application/json');
        echo json_encode($item);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }

        // Get the input data from the JSON request body
        $input = json_decode(file_get_contents('php://input'), true);

        $itemRequest = [
            'brand' => $input['brand'],
            'model' => $input['model'],
            'price' => $input['price'],
            'category_id' => $input['category'],
            'condition_id' => $input['condition'],
            'size_id' => $input['size'],
            'seller_id' => $input['seller_id']
        ];

        $item_id = $this->item->createItem($itemRequest);

        if ($item_id !== false) {
            // Return the item ID as a JSON response
            header('Content-Type: application/json');
            echo json_encode(['item_id' => $item_id]);
        } else {
            // If something went wrong, return a 500 Internal Server Error status code
            http_response_code(500);
            echo json_encode(['message' => 'Something went wrong']);
        }
    }

    public function delete($params)
    {
        $id = $params['id'];
        $this->item->deleteItem($id);

        // Return a success message as a JSON response
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Item deleted successfully']);
    }
}
