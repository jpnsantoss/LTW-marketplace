<?php

namespace Controllers;

class View
{
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
        view('Profile/index');
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
