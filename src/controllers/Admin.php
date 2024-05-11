<?php

namespace Controllers;

use \Models\CategoryModel;
use \Models\SizeModel;
use \Models\ItemModel;
use \Models\ConditionModel;
use \Models\ImageModel;
use \Models\UserModel;


class Admin
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

    public function users(){
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
