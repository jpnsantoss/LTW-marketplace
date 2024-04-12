<?php

namespace Controllers;

class View
{
    public function test()
    {
        view('Test/usage');
    }
    public function register()
    {
        view('Auth/register');
    }
    public function login()
    {
        view('Auth/login');
    }
    public function home()
    {
        view('Home/index');
    }
    public function profile()
    {
        if (isLoggedIn()) {
            view('Profile/index');
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }
    public function createProduct()
    {
        view('CreateProduct/index');
    }
    public function cart()
    {
        view('Cart/index');
    }
    public function chat()
    {
        view('Chat/index');
    }
}
