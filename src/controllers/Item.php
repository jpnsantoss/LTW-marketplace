<?php

namespace Controllers;

use Models\ItemModel;

class Item
{
    private $item;
    public function __construct()
    {
        $this->item = new ItemModel;
    }

    public function index()
    {
        view('Home/index', [
        
            'items' => $this->item->getItems(),
            
        ]);
    }

    public  function details()
    {
       
            session_start();
            session_destroy();
            header('location: ' . URLROOT . '/details', true, 303);
        
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() || !isSeller()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
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
            if ($this->item->createItem($itemRequest))
                header('location: ' . URLROOT . '/admin', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }

    public function delete($params)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() || !isAdmin()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $id = $params['id'];
            $this->item->deleteItem($id);
            header('location: ' . URLROOT . '/admin', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }
}