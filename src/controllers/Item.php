<?php

namespace Controllers;

use Models\ItemModel;

class Item
{
    private $size;
    public function __construct()
    {
        $this->size = new ItemModel;
    }

    public function create()
    {
        if (!isLoggedIn() || !isSeller()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemRequest = [
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category'],
                'condition_id' => $_POST['condition'],
                'size_id' => $_POST['size'],
                'seller_id' => $_SESSION['user']['id']
            ];

            print_r($itemRequest);
            if ($this->size->createItem($itemRequest))
                header('location: ' . URLROOT . '/admin', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        }
    }

    public function delete($params)
    {
        if (!isLoggedIn() || !isAdmin()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        $id = $params['id'];
        $this->size->deleteItem($id);
        header('location: ' . URLROOT . '/admin', true, 303);
    }
}
