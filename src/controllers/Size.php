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
        checkCSRF();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() || !isAdmin()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $name = $_POST['name'];
            if ($this->size->createSize($name))
                header('location: ' . URLROOT . '/admin', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }

    public function delete($params)
    {
        checkCSRF();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() || !isAdmin()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $id = $params['id'];
            $this->size->deleteSize($id);
            header('location: ' . URLROOT . '/admin', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }
}
