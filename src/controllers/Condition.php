<?php

namespace Controllers;

use Models\ConditionModel;

class Condition
{
    private $condition;
    public function __construct()
    {
        $this->condition = new ConditionModel;
    }

    public function create()
    {
        if (!isLoggedIn() || !isAdmin()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            if ($this->condition->createCondition($name))
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
        $this->condition->deleteCondition($id);
        header('location: ' . URLROOT . '/admin', true, 303);
    }
}
