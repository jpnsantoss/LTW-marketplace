<?php

namespace Models;

use \Models\Database;

class ConditionModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getConditions(): array
    {
        $this->db->query("SELECT * FROM conditions");
        return $this->db->resultSet();
    }
}
