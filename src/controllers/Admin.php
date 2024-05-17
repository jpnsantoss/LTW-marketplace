<?php

namespace Controllers;

use \Models\CategoryModel;
use \Models\SizeModel;
use \Models\ItemModel;
use \Models\ConditionModel;
use \Models\UserModel;
use \Models\TransactionsModel;
use \Models\PreferencesModel;


class Admin
{
    private $category;
    private $size;
    private $item;
    private $condition;
    private $user;
    private $transaction;
    private $preference;

    public function __construct()
    {
        $this->category = new CategoryModel;
        $this->size = new SizeModel;
        $this->item = new ItemModel;
        $this->condition = new ConditionModel;
        $this->user = new UserModel;
        $this->transaction = new TransactionsModel;
        $this->preference = new PreferencesModel;
    }

public function promoteUserToSeller($id){

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
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

    header('location: ' . URLROOT. '/Admin/users');
}

public function promoteUserToAdmin($id){

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
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

    header('location: ' . URLROOT. '/Admin/users');
}

public function requestToBeSeller($id){

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $success = $this->user->requestToBeSeller($id);
        
        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'User promoted to seller successfully!']);
            header('location: ' . URLROOT.'/');
 
        } else {
            http_response_code(500); 
            echo json_encode(['message' => 'Failed to promote user to seller']);
        }
    
    } else {
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
    }
}

public function getSellerItems($id){

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $success = $this->user->getSellerItems($id);
        
        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'User items fetched successfully!']);
            header('location: ' . URLROOT. '/Admin/'. $id['id'] . '/user-items'); 

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
        view('Admin/index', [
            'categories' => $this->category->getCategories(),
            'sizes' => $this->size->getSizes(),
            'items' => $this->item->getItems(),
            'conditions' => $this->condition->getConditions()
        ]);
    }


    public function additem()
    {
        view('CreateProduct/index', [
            'categories' => $this->category->getCategories(),
            'sizes' => $this->size->getSizes(),
            'items' => $this->item->getItems(),
            'conditions' => $this->condition->getConditions()
        ]);
    }

    public function profile()
    {
        if (isLoggedIn()) {
            view('Profile/index', [
                'categories' => $this->category->getCategories(),
                'sizes' => $this->size->getSizes(),
                'items' => $this->item->getItems(),
                'conditions' => $this->condition->getConditions(),
                'transactions' => $this->transaction->getTransactions(),
                'users' => $this->user->getUsers(),
                'preferences' => $this->preference->getPreferences(),
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }

    public function users()
    {
        view('Admin/users', [
            'users' => $this->user->getUsersAndSellerInfo()
        ]);
    }
    public function userItems($data){
        view('Admin/userItems', [
            'items' => $this->user->getSellerItems($data['id'])
        ]);
    }


}
