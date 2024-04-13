<?php

namespace Models;

use \Models\Database;

class ItemModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getItems(): array
    {
        $this->db->query("SELECT * FROM items");
        return $this->db->resultSet();
    }
}
