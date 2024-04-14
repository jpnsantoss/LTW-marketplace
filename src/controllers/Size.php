<?php

namespace Controllers;

use Models\SizeModel;

class Size
{
    private $size;
    public function __construct()
    {
        $this->size = new SizeModel;
    }

    public function create()
    {
        if (!isLoggedIn() || !isAdmin()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            if ($this->size->createSize($name))
                header('location: ' . URLROOT . '/admin', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        }
    }

    public function delete($params)
    {
        if (!isLoggedIn() || !isAdmin()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        $id = $params['id'];
        $this->size->deleteSize($id);
        header('location: ' . URLROOT . '/admin', true, 303);
    }
}
