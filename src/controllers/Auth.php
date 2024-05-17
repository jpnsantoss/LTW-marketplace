<?php

namespace Controllers;

use \Models\UserModel;

class Auth
{
    private $user;

    public function __construct()
    {
        $this->user = new UserModel;
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
            if ($this->user->userExists($registerRequest['email'], $registerRequest['username']))
                die(ALREADY_EXISTS);
            if ($this->user->createUser($registerRequest))
                header('location: ' . URLROOT . '/login', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        } else {
            die(UNAUTHORIZED_ACCESS);
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
                header('location: ' . URLROOT . '/', true, 303);
            } else {
                die("Incorrect password");
            }
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }
    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            session_destroy();
            header('location: ' . URLROOT . '/login', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }


    public function changeemail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $email = [
                'email' => $_POST['email'],
                'user_id' => $_SESSION['user']['id'],
            ];


            if ($this->user->changeEmail($email)) {

                $_SESSION['user']['email'] = $email['email'];

                header('location: ' . URLROOT . '/profile', true, 303);
            } else {
                header('location: ' . URLROOT . '/', true, 303);
            }
        }
    }

    public function changepreferences()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $preferences = [
                'category' => $_POST['category'],
                'size' => $_POST['size'],
                'condition' => $_POST['condition'],
                'user_id' => $_SESSION['user']['id'],
            ];


            if ($this->user->changePreferences($preferences)) {

                $_SESSION['user']['category_id'] = $preferences['category'];
                $_SESSION['user']['size_id'] = $preferences['size'];
                $_SESSION['user']['condition_id'] = $preferences['condition'];

                header('location: ' . URLROOT . '/profile', true, 303);
            } else {
                header('location: ' . URLROOT . '/', true, 303);
            }
        }
        else {
            header('location: ' . URLROOT . '/', true, 303);
        }
    }

    public function changeusername()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $change = [
                'username' => $_POST['username'],
                'user_id' => $_SESSION['user']['id'],
            ];


            if ($this->user->changeUsername($change)) {

                $_SESSION['user']['username'] = $change['username'];

                header('location: ' . URLROOT . '/profile', true, 303);
            } else {
                header('location: ' . URLROOT . '/', true, 303);
            }
        }
    }

    public function changefullname()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $change = [
                'fullname' => $_POST['fullname'],
                'user_id' => $_SESSION['user']['id'],
            ];


            if ($this->user->changeFullname($change)) {

                $_SESSION['user']['full_name'] = $change['fullname'];

                header('location: ' . URLROOT . '/profile', true, 303);
            } else {
                header('location: ' . URLROOT . '/', true, 303);
            }
        }
    }

    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }

            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password !== $confirm_password) {
                echo "As senhas não coincidem.";
                exit;
            }

            $change = [
                'current_password' => password_hash($_POST['current_password'], PASSWORD_DEFAULT),
                'hashed_password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                'user_id' => $_SESSION['user']['id'],
            ];


            if (!password_verify($current_password, $_SESSION['user']['hashed_password'])) {

                echo "Current password incorrect";

                // Redirect the user to the home page or dashboard
                exit;
            } else {




                if ($this->user->changePassword($change)) {

                    $_SESSION['user']['hashed_password'] = $change['hashed_password'];

                    header('location: ' . URLROOT . '/profile', true, 303);
                } else {
                    header('location: ' . URLROOT . '/', true, 303);
                }
            }
        }
    }
}
