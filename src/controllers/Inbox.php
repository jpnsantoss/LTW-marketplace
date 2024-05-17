<?php

namespace Controllers;

use \Models\MessageModel;
use \Models\ItemModel;

class Inbox
{
    private $message;
    private $item;
    public function __construct()
    {
        $this->message = new MessageModel;
        $this->item = new ItemModel;
    }

    public function index()
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }

        $userId = $_SESSION['user']['id'];
        $selling = $this->message->getChatsAsSeller($userId);
        $buying = $this->message->getChatsAsBuyer($userId);

        return view('Inbox/index', ['selling' => $selling, 'buying' => $buying]);
    }
}
