<?php

namespace Controllers;

use \Models\MessageModel;
use \Models\ItemModel;

class Chat
{
    private $message;
    private $item;
    public function __construct()
    {
        $this->message = new MessageModel;
        $this->item = new ItemModel;
    }

    public function index($params)
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        $userId = $_SESSION['user']['id'];
        $product = $this->item->getItem($params['id']);
        $messages = $this->message->getMessages($userId, $product->id);

        return view('Chat/index', ['messages' => $messages, 'product' => $product]);
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/login', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $req = [
                'message' => $_POST['message'],
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $_POST['product_id'],
            ];

            if ($this->message->sendMessage($req)) {
                header('location: ' . URLROOT . '/chat/index/' . $_POST['product_id'], true, 303);
            } else {
                die(SOMETHING_WENT_WRONG);
            }
        }
    }
}
