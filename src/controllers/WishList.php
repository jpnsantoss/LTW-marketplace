<?php

namespace Controllers;

use Models\WishListModel;

class WishList{

    private $wishList;

    public function __construct(){
        $this->wishList = new WishListModel;
    }

    public function addtoWishList() : bool
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wishListRequest = [
                'user_id' => $_SESSION['user']['id'],
                //not teste'product_id' => $_POST['id'] //ou get??
            ];

            print_r($wishListRequest);
            if ($this->userList->addtoWishList($wishlistRequest)){
                header('location: ' . URLROOT . '/wishList', true, 303);
                return true;
            }else{
                die(SOMETHING_WENT_WRONG);
                return false;
            }
        }
    }
    
    public function index()
    {
        view('WishList/index', [
            'items' => $this->wishList->getWishlist($_SESSION['user']['id'])
        ]);
    }
}