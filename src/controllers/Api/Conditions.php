<?php

namespace Controllers\Api;

use Models\ConditionModel;

class Conditions
{
    private $condition;

    public function __construct()
    {
        $this->condition = new ConditionModel();
    }

    public function getConditions()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            // If the request method is not GET, return a 405 Method Not Allowed status code
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        $conditions = $this->condition->getConditions();

        // Return the conditions as a JSON response
        header('Content-Type: application/json');
        echo json_encode($conditions);
    }

    public function createCondition()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }
        // Get the input data from the JSON request body
        $input = json_decode(file_get_contents('php://input'), true);

        // Create the condition
        $condition_id = $this->condition->createCondition($input);

        if ($condition_id !== false) {
            // Return the condition ID as a JSON response
            header('Content-Type: application/json');
            echo json_encode(['condition_id' => $condition_id]);
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
        $this->condition->deleteCondition($id);

        header('Content-Type: application/json');
        echo json_encode(['message' => 'Condition deleted successfully']);
    }
}
