<?php

namespace Models;

use \Models\Database;

class SizeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSizes(): array
    {
        $this->db->query("SELECT * FROM sizes");
        return $this->db->resultSet();
    }
}
