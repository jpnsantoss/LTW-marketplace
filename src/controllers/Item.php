<?php

namespace Controllers;

use Models\ItemModel;

class Item
{
    private $size;
    public function __construct()
    {
        $this->size = new ItemModel;
    }


    public function uploadImage(){
        // Verifica se o formulário foi enviado e se o campo 'image' está presente
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $uploadDir = 'database/images/';
            $imagePath = $uploadDir . basename($_FILES['image']['name']);

            // Verifica se o arquivo enviado é uma imagem
            $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
                exit;
            }

            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                echo "A imagem foi enviada com sucesso.";
                // Agora você pode fazer outras operações, como salvar o caminho da imagem no banco de dados
            } else {
                echo "Ocorreu um erro ao enviar a imagem.";
            }
        } else {
            echo "Nenhum arquivo enviado.";
        }


    }

    public function create()
    {
        if (!isLoggedIn() || !isSeller()) {
            header('location: ' . URLROOT . '/', true, 303);
            die(UNAUTHORIZED_ACCESS);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $uploadDir = 'database/images/';
                $imagePath = $uploadDir . basename($image['name']);
            
                
                if(move_uploaded_file($image['tmp_name'], $imagePath)) {
                    $itemRequest['image_path'] = $imagePath;
                } else {
                    die('Erro ao enviar a imagem.');
                }
            }
            $itemRequest = [
                'title' => $_POST['title'],
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category'],
                'condition_id' => $_POST['condition'],
                'size_id' => $_POST['size'],
                'seller_id' => $_SESSION['user']['id'],
                'image_path' => $imagePath
            ];

            print_r($itemRequest);
            if ($this->size->createItem($itemRequest) && isAdmin())
                header('location: ' . URLROOT . '/admin', true, 303);
            else if (($this->size->createItem($itemRequest) && !isAdmin())){
                header('location: ' . URLROOT . '/', true, 303);
            }
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
        $this->size->deleteItem($id);
        header('location: ' . URLROOT . '/admin', true, 303);
    }
}
