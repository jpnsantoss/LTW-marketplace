<?php

namespace Models;

use \Models\Database;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsers(): array
    {
        $this->db->query("SELECT * FROM users");
        return $this->db->resultSet();
    }

    //$username, $full_name, $email, $hashed_password
    public function createUser($userRequest): bool
    {
        $this->db->query("INSERT INTO users (`username`, `full_name`, `email`, `hashed_password`) VALUES (':username, :fullname, :email, :password')");
        foreach ($userRequest as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        if ($this->db->execute()) return true;
        return false;
    }
}
