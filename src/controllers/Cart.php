<?php

namespace Controllers;

use Models\CartModel;

class Cart{

    private $cart;

    public function __construct(){
        $this->cart = new CartModel;
    }

    public function addToCart($product_id) : bool{
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cartRequest = [
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $product_id['id'],
            ];

            if ($this->cart->addToCart($cartRequest)){
                http_response_code(200);
                echo json_encode(['message' => 'Item added to cart successfully!']);   
                header('location: ' . URLROOT . '/cart', true, 303);
                return true;
            }else{
                http_response_code(500); 
                echo json_encode(['message' => 'Failed to add item to Cart']);
                die(SOMETHING_WENT_WRONG);
                return false;
            }
        }else{
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        
    }
    public function deleteItem($product_id) : bool
    {      
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cartRequest = [
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $product_id['id'],
            ];

            if ($this->cart->deleteItem($cartRequest)){
                http_response_code(200);
                echo json_encode(['message' => 'Item added to cart successfully!']);   
                header('location: ' . URLROOT . '/cart', true, 303);
                return true;
            }else{
                http_response_code(500); 
                echo json_encode(['message' => 'Failed to add item to Cart']);
                header('location: ' . URLROOT . '/cart', true, 303);
                die(SOMETHING_WENT_WRONG);
                return false;
            }
        }else{
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    }
    public function index(){
        if(isLoggedIn()){
            $userId = $_SESSION['user']['id'];
            view('Cart/index', [ 'items' => $this->cart->getCart($userId)]);
        }
        else{
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
    }
}?>


