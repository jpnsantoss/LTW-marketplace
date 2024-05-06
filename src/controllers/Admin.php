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
}
