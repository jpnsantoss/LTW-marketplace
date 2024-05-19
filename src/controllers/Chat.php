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

        $chat = sanitizeObject($this->message->getChatById($params['id']));
        $messages = sanitize($this->message->getMessages($params['id']));

        return view('Chat/index', ['chat' => $chat, 'messages' => $messages]);
    }


    public function open($params)
    {
        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/login', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }

        $userId = $_SESSION['user']['id'];
        $chat = $this->message->findChatByBuyer($userId, $params['id']);

        if (!$chat) {
            // Create a new chat if it doesn't exist
            $chatId = $this->message->createChat($userId, $params['id']);
        } else {
            $chatId = $chat->id;
        }

        header('location: ' . URLROOT . '/chat/index/' . $chatId, true, 303);
    }

    public function send()
    {
        checkCSRF();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/login', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }

            $req['sender_id'] = $_SESSION['user']['id'];
            $req['chat_id'] = $_POST['chat_id'];
            $req['content'] = $_POST['content'];

            $this->message->sendMessage($req);

            header('location: ' . URLROOT . '/chat/index/' . $req['chat_id'], true, 303);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    }
}
