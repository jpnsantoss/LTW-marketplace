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

    public  function details()
    {
        session_start();
        session_destroy();
        header('location: ' . URLROOT . '/details', true, 303);
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
                header('location: ' . URLROOT . '/admin', true, 303);
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
            $this->item->deleteItem($id);
            header('location: ' . URLROOT . '/admin', true, 303);
        } else {
            die(UNAUTHORIZED_ACCESS);
        }
    }
}

