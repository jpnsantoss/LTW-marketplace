<?php

namespace Controllers;

use Models\CartModel;

class Cart{

    private $cart;

    public function __construct()
    {
        $this->cart = new Cart;
    }

    public function addtoCart() : bool
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartRequest = [
                'user_id' => $_SESSION['user']['id'],
                //not teste'product_id' => $_POST['id'] //ou get??
            ];

            print_r($cartRequest);
            if ($this->userCart->addtoCart($cartRequest)){
                header('location: ' . URLROOT . '/cart', true, 303);
                return true;
            }else{
                die(SOMETHING_WENT_WRONG);
                return false;
            }
        }
    }
    
    public function index()
    {
        view('Cart/index', [
            'items' => getCart($_SESSION['user']['id'])
        ]);
    }
}