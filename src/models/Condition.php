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

    public function createCondition($name): bool
    {
        $this->db->query("INSERT INTO conditions (`name`) VALUES (:name)");

        $this->db->bind(':name', $name);
        if ($this->db->execute()) return true;
        return false;
    }

    public function deleteCondition($id)
    {
        $this->db->query("DELETE FROM conditions WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) return true;
        return false;
    }
}
