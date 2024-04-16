<?php

namespace Controllers;

class View
{
    public function register()
    {
        if (isLoggedIn()) {
            header('location: ' . URLROOT . '/', true, 303);
        } else {
            view('Auth/register');
        }
    }
    public function login()
    {
        if (isLoggedIn()) {
            header('location: ' . URLROOT . '/', true, 303);
        } else {
            view('Auth/login');
        }
    }
    public function home()
    {
        if (isLoggedIn()) {
            view('Home/index');
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
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

    public function details(){
        view('ProductDetails/index');
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
