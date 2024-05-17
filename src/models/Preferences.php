<?php

namespace Models;

use \Models\Database;

class PreferencesModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPreferences(): array
    {
        $this->db->query("
    SELECT  *
          
    FROM preferences
    
    ");
        return $this->db->resultSet();

    }
}

?>