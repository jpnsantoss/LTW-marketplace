<?php

namespace Controllers\Api;

use Models\CategoryModel;

class Categories
{
    private $category;

    public function __construct()
    {
        $this->category = new CategoryModel();
    }

    public function getCategories()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            // If the request method is not GET, return a 405 Method Not Allowed status code
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        $categories = $this->category->getCategories();

        // Return the categories as a JSON response
        header('Content-Type: application/json');
        echo json_encode($categories);
    }

    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        // Get the input data from the JSON request body
        $input = json_decode(file_get_contents('php://input'), true);

        // Create the category
        $category_id = $this->category->createCategory($input);

        if ($category_id !== false) {
            // Return the category ID as a JSON response
            header('Content-Type: application/json');
            echo json_encode(['category_id' => $category_id]);
        } else {
            // If something went wrong, return a 500 Internal Server Error status code
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
        $this->category->deleteCategory($id);

        header('Content-Type: application/json');
        echo json_encode(['message' => 'Category deleted successfully']);
    }
}
