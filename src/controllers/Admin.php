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
                'conditions' => $this->condition->getConditions()
        ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }

    public function users(){
        view('Admin/users', [
            'users' => $this->user->getUsersAndSellerInfo()
        ]);
    }
}
