<?php
namespace Controllers;
use Models\CartModel;
use Models\ItemModel;


class Cart{
    private $cart;
    public function __construct(){
        $this->cart = new CartModel;
        $this->item = new ItemModel;
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
    public function payStub(){
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['data'])) {
                
                $data = json_decode($_POST['data']);
                if ($data !== null) {
                    foreach ($data as $el) {
                        $buyer_id = $_SESSION['user']['id'];
                        $soldItem = $this->item->getItem($el->item_id);
                        $this->cart->setSold($soldItem->id, $buyer_id, $soldItem->seller_id );
                    }
                } else {
                    echo "Error decoding JSON data";
                }
            } else {
                echo "No data received";
                
            }
            //should redirect to some receipt/shipping forms
            header('location: ' . URLROOT . '/profile', true, 303);
        }
        else{
           
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

    public function checkout($item){

        $item_id = $item['id'];

        if(isLoggedIn()){
            $userId = $_SESSION['user']['id'];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                view('Checkout/index', ['items' => $this->cart->getItem($item_id, $userId)]);
            }else if($_SERVER['REQUEST_METHOD'] === 'POST') {
                view('Checkout/index', ['items' => $this->cart->getCart($userId)]);
            }
        }else{
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }

    }

    /*
    public function conclude(){

        $item_id = $item['id'];

        if(isLoggedIn()){
        view('Checkout/conclusion', ['items' => $this->cart->getCart($userId)]);
        }else{
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        
        }
    }*/
}
?>
