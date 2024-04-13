<?php

namespace Controllers;

use Models\CategoryModel;

class Category
{
    private $category;
    public function __construct()
    {
        $this->category = new CategoryModel;
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            if ($this->category->createCategory($name))
                header('location: ' . URLROOT . '/admin', true, 303);
            else
                die(SOMETHING_WENT_WRONG);
        }
    }

    public function delete($params)
    {
        $id = $params['id'];
        $this->category->deleteCategory($id);
        header('location: ' . URLROOT . '/admin', true, 303);
    }
}
