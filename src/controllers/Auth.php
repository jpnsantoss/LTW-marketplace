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
            $registerRequest = [
                'username' => $_POST['username'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'hashed_password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            print_r($registerRequest);
            if ($this->user->userExists($registerRequest['email'], $registerRequest['username']))
                die(ALREADY_EXISTS);
            if ($this->user->createUser($registerRequest))
                header('location: ' . URLROOT . '/login', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginRequest = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            $user = $this->user->getUserByEmail($loginRequest['email']);
            if (!$user) {
                die(NOT_FOUND);
            }

            if (password_verify($loginRequest['password'], $user['hashed_password'])) {
                // Start a session and store the user's information
                session_start();
                $_SESSION['user'] = $user;

                // Redirect the user to the home page or dashboard
                header('location: ' . URLROOT . '/home', true, 303);
            } else {
                die("Incorrect password");
            }
        }
    }
    public  function logout()
    {
        session_start();
        session_destroy();
        header('location: ' . URLROOT . '/login', true, 303);
    }
}
