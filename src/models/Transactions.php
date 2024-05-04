<?php

namespace Models;

use \Models\Database;

class TransactionsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTransactions(): array
    {
        $this->db->query("
    SELECT  *
          
    FROM transactions
    
    ");
        return $this->db->resultSet();

    }
}

?>