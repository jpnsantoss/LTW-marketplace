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
        checkCSRF();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitize the input
            $registerRequest = [
                'username' => filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'name' => filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
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
        print_r($_SESSION);
        print_r($_POST);
        checkCSRF();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitize the input
            $loginRequest = [
                'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'password' => filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            ];

            $user = $this->user->getUserByEmail($loginRequest['email']);
            if (!$user) {
                die(NOT_FOUND);
            }

            if (password_verify($loginRequest['password'], $user['hashed_password'])) {
                // Store the user's information in the session
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


    public function request()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $request = [
                'user_id' => $_SESSION['user']['id'],
            ];

            if ($this->user->requestSeller($request)) {
                $_SESSION['user']['hasRequested'] = 1;
                header('location: ' . URLROOT . '/', true, 303);
            } else {
                die(SOMETHING_WENT_WRONG);
            }
        }
    }

    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            };
            session_destroy();
            header('location: ' . URLROOT . '/login', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }


    public function changeemail()
    {
        checkCSRF();
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
        checkCSRF();
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
        } else {
            header('location: ' . URLROOT . '/', true, 303);
        }
    }

    public function changeusername()
    {
        checkCSRF();
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
        checkCSRF();
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
        checkCSRF();
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
