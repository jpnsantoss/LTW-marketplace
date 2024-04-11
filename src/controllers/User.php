<?php

namespace Controllers;

use \Models\UserModel;

class User
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
    }

    public function users()
    {
        view('Users/users', $this->getUsers());
    }

    public function addUser()
    {
    }

    public function getUsers(): array
    {
        return $this->userModel->getUsers();
    }
}
