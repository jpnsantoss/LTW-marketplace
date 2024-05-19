<?php

namespace Controllers;

use \Models\CategoryModel;
use \Models\SizeModel;
use \Models\ItemModel;
use \Models\ConditionModel;
use \stdClass; // Add this import statement

class Home
{
    private $category;
    private $size;
    private $item;
    private $condition;

    public function __construct()
    {
        $this->category = new CategoryModel;
        $this->size = new SizeModel;
        $this->item = new ItemModel;
        $this->condition = new ConditionModel;
    }

    public function index()
    {
        if (!isset($_GET['active'])) {
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
        } else if (isset($_GET['active']) && $_GET['active'] === 'true') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            };
            $filters = [
                'category_id' => $_SESSION['user']['category_id'],
                'size_id' => $_SESSION['user']['size_id'],
                'condition_id' => $_SESSION['user']['condition_id'],
            ];
        } else {
            $items = $this->item->getItems();

            view('Profile/index', [
                'items' => $items,
            ]);
        }

        // Remove null filters
        $filters = array_filter($filters, function ($value) {
            return $value !== null;
        });

        if (isLoggedIn()) {

            $items = $this->item->getItems($filters);
            $categories = sanitize($this->category->getCategories());
            $sizes = sanitize($this->size->getSizes());
            $conditions = sanitize($this->condition->getConditions());

            view('Home/index', [
                'items' => $items,
                'categories' => $categories,
                'sizes' => $sizes,
                'conditions' => $conditions,
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }

    public function preferences()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
        $preferences = [
            'category_id' => $_SESSION['user']['category_id'],
            'size_id' => $_SESSION['user']['size_id'],
            'condition_id' => $_SESSION['user']['condition_id'],
        ];

        // Remove null filters
        $preferences = array_filter($preferences, function ($value) {
            return $value !== null;
        });

        if (isLoggedIn()) {

            $items = sanitize($this->item->getItemsPreferences($preferences));
            $categories = sanitize($this->category->getCategories());
            $sizes = sanitize($this->size->getSizes());
            $conditions = sanitize($this->condition->getConditions());

            view('Home/preferences', [
                'items' => $items,
                'categories' => $categories,
                'sizes' => $sizes,
                'conditions' => $conditions,
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
