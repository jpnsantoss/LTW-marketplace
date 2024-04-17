<?php

namespace Controllers;

use \Models\CategoryModel;
use \Models\SizeModel;
use \Models\ItemModel;
use \Models\ConditionModel;
use \Models\ImageModel;

class Home
{
    private $category;
    private $size;
    private $item;
    private $condition;
    private $image;

    public function __construct()
    {
        $this->category = new CategoryModel;
        $this->size = new SizeModel;
        $this->item = new ItemModel;
        $this->condition = new ConditionModel;
        $this->image = new ImageModel;
    }


    public function index()
    {
        echo json_encode($this->item->getItems());
    }
}
