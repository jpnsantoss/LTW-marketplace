<?php

namespace Controllers;

use \Models\User;

class Auth
{
    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userRequest = [
                'username' => $_POST['username'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'hashed_password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            print_r($userRequest);
            if ($this->user->userExists($userRequest['email'], $userRequest['username']))
                die(ALREADY_EXISTS);
            if ($this->user->createUser($userRequest))
                header('location: ' . URLROOT . '/login', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        }
    }

    public function login()
    {
    }
}
