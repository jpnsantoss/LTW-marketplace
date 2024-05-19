<?php

namespace Controllers;

use Models\WishListModel;

class WishList
{

    private $wishList;

    public function __construct()
    {
        $this->wishList = new WishListModel;
    }

    public function addToWishList($product_id): bool
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $wishListRequest = [
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $product_id['id'],
            ];
            if ($this->wishList->addToWishList($wishListRequest)) {
                http_response_code(200);
                echo json_encode(['message' => 'Item added to list successfully!']);
                header('location: ' . URLROOT . '/wishList', true, 303);
                return true;
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to add item to Wishlist']);
                header('location: ' . URLROOT . '/wishList', true, 303);
                die(SOMETHING_WENT_WRONG);
                return false;
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    }

    public function deleteItem($product_id): bool
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $wishListRequest = [
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $product_id['id'],
            ];
            if ($this->wishList->deleteItem($wishListRequest)) {
                http_response_code(200);
                echo json_encode(['message' => 'Item added to list successfully!']);
                header('location: ' . URLROOT . '/wishList', true, 303);
                return true;
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to add item to Wishlist']);
                header('location: ' . URLROOT . '/wishList', true, 303);
                die(SOMETHING_WENT_WRONG);
                return false;
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    }

    public function index()
    {
        if (isLoggedIn()) {
            $userId = $_SESSION['user']['id'];

            $wishlist = sanitize($this->wishList->getWishList($userId));

            view('WishList/index', ['items' => $wishlist]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
    }
}
