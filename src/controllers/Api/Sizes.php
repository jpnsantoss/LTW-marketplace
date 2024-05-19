<?php

namespace Controllers\Api;

use Models\SizeModel;

class Sizes
{
    private $size;

    public function __construct()
    {
        $this->size = new SizeModel();
    }

    public function getSizes()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            // If the request method is not GET, return a 405 Method Not Allowed status code
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        $sizes = $this->size->getSizes();

        header('Content-Type: application/json');
        echo json_encode($sizes);
    }

    public function createSize()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        $input = json_decode(file_get_contents('php://input'), true);

        $size_id = $this->size->createSize($input);

        if ($size_id !== false) {
            header('Content-Type: application/json');
            echo json_encode(['size_id' => $size_id]);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Something went wrong']);
        }
    }

    public function delete($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        $id = $params['id'];
        $this->size->deleteSize($id);

        header('Content-Type: application/json');
        echo json_encode(['message' => 'Size deleted successfully']);
    }
}
