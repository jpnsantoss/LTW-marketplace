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
        if (isLoggedIn()) {
            view('Home/index', [

                'items' => $this->item->getItems(),
            ]);
        } else {
            header('location: ' . URLROOT . '/login', true, 303);
        }
    }
    public function details($id)
    {
        $itemId = intval($id['id']);

        $items = $this->item->getItems();
        foreach ($items as $i) {

            if ($i->id == $itemId) {
                view('ProductDetails/index', [
                    'item' => $i
                ]);

                break;
            }
        }


        /* if (isset($item)) {
            // Se o item foi encontrado, passa-o para a view
            view('ProductDetails/index', [
                'item' => $item
            ]);
        } else {
            // Se o item não foi encontrado, exibe uma mensagem de erro
            echo "Item não encontrado";
        }*/
    }
}
