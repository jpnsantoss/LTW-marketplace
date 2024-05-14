<?php

namespace Controllers;

use Models\ItemModel;
use Models\ImageModel;

class Item
{
    private $item;
    private $imageModel;
    public function __construct()
    {
        $this->item = new ItemModel;
        $this->imageModel = new ImageModel;
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() || !isSeller()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $itemRequest = [
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category'],
                'condition_id' => $_POST['condition'],
                'size_id' => $_POST['size'],
                'seller_id' => $_SESSION['user']['id']
            ];
            $item_id = $this->item->createItem($itemRequest);
            if ($item_id !== false) {
                if (isset($_FILES['images'])) {
                    $post_images = $this->uploadImages($_FILES['images'], $item_id);

                    foreach ($post_images as $image) {
                        $this->imageModel->createImage($image, $item_id);
                    }
                }
                header('location: ' . URLROOT . '/create', true, 303);
            } else
                die(SOMETHING_WENT_WRONG);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }



    private function uploadImages($images, $itemId)
    {
        $targetDir = "/images/uploads/";
        $absoluteDir = APPROOT . "/public" . $targetDir;
        $targetFiles = [];
        foreach ($images['tmp_name'] as $key => $tmp_name) {
            $fileExtension = pathinfo($images['name'][$key], PATHINFO_EXTENSION);
            $newFileName = $itemId . '_' . time() . '_' . $key . '.' . $fileExtension;
            $absoluteFile = $absoluteDir . $newFileName;
            $targetFile = $targetDir . $newFileName;

            if (move_uploaded_file($tmp_name, $absoluteFile)) {
                $targetFiles[] = $targetFile;
            }
        }
        return $targetFiles;
    }



    public function delete($params)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() || !isAdmin()) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $id = $params['id'];

            $images = $this->imageModel->findImages($id);

            foreach ($images as $image) {
                if (!$this->imageModel->deleteImage($image->id)) {
                    die("deleting image failed.");
                };
            }


            $this->item->deleteItem($id);
            header('location: ' . URLROOT . '/admin', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }

    public function deleteuseritem($params)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isLoggedIn() ) {
                header('location: ' . URLROOT . '/', true, 303);
                die(UNAUTHORIZED_ACCESS);
            }
            $id = $params['id'];

            $images = $this->imageModel->findImages($id);

            foreach ($images as $image) {
                if (!$this->imageModel->deleteImage($image->id)) {
                    die("deleting image failed.");
                };
            }


            $this->item->deleteItem($id);
            header('location: ' . URLROOT . '/profile', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }

    public function updateitem()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $itemData = [
                'item_id' => $_POST['item_id'], // O ID do item que você deseja atualizar
                'price' => $_POST['price'], // Novo preço do item
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'category_id' => $_POST['category'],
                'size_id' => $_POST['size'],
                'condition_id' => $_POST['condition'],
                // Adicione quaisquer outros campos que você deseja atualizar aqui
            ];

            if ($this->item->updateItem($itemData)) {

                header('location: ' . URLROOT . '/profile', true, 303);
            } else {

                header('location: ' . URLROOT . '/', true, 303);
            }
        }
    }
}
