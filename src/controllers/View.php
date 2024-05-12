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




    public function createProduct()
    {
        view('CreateProduct/index');
    }


    public function chat()
    {
        view('Chat/index');
    }

    public function checkout(){
        if (isLoggedIn()) {
           view('Checkout/index');
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
        
    }
}
