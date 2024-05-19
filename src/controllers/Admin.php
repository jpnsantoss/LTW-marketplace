<?php

namespace Controllers;

use \Models\CategoryModel;
use \Models\SizeModel;
use \Models\ItemModel;
use \Models\ConditionModel;
use \Models\UserModel;
use \Models\TransactionsModel;



class Admin
{
    private $category;
    private $size;
    private $item;
    private $condition;
    private $user;
    private $transaction;


    public function __construct()
    {
        $this->category = new CategoryModel;
        $this->size = new SizeModel;
        $this->item = new ItemModel;
        $this->condition = new ConditionModel;
        $this->user = new UserModel;
        $this->transaction = new TransactionsModel;
    }

    public function promoteUserToSeller($id)
    {
        checkCSRF();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $success = $this->user->promoteToSeller($id);

            if ($success) {
                http_response_code(200);
                echo json_encode(['message' => 'User promoted to seller successfully!']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to promote user to seller']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }

        header('location: ' . URLROOT . '/Admin/users');
    }

    public function promoteUserToAdmin($id)
    {
        checkCSRF();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!$this->user->isSeller($id)) {
                $this->user->promoteToSeller($id);
            }
            $success = $this->user->promoteToAdmin($id);

            if ($success) {
                http_response_code(200);
                echo json_encode(['message' => 'User promoted to seller successfully!']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to promote user to seller']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }

        header('location: ' . URLROOT . '/Admin/users');
    }

    public function requestToBeSeller($id)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $success = $this->user->requestToBeSeller($id);

            if ($success) {
                http_response_code(200);
                echo json_encode(['message' => 'User promoted to seller successfully!']);
                header('location: ' . URLROOT . '/');
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to promote user to seller']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    }

    public function getSellerItems($id)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $success = $this->user->getSellerItems($id);

            if ($success) {
                http_response_code(200);
                echo json_encode(['message' => 'User items fetched successfully!']);
                header('location: ' . URLROOT . '/Admin/' . $id['id'] . '/user-items');
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to fetch user items']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    }


    public function index()
    {
        $categories = sanitize($this->category->getCategories());

        $sizes = sanitize($this->size->getSizes());

        $items = sanitize($this->item->getItems());

        $conditions = sanitize($this->condition->getConditions());


        view(
            'Admin/index',
            [
                'categories' => $categories,
                'sizes' => $sizes,
                'items' => $items,
                'conditions' => $conditions
            ]
        );
    }




    public function additem()
    {
        $categories = sanitize($this->category->getCategories());

        $sizes = sanitize($this->size->getSizes());

        $items = sanitize($this->item->getItems());

        $conditions = sanitize($this->condition->getConditions());

        view('CreateProduct/index', [
            'categories' => $categories,
            'sizes' => $sizes,
            'items' => $items,
            'conditions' => $conditions
        ]);
    }

    public function profile()
    {
        if (isLoggedIn()) {
            $categories = sanitize($this->category->getCategories());

            $sizes = sanitize($this->size->getSizes());

            $items = sanitize($this->item->getItems());

            $conditions = sanitize($this->condition->getConditions());

            $transactions = sanitize($this->transaction->getTransactions());

            $users = sanitize($this->user->getUsers());

            view('Profile/index', [
                'categories' => $categories,
                'sizes' => $sizes,
                'items' => $items,
                'conditions' => $conditions,
                'transactions' => $transactions,
                'users' => $users
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }


    public function users()
    {
        $users = sanitize($this->user->getUsersAndSellerInfo());

        view('Admin/users', [
            'users' => $users
        ]);
    }
    public function userItems($data)
    {
        $items = sanitize($this->user->getSellerItems($data['id']));

        view('Admin/userItems', [
            'items' => $items
        ]);
    }
}
