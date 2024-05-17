<?php

namespace Controllers;

use \Models\CategoryModel;
use \Models\SizeModel;
use \Models\ItemModel;
use \Models\ConditionModel;
use \Models\ImageModel;
use \Models\UserModel;

class Home
{
    private $category;
    private $size;
    private $item;
    private $condition;
    private $image;
    private $user;

    public function __construct()
    {
        $this->category = new CategoryModel;
        $this->size = new SizeModel;
        $this->item = new ItemModel;
        $this->condition = new ConditionModel;
        $this->image = new ImageModel;
        $this->user = new UserModel;
    }

    public function index()
    {
        $filters = [
            'search' => $_GET['search'] ?? null,
            'category_id' => $_GET['category_id'] ?? null,
            'size_id' => $_GET['size_id'] ?? null,
            'condition_id' => $_GET['condition_id'] ?? null,
        ];

        

        // Handle price filter separately
        if (isset($_GET['price_from'])) {
            $filters['price'] = [$_GET['price_from'], $_GET['price_to'] ?? PHP_INT_MAX];
        } elseif (isset($_GET['price_to'])) {
            $filters['price'] = [0, $_GET['price_to']];
        }

        // Remove null filters
        $filters = array_filter($filters, function ($value) {
            return $value !== null;
        });

        if (isLoggedIn()) {
            view('Home/index', [
                'items' => $this->item->getItems($filters),
                'categories' => $this->category->getCategories(),
                'sizes' => $this->size->getSizes(),
                'conditions' => $this->condition->getConditions(),
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }

    public function preferences()
    {
        session_start();
        $preferences = [
            'category_id' => $_SESSION['user']['category_id'],
            'size_id' => $_SESSION['user']['size_id'] ,
            'condition_id' => $_SESSION['user']['condition_id'] ,
        ];

        // Remove null filters
        $preferences = array_filter($preferences, function ($value) {
            return $value !== null;
        });

        if (isLoggedIn()) {
            view('Home/index', [
                'items' => $this->item->getItemsPreferences($preferences),
                'categories' => $this->category->getCategories(),
                'sizes' => $this->size->getSizes(),
                'conditions' => $this->condition->getConditions(),
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }

    

    public function profile()
    {
        if (isLoggedIn()) {
            view('Profile/index', [
                'items' => $this->item->getItems(),
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }


    public function details($id)
    {
        $itemId = intval($id['id']);

        $items = $this->item->getItems();
        foreach ($items as $i) {

            if ($i->id == $itemId) {
                view('ProductDetails/index', [
                    'item' => $i
                ]);

                break;
            }
        }


        /* if (isset($item)) {
            // Se o item foi encontrado, passa-o para a view
            view('ProductDetails/index', [
                'item' => $item
            ]);
        } else {
            // Se o item não foi encontrado, exibe uma mensagem de erro
            echo "Item não encontrado";
        }*/
    }
    
}
